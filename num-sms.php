<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
 if(!isset($_SESSION["login"])){
    header("Location: auth/connexion.php");
    exit(); 
  }
  include("assets/db_connect.php");
?>
<?php 
    include("assets/entete_connect.inc.php");
?>
<?php
    
// ETAPE 1: GENEREZ UNE CLÉ API_KEY ICI HTTPS://APP.TECHSOFT-WEB-AGENCY.COM/USER/SMS-API/INFO
$api_key = 'R2ZtZ0VuZXpLR0JwQnpPb0t5Y3I=';

//Etape 2: precisez l'url de la requête
$url = 'https://app.techsoft-web-agency.com/sms/api';


// Etape 3: Le sender ID ou nom d'envoi (11 caractères, espaces compris). ATTENTION: Le sender id doit être enregistré et validé (Menu ID expediteur / Nom d'envoi) dans votre compte sinon une erreur sera généré.
$from = 'TECHSOF SMS';

//Etape 4: precisez le numéro de téléphone (Format international)

$destination = $_POST['tel'];

$objet = $_POST['object'];
$message = $_POST['text'];

$sms =  "\n "."Objet: ".$objet ."\nMessage: ". $message;

// Construire le corps de la requête
$sms_body = array(
    'action' => 'send-sms',
    'api_key' => $api_key,
    'to' => $destination,
    'from' => $from,
    'sms' => $sms
);
var_dump($sms_body);

echo("\nExpediteur: ". $from);
echo(" \nDestinateur: ". $destination);
echo(" \nObjet: ". $objet);
echo(" \nMessage: ". $message);

$send_data = http_build_query($sms_body);
$gateway_url = $url . "?" . $send_data;

try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $gateway_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPGET, 1);
    $output = curl_exec($ch);

    if (curl_errno($ch)) {
        $output = curl_error($ch);
    }
    curl_close($ch);

    var_dump($gateway_url);
    var_dump($output);

}catch (Exception $exception){
    echo $exception->getMessage();
}
        /* Pour enregistrer la date actuelle (date/heure/minutes/secondes) on peut utiliser directement la fonction mysql : NOW()*/
        $insertion = "INSERT INTO sms VALUES(NULL, :destinateur, NOW(), :objet, :contenu, :sender)";
        
        /* préparation de l'insertion */
        $insert_prep = $connect->prepare($insertion);
        
        /* Exécution de la requête en passant les marqueurs et leur variables associées dans un tableau*/
        $inser_exec = $insert_prep->execute(array(':destinateur'=>$destination,':objet'=>$objet,':contenu'=>$message,':sender'=>$user));
?>