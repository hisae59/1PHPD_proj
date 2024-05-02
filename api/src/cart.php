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
            $stmt = $this->conn->prepare("SELECT cart.id, movie.title, movie.image, movie.price FROM cart JOIN movie ON cart.id_movie = movie.id_movie WHERE cart.id_user = :id_user");
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
            $stmt = $this->conn->prepare("INSERT INTO cart (id_user, id_movie) VALUES (:id_user, :id_movie)");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->bindParam(":id_movie", $id_movie);
            if ($stmt->execute()) {
                http_response_code(200);
                echo json_encode(["message" => "Movie added to cart."]);
            } else {
                http_response_code(500);
                echo json_encode(["message" => "Failed to add movie to cart."]);
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

    public function clearCart($id_user) {
        try {
            
            $stmt_check = $this->conn->prepare("SELECT COUNT(*) AS count FROM cart WHERE id_user = :id_user");
            $stmt_check->bindParam(":id_user", $id_user);
            $stmt_check->execute();
            $cart_count = $stmt_check->fetchColumn();
    
            if ($cart_count === 0) {
                http_response_code(400);
                echo json_encode(["message" => "The cart is already empty."]);
                return;
            }
    
            
            $stmt_delete = $this->conn->prepare("DELETE FROM cart WHERE id_user = :id_user");
            $stmt_delete->bindParam(":id_user", $id_user);
            if ($stmt_delete->execute()) {
                http_response_code(200);
                echo json_encode(["message" => "Cart successfully emptied."]);
            } else {
                http_response_code(500);
                echo json_encode(["message" => "Failed to delete cart."]);
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["message" => "Database Error : " . $e->getMessage()]);
        }
    }
}