<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $curl = curl_init();

    $postData = [
        'name' => $_POST['name'] ?? '',
        'firstname' => $_POST['firstname'] ?? '',
        'mail' => $_POST['mail'] ?? '',
        'mdp' => $_POST['mdp'] ?? '',
    ];

    // Convertir les données du formulaire en JSON
    $postDataJson = json_encode($postData);

    curl_setopt($curl, CURLOPT_URL, "http://php-api/users");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postDataJson);

    // Exécution de la requête et récupération de la réponse
    $response = curl_exec($curl);

    // Vérification des erreurs
    if (curl_errno($curl)) {
        echo 'Erreur cURL : ' . curl_error($curl);
    } else {
        //header("Location: ../connexion.php");
        //exit;
        preg_match_all('/\{(?:[^{}]|(?R))*\}/', $response, $matches);

        foreach ($matches[0] as $jsonObject) {
            
            $responseData = json_decode($jsonObject, true);

            if (isset($responseData['message'])) {
                echo json_encode(["message" => $responseData['message']]);
                break;
            }
    
        }
    
    }
    
    // Fermeture de la session cURL
    curl_close($curl);
}
