<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') { // Vérifier si la méthode HTTP est GET
    // Récupérer l'id de l'utilisateur depuis la session ou la requête
    $id_user = $_SESSION['user']['id_user'] ?? null; // Adapté selon la structure de votre session
    
    // Vérifier si l'id de l'utilisateur est disponible
    if ($id_user) {
        // Appeler l'API pour récupérer les films du panier de l'utilisateur
        $curl = curl_init("http://php-api/cart?id_user=$id_user"); // URL de l'API
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        // Vérifier si la réponse de l'API est valide
        if ($response) {
            // Afficher les films du panier de l'utilisateur
            echo $response;
            $movies = json_decode($response, true);
    
            // Vérifier si la conversion JSON a réussi
            if ($movies !== null) {
            // Parcourir chaque film et afficher son titre
                foreach ($movies as $movie) {
                    echo $movie['title'] . "<br>";
                }
            
            } else {
                // Gérer les erreurs de conversion JSON
                echo "Erreur lors de la conversion de la réponse JSON.";
            }
        } else {
            // Gérer les erreurs de récupération du panier
            echo json_encode(["message" => "Erreur lors de la récupération du panier."]);
        }
    } else {
        // Gérer l'absence d'id utilisateur
        echo json_encode(["message" => "ID utilisateur non disponible."]);
    }
} else {
    // Gérer les requêtes non autorisées
    http_response_code(405);
    echo json_encode(["message" => "Méthode non autorisée."]);
}