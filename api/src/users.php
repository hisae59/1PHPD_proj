<?php
    header('Content-Type: application/json');
    require_once 'database/database.php';
    require_once 'utils/bcrypt.php';
    
    class UsersController{
        private $conn;
        private $bcrypt;
    
        public function __construct() {
            $this->conn = Database::getInstance();
            $this->bcrypt = new BcryptUtil();
        }

        public function createUser() {
            try {
                $data = json_decode(file_get_contents("php://input"), true);
                print_r(json_encode($data));
                
                if (!empty($data['name']) && !empty($data['firstname']) && !empty($data['mail']) && !empty($data['mdp'])) {
                    $query = "INSERT INTO users (fname, lname, email, pssword) VALUES (:name, :firstname, :mail, :mdp)";
                    $stmt = $this->conn->prepare($query);
                    
                    $name = $data["name"];
                    $firstname = $data["firstname"];
                    $mail = $data["mail"];
                    $mdp = $this->bcrypt->hash($data["mdp"]);

                    $stmt->bindParam(":name", $name);
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":mail", $mail);
                    $stmt->bindParam(":mdp", $mdp);
                    
                    if ($stmt->execute()) {
                        
                        
                        http_response_code(200);
                        echo json_encode(["message" => "User created. You can now login ! "]);
                        
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(["message" => "Body with properties required."]);
                }
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(["message" => "Error while inserting user: " . $e->getMessage()]);
            }
        }
        public function getUserCart($id_user) {
            try {
                $stmt = $this->conn->prepare("SELECT movie.id AS movie_id, movie.title, movie.synopsis, movie.price, movie.image
                FROM cart
                INNER JOIN movie ON cart.id_movie = movie.id
                WHERE cart.id_user = :id_user");
                $stmt->bindParam(":id_user", $id_user);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Gérer les erreurs de base de données
                return [];
            }
        }

        public function loginUser() {
            try {
                $input = json_decode(file_get_contents('php://input'), true);
                $mail = $input['mail'] ?? '';
                $mdp = $input['mdp'] ?? '';
                
                if (!$mail || !$mdp) {
                    http_response_code(400);
                    echo json_encode(["message" => "Email and password required."]);
                    return;
                }
        
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :mail");
                $stmt->bindParam(":mail", $mail);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                
                if ($user && password_verify($mdp, $user['pssword'])) {
                    http_response_code(200);
                    $cart = $this->getUserCart($user['id_user']);
                    echo json_encode(["message" => "Login successful.", "user" => [
                        "fname" => $user['fname'],
                        "lname" => $user['lname'],
                        "email" => $user['email'], 
                        "id_user" => $user['id_user'],
                        "cart" => $cart
                    ]
                ]);
                } else {
                    http_response_code(401);
                    echo json_encode(["message" => "Invalid credentials."]);
                }
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(["message" => "Database error: " . $e->getMessage()]);
            }
        }

    }