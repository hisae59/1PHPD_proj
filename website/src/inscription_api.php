<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $curl = curl_init();

    $postData = [
        'name' => $_POST['name'] ?? '',
        'firstname' => $_POST['firstname'] ?? '',
        'mail' => $_POST['mail'] ?? '',
        'mdp' => $_POST['mdp'] ?? '',
    ];

    
    $postDataJson = json_encode($postData);

    curl_setopt($curl, CURLOPT_URL, "http://php-api/users");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postDataJson);

   
    $response = curl_exec($curl);

    
    if (curl_errno($curl)) {
        echo 'Erreur cURL : ' . curl_error($curl);
    } else {
        
        preg_match_all('/\{(?:[^{}]|(?R))*\}/', $response, $matches);

        foreach ($matches[0] as $jsonObject) {
            
            $responseData = json_decode($jsonObject, true);

            if (isset($responseData['message'])) {
                echo json_encode(["message" => $responseData['message']]);
                break;
            }
    
        }
    
    }
    

    curl_close($curl);
}