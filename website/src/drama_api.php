<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
       
        $curl = curl_init("http://php-api/categories?category=drame");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        $movies = json_decode($response, true);
        
        if ($movies !== null){
            foreach ($movies as $movie) {
                echo "<div class='movie'>";
                
                echo "<h2>{$movie['title']}</h2>";
                echo "<img src='./img/{$movie['image']}.jpg' width='300px' height='400px'>";
                
                echo "<div id='learnmore'>";
            echo "<button type='button'>";
            echo "<a href='movie.php?id={$movie['id_movie']}'><svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-film' viewBox='0 0 16 16'>";
            echo "<path d='M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm4 0v6h8V1zm8 8H4v6h8zM1 1v2h2V1zm2 3H1v2h2zM1 7v2h2V7zm2 3H1v2h2zm-2 3v2h2v-2zM15 1h-2v2h2zm-2 3v2h2V4zm2 3h-2v2h2zm-2 3v2h2v-2zm2 3h-2v2h2z'/>";
            echo "</svg><span>&nbspLearn more</span></a>";
            echo "</button>";
            echo "</div>";
            echo "</div>";
            }
        }else{
            echo "Erreur lors de la conversion de la réponse JSON.";
        }
        
            
        
    }