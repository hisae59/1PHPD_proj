<?php
// Inclure le fichier de connexion à la base de données
require_once 'database/database.php';

// Vérifier si la catégorie est spécifiée dans l'URL
if (isset($_GET['categories'])) {
    // Récupérer la catégorie depuis l'URL
    $category = $_GET['categories'];

    // Requête SQL pour sélectionner tous les films de la catégorie spécifiée
    $sql = "SELECT movie.*, director.fname AS director_fname, director.lname AS director_lname
            FROM movie
            LEFT JOIN director ON movie.director_id = director.id
            INNER JOIN film_categ ON movie.id_movie = film_categ.id_movie
            INNER JOIN categories ON film_categ.id_categ = categories.id
            WHERE categories.name = :category";

    // Préparer la requête SQL
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':category', $category);
    $stmt->execute();

    // Vérifier s'il y a des résultats
    if ($stmt->rowCount() > 0) {
        // Récupérer les résultats de la requête et les stocker dans un tableau
        $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Convertir le tableau en format JSON et le renvoyer
        header('Content-Type: application/json');
        echo json_encode($movies);
    } else {
        // Si aucun film n'est trouvé pour la catégorie spécifiée, renvoyer un message d'erreur
        http_response_code(404);
        echo json_encode(["message" => "No movies found for the specified category"]);
    }
} else {
    // Si aucune catégorie n'est spécifiée dans l'URL, renvoyer un message d'erreur
    http_response_code(400);
    echo json_encode(["message" => "Categories parameter is missing"]);
}


