<?php
class SearchController {
    public function searchMovies($query) {
        
        $conn = Database::getInstance();
        $stmt = $conn->prepare("SELECT movie.id_movie, movie.title, movie.image FROM movie INNER JOIN director ON movie.director_id = director.id_director WHERE movie.title LIKE :query OR CONCAT(director.fname, ' ', director.lname) LIKE :query");
        $stmt->execute(array(':query' => '%' . $query . '%'));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            
            http_response_code(200);
            echo json_encode($results);
        } else {
            
            http_response_code(404);
            echo json_encode(["message" => "No result found."]);
        }
        
    }
}