<?php



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = $_POST['mail'];
    $mdp = $_POST['mdp'];
    
    $curl = curl_init('http://php-api/login');
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(['mail' => $mail, 'mdp' => $mdp]));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    
    // Décoder la réponse avant d'envoyer tout contenu
    $response = json_decode($response, true);

    if ($response && $response['message'] == 'Login successful.') {
        // Démarrer la session et stocker les informations de l'utilisateur
        
        $_SESSION['user'] = $response['user'];
        
        // Rediriger vers index.php
        header('Location: connexion.php');
        exit;
    
    } else {
        // Gérer l'échec de la connexion
        $error_message = $response['message'] ?? 'Erreur de connexion';
        echo $error_message; // Envoyer le contenu après toute gestion des en-têtes
    }
}