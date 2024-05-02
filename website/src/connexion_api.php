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
    

    $response = json_decode($response, true);

    if ($response && $response['message'] == 'Login successful.') {
        // Démarrer la session et stocker les informations de l'utilisateur
        
        $_SESSION['user'] = $response['user'];
        header('Location: connexion.php');
        exit;
    
    }   
    
    else {
        $error_message = $response['message'] ?? 'Erreur de connexion';
        header('Location: connexion.php');
        exit;
    }
}




    

