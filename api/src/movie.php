<?php

require_once 'database/database.php';

class MovieController {
    public function getMovie() {
        // Récupérer l'ID du film à partir de la requête GET
        $id = $_GET['id'] ?? null;
        if (!$id) {
            http_response_code(400);
            echo json_encode(["message" => "ID of the movie is missing"]);
            return;
        }

        // Se connecter à la base de données
        $conn = Database::getInstance();

        // Préparer la requête SQL pour récupérer les informations du film
        $sql = "SELECT movie.*, director.fname AS director_fname, director.lname AS director_lname
                FROM movie
                LEFT JOIN director ON movie.director_id = director.id
                WHERE movie.id_movie = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Vérifier si le film existe
        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(["message" => "Movie not found"]);
            return;
        }

        // Récupérer les données du film
        $movie = $stmt->fetch(PDO::FETCH_ASSOC);

        // Préparer la requête pour récupérer les catégories du film
        $sqlCategories = "SELECT categories.name
                          FROM categories
                          INNER JOIN film_categ ON categories.id = film_categ.id_categ
                          WHERE film_categ.id_movie = :id";

        $stmtCategories = $conn->prepare($sqlCategories);
        $stmtCategories->bindParam(':id', $id);
        $stmtCategories->execute();

        // Récupérer les catégories du film
        $categories = $stmtCategories->fetchAll(PDO::FETCH_COLUMN);

        // Ajouter les catégories au tableau du film
        $movie['categories'] = $categories;

        // Envoyer les données du film en JSON
        header('Content-Type: application/json');
        echo json_encode($movie);
    }
    public function getActionMovies() {
        // Se connecter à la base de données
        $conn = Database::getInstance();

        // Préparer la requête SQL pour récupérer les films de la catégorie "action"
        $sql = "SELECT movie.*, director.fname AS director_fname, director.lname AS director_lname
                FROM movie
                LEFT JOIN director ON movie.director_id = director.id
                INNER JOIN film_categ ON movie.id_movie = film_categ.id_movie
                INNER JOIN categories ON film_categ.id_categ = categories.id
                WHERE categories.name = 'action'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // Vérifier s'il y a des résultats
        if ($stmt->rowCount() > 0) {
            // Afficher les films de la catégorie "action"
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='movie'>";
                echo "<h2>{$row['title']}</h2>";
                echo "<img src='./img/{$row['image']}.jpg' width='300px'>";
                echo "<div id='learnmore'>";
                echo "<button type='button'>";
                echo "<a href='movie.php?id={$row['id_movie']}'><svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-film' viewBox='0 0 16 16'>";
                echo "<path d='M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm4 0v6h8V1zm8 8H4v6h8zM1 1v2h2V1zm2 3H1v2h2zM1 7v2h2V7zm2 3H1v2h2zm-2 3v2h2v-2zM15 1h-2v2h2zm-2 3v2h2V4zm2 3h-2v2h2zm-2 3v2h2v-2zm2 3h-2v2h2z'/>";
                echo "</svg><span> Learn more</span></a>";
                echo "</button>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "No action movies found";
        }
    }
}


    
