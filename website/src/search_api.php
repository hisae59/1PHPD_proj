<?php
// Utiliser cURL pour envoyer une requête GET à l'API de recherche avec la chaîne de recherche
$query = $_GET['query'] ?? '';

if (!empty($query)) {
    $url = "http://php-api/search?query=" . urlencode($query);
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    
    // Traiter la réponse et afficher les résultats sur la page search.php
    $movies = json_decode($response, true);

    if (isset($movies['message']) && $movies['message'] === "No result found."){
        echo "<h2>Aucun résulat trouvé.</h2>"; 
    }else{
        // Afficher les résultats dans la page search.php
        foreach ($movies as $movie) {
            echo "<div class='movie'>";
            echo "<h2>" . $movie['title'] . "</h2>";
            echo "<img src='./img/{$movie['image']}.jpg' alt='" . $movie['title'] . "' width='300px'>";
            echo "<div id='learnmore'>";
            echo "<button type='button'>";
            echo "<a href='movie.php?id={$movie['id_movie']}'><svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-film' viewBox='0 0 16 16'>";
            echo "<path d='M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm4 0v6h8V1zm8 8H4v6h8zM1 1v2h2V1zm2 3H1v2h2zM1 7v2h2V7zm2 3H1v2h2zm-2 3v2h2v-2zM15 1h-2v2h2zm-2 3v2h2V4zm2 3h-2v2h2zm-2 3v2h2v-2zm2 3h-2v2h2z'/>";
            echo "</svg>";
            echo "<span> Learn more</span></a>";
            echo "</button>";
            echo "</div>";
            echo "</div>";
       
        }
    }
    
   
}
