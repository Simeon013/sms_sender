<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
 if(!isset($_SESSION["login"])){
    header("Location: auth/connexion.php");
    $message="Veuillez vous connecter";
    exit("Veuillez vous connecter d'abord"); 
  }
?>
<?php 
    include("assets/entete_connect.inc.php");
?>
<link rel="stylesheet" href="style.css">

<section>
    <form action="num-sms.php" method="POST">   
    <h2><strong><i><center>Formulaire d'envoi de sms</center></i></strong></h2>
        <input name="object" type="text" class="feedback-input" placeholder="Objet" html_entity_decode required/>   
        <input name="tel" type="tel" class="feedback-input" placeholder="Telephone"/>
        <textarea name="text" class="feedback-input" placeholder="Message" html_entity_decode required></textarea>
        <input type="submit" value="Envoyer"/>
    </form>
</body>

</html>