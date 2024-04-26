<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie</title>
    <LINK rel="stylesheet" type="text/css" href="style/movie.css">
</head>
<body>
    <?php require "basicheader.php";

        // Tableau des ID de films à récupérer
        $movie_ids = $_GET['id'];
    
        // Parcourir chaque ID de film
    
            // Appeler l'API pour récupérer les informations du film avec l'ID spécifié
            $curl = curl_init("http://php-api/movie?id=$movie_ids");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);
    
            // Décoder la réponse JSON
            $movie_data = json_decode($response, true);
    
            // Vérifier si les données du film ont été récupérées avec succès
            if ($movie_data && isset($movie_data['id_movie'])) {
                echo "<div class='movie'>";
                
                echo "<div id='affiche'><div id='title'><h1>{$movie_data['title']}</h1>";
                echo "Directed by {$movie_data['director_fname']} {$movie_data['director_lname']}</div>";
                echo "<img src='./img/{$movie_data['image']}.jpg' width='30%'></div>";
                
                echo "<div id='synopsis'><h3>Synopsis:</h3><p>{$movie_data['synopsis']}</p>";
                echo "{$movie_data['video']}";
                echo "<h2>Price: {$movie_data['price']}€</h2></div></div>";
                echo "<div id='cartbtn'><button id='cart'>Add to cart <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-cart' viewBox='0 0 16 16'>
                <path d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2'/>
              </svg></button></div>";
            } else {
                echo "Movie not found for ID: $id_movie ";
            }
       
        require "footer.php";
    ?>
    
</body>
</html>