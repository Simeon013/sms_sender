<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
 if(!isset($_SESSION["login"])){
    header("Location: auth/connexion.php");
    exit(); 
  }
?>
<?php 
    include("assets/entete_connect.inc.php");
?>
<link rel="stylesheet" href="style.css">
<!-- L'enctype, DOIT être spécifié comme ce qui suit -->
<form action="excel-sms.php" method='post' enctype="multipart/form-data">
    <h2><strong><i><center>Formulaire d'envoi de sms</center></i></strong></h2>
            <input name="object" type="text" class="feedback-input" placeholder="Objet" html_entity_decode required/>   
            <input name="fichier" type="file" class="feedback-input" placeholder="Fichier excel"/>
            <textarea name="text" class="feedback-input" placeholder="Message" html_entity_decode required></textarea>
            <input type="submit" value="Envoyer"/>
</form>
</body>
</html>