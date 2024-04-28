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

        // Préparer la requête pour récupérer les acteurs du film
        $sqlActors = "SELECT actor.fname, actor.lname
                      FROM actor
                      INNER JOIN film_actor ON actor.id = film_actor.id_actor
                      WHERE film_actor.id_film = :id";

        $stmtActors = $conn->prepare($sqlActors);
        $stmtActors->bindParam(':id', $id);
        $stmtActors->execute();

        // Récupérer les acteurs du film
        $actors = $stmtActors->fetchAll(PDO::FETCH_ASSOC);

        // Ajouter les acteurs au tableau du film
        $movie['actors'] = $actors;


        // Envoyer les données du film en JSON
        header('Content-Type: application/json');
        echo json_encode($movie);
    }
}


    
