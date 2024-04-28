<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <LINK rel="stylesheet" type="text/css" href="style/categories.css">
</head>
<body>
<?php require "basicheader.php"; ?>

<div id="categ">
    <h1><a href="action.php">Action</a></h1>
    <h1><a href="drama.php">Drama</a></h1>
</div>
<h2>Action movies:</h2>
<div id="results">
<?php
    // Appel de l'API pour récupérer les films de la catégorie "action"
    $api_url = "http://php-api/categories.php?categories=Action"; // Modifier l'URL ici
    $movies_json = file_get_contents($api_url);
    $movies = json_decode($movies_json, true);

    foreach ($movies as $movie_data) {
        echo "<div class='movie'>";
        
        echo "<h2>{$movie_data['title']}</h2>";
        echo "<img src='./img/{$movie_data['image']}.jpg' width='300px'>";
        
        echo "<div id='learnmore'>";
        echo "<button type='button'>";
        echo "<a href='movie.php?id={$movie_data['id_movie']}'><svg xmlns='http://www.w3.org/2000/svg'";
    }
    ?>
    </div>
</body>
</html>