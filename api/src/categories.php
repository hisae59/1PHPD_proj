<?php

require_once 'database/database.php';

class CategoryController {
    public function getMoviesByCategory() {
        $categoryName = $_GET['category'] ?? null;
        
        if (!$categoryName) {
            http_response_code(400);
            echo json_encode(["message" => "Category name is missing"]);
            return;
        }
        $conn = Database::getInstance();
        $sql = "SELECT movie.id_movie, movie.title, movie.image, movie.price, director.fname AS director_fname, director.lname AS director_lname
                FROM movie
                LEFT JOIN director ON movie.director_id = director.id_director
                INNER JOIN film_categ ON movie.id_movie = film_categ.id_movie
                INNER JOIN categories ON film_categ.id_categ = categories.id_categorie
                WHERE categories.name = :category";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category', $categoryName);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(["message" => "No movies found for the specified category"]);
            return;
        }

        $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($movies);
    }
}