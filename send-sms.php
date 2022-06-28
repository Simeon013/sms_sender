<?php

require 'vendor/autoload.php';


$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
$reader->setReadDataOnly(true);
$spreadsheet = $reader->load("file/classeur.xlsx");

$worksheet = $spreadsheet->getActiveSheet();
// Get the highest row number and column letter referenced in the worksheet
$highestRow = $worksheet->getHighestRow(); // e.g. 10
$highestColumn = 'B'; // e.g 'F'
// Increment the highest column letter
$highestColumn++;

echo '<table>' . "\n";
for ($row = 2; $row <= $highestRow; ++$row) {
    echo '<tr>' . PHP_EOL;
    for ($col = 'A'; $col != $highestColumn; ++$col) {
        echo '<td>' .
             $worksheet->getCell($col . $row)
                 ->getValue() .
             '</td>' . PHP_EOL;
    }
    echo '</tr>' . PHP_EOL;
}
echo '</table>' . PHP_EOL;
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

$sms =  "\n "."Objet: ".$_POST['object'] ."\nMessage: ". $_POST['text'];

// Construire le corps de la requête
$sms_body = array(
    'action' => 'send-sms',
    'api_key' => $api_key,
    'to' => $destination,
    'from' => $from,
    'sms' => $sms
);

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

    var_dump($output);

}catch (Exception $exception){
    echo $exception->getMessage();
}
?>