

<?php
    
    // ETAPE 1: GENEREZ UNE CLÉ API_KEY ICI HTTPS://APP.TECHSOFT-WEB-AGENCY.COM/USER/SMS-API/INFO
    $api_key = 'R2ZtZ0VuZXpLR0JwQnpPb0t5Y3I=';
    
    //Etape 2: precisez l'url de la requête
    $url = 'https://app.techsoft-web-agency.com/sms/api';
    
    
    /*
        INCLURE LES DEUX PREMIÈRE ÉTAPE ICI (AUTHENTIFICATION ET LIEN API)
    */
    // Etape 3: Le sender ID ou nom d'envoi (11 caractères, espaces compris)
    $from = 'TECHSOF SMS';
    
    //Etape 4: precisez le numéro de téléphone (Format international). Vous pouvez ajouter jusqu'à 100 numéros maximum par requête.
    $destination = $_POST['tel'];	
    
    $objet = $_POST['object'];
    $message = $_POST['text'];

    $sms =  "\n "."Objet: ".$objet ."\nMessage: ". $message;
        
    
    //voici un bout de code pour vous aider à convertir la date au format requis
    
        $originalDate = ($_POST['program-date']." ". $_POST['program-time']);
        echo($originalDate);
        $newDate = date("m/d/Y h:i A", strtotime($originalDate));
        $schedule_time = $newDate;
        echo($schedule_time);
    
    
    // Etape 5: Précisez l'heure d'envoi du sms. Format $format = 'm/d/Y h:i A';
    //$schedule_time = '07/21/2020 11:12 AM'; 
    
    
    // Create SMS Body for request
    $sms_body = array(
        'action' => 'send-sms',
        'api_key' => $api_key,
        'to' => $destination,
        'from' => $from,
        'sms' => $sms,
        'schedule' => $schedule_time
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