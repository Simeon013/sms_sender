<?php
//on vérifie que le formulaire a été envoyé
if(isset($_POST['submit'])){
/*dossier où le fichier sera téléchargé il doit exister
à l'avance sur votre serveur, sinon PHP vous affiche
un message d'erreur s'il n'existe pas
*/ 
$dossier='file/'; 
//l'utilisateur a choisi un fichier
if(is_uploaded_file($_FILES['fichier']['tmp_name'])){
//nom du fichier 
$nom_fichier=$_FILES['fichier']['name'];
//on déplace le fichier dans le repertoire
if(move_uploaded_file($_FILES['fichier']['tmp_name'],$dossier.$nom_fichier)){
echo "<p>Le fichier $nom_fichier a été déplacé dans le repertoire $dossier</p>";
}
else{
//il ya eu une erreur
echo "<p>Erreur lors du déplacement du fichier $nom_fichier</p>";
}
}
else{
echo "<p>Aucun fichier séléctionné</p>";
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<title>Envoie de fichier via un formulaire</title>
</head>
<body>
<!-- traitement sur la même page -->
<form action='' method='post' enctype="multipart/form-data">
<p>Formulaire d'envoie d'un fichier</p>
<p>
<input type='file' name='fichier' />
</p>
<p>
<input type='submit' name='submit' value='Envoyer le fichier' />
</p>
</form>
</body>
</html>