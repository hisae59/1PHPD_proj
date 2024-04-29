<?php require "basicheader.php";

        // Tableau des ID de films à récupérer
        $movie_id = $_GET['id'];
        
        // Parcourir chaque ID de film
    
            // Appeler l'API pour récupérer les informations du film avec l'ID spécifié
            $curl = curl_init("http://php-api/movie_index?id=$movie_id");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);
    
            // Décoder la réponse JSON
            $movie_data = json_decode($response, true);
    
            // Vérifier si les données du film ont été récupérées avec succès
            if ($movie_data && isset($movie_data['id_movie'])) {
                echo "<div class='movie'>";
                
                echo "<div id='affiche'><div id='title'><h1>{$movie_data['title']}</h1>";
                echo "<h4>Directed by {$movie_data['director_fname']} {$movie_data['director_lname']}</h4>";
                echo "<h4>Actors : {$movie_data['actors']}</h4></div>";
                echo "<img src='./img/{$movie_data['image']}.jpg' width='30%'></div>";
                
                echo "<div id='synopsis'><h3>Synopsis:</h3><p>{$movie_data['synopsis']}</p>";
                echo "{$movie_data['video']}";
                echo "<h2>Price: {$movie_data['price']}€</h2>";
                echo "<div id='cartbtn'><form id='FormCart' action='panier.php' method='POST'><input type='hidden' name='id_movie' value='{$movie_data['id_movie']}'><button id='cart' type='submit' name='addmovie'>Add to cart <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-cart' viewBox='0 0 16 16'>
            <path d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2'/>
          </svg></button></form></div></div></div>";
                    


                    
              require "footer.php";
                
                
                
            } else {
                echo "Movie not found for ID: $id_movie ";
            }

        
        
       