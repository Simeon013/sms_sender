<?php
/* Indique le bon format des entêtes (par défaut apache risque de les envoyer au standard ISO-8859-1)*/
header('Content-type: text/html; charset=UTF-8');

/* Initialisation de la variable du message de réponse*/
$message = null;

/* Récupération des variables issues du formulaire par la méthode post*/
$nom = filter_input(INPUT_POST, 'nom');
$prenom = filter_input(INPUT_POST, 'prenom');
$pseudo = filter_input(INPUT_POST, 'pseudo');
$pass = filter_input(INPUT_POST, 'pass');
$pass_conf = filter_input(INPUT_POST, 'pass_conf');

/* Si le formulaire est envoyé */
if (isset($nom,$prenom,$pseudo,$pass,$pass_conf)) 
{   

    /* Teste que les valeurs ne sont pas vides ou composées uniquement d'espaces  */ 
    $nom = trim($nom) != '' ? $nom : null;
    $prenom = trim($prenom) != '' ? $prenom : null;
    $pseudo = trim($pseudo) != '' ? $pseudo : null;
    $pass = trim($pass) != '' ? $pass : null;
    $pass_conf = trim($pass_conf) != '' ? $pass_conf : null;
   

    /* Si $pseudo et $pass différents de null */
    if(isset($nom,$prenom,$pseudo,$pass))
    {
    /* on test si les deux mdp sont bien identique */
    if ($pass==$pass_conf)
      {
    /* Connexion au serveur : dans cet exemple, en local sur le serveur d'évaluation
    A MODIFIER avec vos valeurs */
    $hostname = "localhost";
    $database = "gest_sms";
    $username = "root";
    $password = "";
    
    /* Configuration des options de connexion */
    
    /* Désactive l'éumlateur de requêtes préparées (hautement recommandé)  */
    $pdo_options[PDO::ATTR_EMULATE_PREPARES] = false;
    
    /* Active le mode exception */
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    
    /* Indique le charset */
    $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES utf8";
    
    /* Connexion */
    try
    {
      $connect = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password, $pdo_options);
    }
    catch (PDOException $e)
    {
      exit('problème de connexion à la base');
    }
        
    
    /* Requête pour compter le nombre d'enregistrements répondant à la clause : champ du pseudo de la table = pseudo posté dans le formulaire */
    $requete = "SELECT count(*) FROM compte WHERE pseudo = ?";
    
    try
    {
      /* préparation de la requête*/
      $req_prep = $connect->prepare($requete);
      
      /* Exécution de la requête en passant la position du marqueur et sa variable associée dans un tableau*/
      $req_prep->execute(array(0=>$pseudo));
      
      /* Récupération du résultat */
      $resultat = $req_prep->fetchColumn();
      
      if ($resultat == 0) 
      /* Résultat du comptage = 0 pour ce pseudo, on peut donc l'enregistrer */
      {
        /* Pour enregistrer la date actuelle (date/heure/minutes/secondes) on peut utiliser directement la fonction mysql : NOW()*/
        $insertion = "INSERT INTO compte VALUES(:nom, :prenom, :pseudo, :pass, NOW(), 'user')";
        
        /* préparation de l'insertion */
        $insert_prep = $connect->prepare($insertion);
        
        /* Exécution de la requête en passant les marqueurs et leur variables associées dans un tableau*/
        $inser_exec = $insert_prep->execute(array(':nom'=>$nom,':prenom'=>$prenom,':pseudo'=>$pseudo,':pass'=>$pass));
        
        /* Si l'insertion s'est faite correctement...*/
        if ($inser_exec === true) 
        {
          /* Démarre une session si aucune n'est déjà existante et enregistre le pseudo dans la variable de session $_SESSION['login'] qui donne au visiteur la possibilité de se connecter.  */
          if (!session_id()) session_start();
          $_SESSION['login'] = $pseudo;
          
          /* A MODIFIER Remplacer le '#' par l'adresse de votre page de destination, sinon ce lien indique la page actuelle.*/
          $message = 'Votre inscription est enregistrée.';
          /*ou redirection vers une page en cas de succès ex : menu.php*/
          header("Location: ../compte.php");
            exit();
        }   
      }
      else
      {   /* Le pseudo est déjà utilisé */
        $message = 'Ce pseudo est déjà utilisé, changez-le.';
      }
    }
    catch (PDOException $e)
    {
      $message = 'Problème dans la requête d\'insertion';
    }	
  }
  else 
{
    $message = 'Les mots de passe ne sont pas identiques.';
}}
  else 
  {    /* Au moins un des deux champs "pseudo" ou "mot de passe" n'a pas été rempli*/
    $message = 'Les champs Pseudo et Mot de passe doivent être remplis.';
  }

}
?>
<?php
include("entete.inc.php")
?>
<link rel="stylesheet" href="../style.css">
         <div class="form-container">
            <div class="form-inner">
               <form action="" method="POST" class="signup">
               <h2><strong><i><center>Formulaire d'inscription</center></i></strong></h2>
                  <div class="field">
                     <input type="text" placeholder="Nom" name="nom" class="feedback-input" required>
                  </div>
                  <div class="field">
                     <input type="text" placeholder="Prénom" name="prenom" class="feedback-input" required>
                  </div>
                  <div>
                     <input type="text" placeholder="Pseudo" name="pseudo" class="feedback-input" required>
                  </div>
                  <div class="field">
                     <input type="password" placeholder="Mot de passe" name="pass" class="feedback-input" required>
                  </div>
                  <div class="field">
                     <input type="password" placeholder="Confirmer mot de passe" name="pass_conf" class="feedback-input" required>
                  </div>
                  <div class="field btn">
                     <div class="btn-layer"></div>
                     <input type="submit" value="S'inscrire">
                  </div>
                  <div class="signup-link">
                    <a href="connexion.php">Vous avez deja un compte?</a>
                 </div>
                 <?php echo($message); ?>
               </form>
            </div>
         </div>