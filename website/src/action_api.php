<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Tableau des ID de films à récupérer
        // Appeler l'API pour récupérer les informations du film avec l'ID spécifié
        $curl = curl_init("http://php-api/categories?category=action");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        // Décoder la réponse JSON
        $movies = json_decode($response, true);

        // Vérifier si les données du film ont été récupérées avec succès
        if ($movies && isset($movies['message'])) {
            echo $movies['message'];
        } else {
            foreach ($movies as $movie_data) {
                echo "<div class='movie'>";
                
                echo "<h2>{$movie_data['title']}</h2>";
                echo "<img src='./img/{$movie_data['image']}.jpg' width='300px'>";
                
                echo "<div id='learnmore'>";
                echo "<button type='button'>";
                echo "<a href='movie.php?id={$movie_data['id_movie']}'><svg xmlns='http://www.w3.org/2000/svg'";
            }
        }
    }