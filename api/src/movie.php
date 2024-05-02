<?php

require_once 'database/database.php';

class MovieController {
    public function getMovie() {
        
        $id = $_GET['id'] ?? null;
        if (!$id) {
            http_response_code(400);
            echo json_encode(["message" => "ID of the movie is missing"]);
            return;
        }

        
        $conn = Database::getInstance();

        
        $sql = "SELECT movie.*, director.fname AS director_fname, director.lname AS director_lname
                FROM movie
                LEFT JOIN director ON movie.director_id = director.id_director
                WHERE movie.id_movie = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        

        
        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(["message" => "Movie not found"]);
            return;
        }

        
        $movie = $stmt->fetch(PDO::FETCH_ASSOC);

        
        $sqlCategories = "SELECT categories.name
                          FROM categories
                          INNER JOIN film_categ ON categories.id_categorie = film_categ.id_categ
                          WHERE film_categ.id_movie = :id";

        $stmtCategories = $conn->prepare($sqlCategories);
        $stmtCategories->bindParam(':id', $id);
        $stmtCategories->execute();

        
        $categories = $stmtCategories->fetchAll(PDO::FETCH_COLUMN);

        
        $movie['categories'] = $categories;

        
        $sqlActors = "SELECT actor.fname, actor.lname
                      FROM actor
                      INNER JOIN film_actor ON actor.id_actor = film_actor.id_actor
                      WHERE film_actor.id_film = :id";

        $stmtActors = $conn->prepare($sqlActors);
        $stmtActors->bindParam(':id', $id);
        $stmtActors->execute();

        
        $actors = $stmtActors->fetchAll(PDO::FETCH_ASSOC);

        
        $movie['actors'] = $actors;


        
        header('Content-Type: application/json');
        echo json_encode($movie);
    }
}


    
