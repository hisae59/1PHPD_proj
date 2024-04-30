<?php

require_once 'database/database.php';

class CategoryController {
    public function getMoviesByCategory() {
        // Récupérer le nom de la catégorie à partir de la requête GET
        $categoryName = $_GET['category'] ?? null;
        
        if (!$categoryName) {
            http_response_code(400);
            echo json_encode(["message" => "Category name is missing"]);
            return;
        }

        // Se connecter à la base de données
        $conn = Database::getInstance();

        // Préparer la requête SQL pour récupérer les informations des films ayant la catégorie spécifiée
        $sql = "SELECT movie.id_movie, movie.title, movie.image, movie.price, director.fname AS director_fname, director.lname AS director_lname
                FROM movie
                LEFT JOIN director ON movie.director_id = director.id
                INNER JOIN film_categ ON movie.id_movie = film_categ.id_movie
                INNER JOIN categories ON film_categ.id_categ = categories.id
                WHERE categories.name = :category";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category', $categoryName);
        $stmt->execute();

        // Vérifier si des films ont été trouvés pour la catégorie spécifiée
        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(["message" => "No movies found for the specified category"]);
            return;
        }

        // Récupérer les données des films
        $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Envoyer les données des films en JSON
        header('Content-Type: application/json');
        echo json_encode($movies);
    }
}