<?php
header('Content-Type: application/json');
require_once 'database/database.php';
require_once 'utils/bcrypt.php';
class CartController {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    public function getCart($id_user) {
        
        try {
            $stmt = $this->conn->prepare("SELECT  cart.id, movie.title, movie.image, movie.price FROM cart JOIN movie ON cart.id_movie = movie.id_movie WHERE cart.id_user = :id_user");
            $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
            $stmt->execute();
            
            $cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            http_response_code(200);
            echo json_encode($cart);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["message" => "Database error: " . $e->getMessage()]);
        }
    }

    public function addToCart($id_user, $id_movie) {
        try {
            $stmt_check = $this->conn->prepare("SELECT id FROM cart WHERE id_user = :id_user AND id_movie = :id_movie");
            $stmt_check->bindParam(":id_user", $id_user);
            $stmt_check->bindParam(":id_movie", $id_movie);
            $stmt_check->execute();
            $existing_cart_item = $stmt_check->fetch(PDO::FETCH_ASSOC);
    
            if ($existing_cart_item) {
                http_response_code(400);
                echo json_encode(["message" => "The movie is already in the cart."]);
            } else {
                $stmt_insert = $this->conn->prepare("INSERT INTO cart (id_user, id_movie) VALUES (:id_user, :id_movie)");
                $stmt_insert->bindParam(":id_user", $id_user);
                $stmt_insert->bindParam(":id_movie", $id_movie);
                if ($stmt_insert->execute()) {
                    http_response_code(200);
                    echo json_encode(["message" => "Movie added to cart."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Failed to add movie to cart."]);
                }
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["message" => "Database error: " . $e->getMessage()]);
        }
    }

    public function removeFromCart($id_cart) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM cart WHERE cart.id = :id_cart");
            $stmt->bindParam(":id_cart", $id_cart);
            if ($stmt->execute()) {
                http_response_code(200);
                echo json_encode(["message" => "Movie removed from cart."]);
            } else {
                http_response_code(500);
                echo json_encode(["message" => "Failed to remove movie from cart."]);
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["message" => "Database error: " . $e->getMessage()]);
        }
    }
}
