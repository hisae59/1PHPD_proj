<?php

require_once 'users.php';
require_once 'cart.php';
require_once 'movie.php';

class ApiRouter {
    public function processRequest() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uriSegments = explode('/', trim($uri, '/'));
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        switch ($uriSegments[0]) {
            case '':
                switch ($requestMethod) {
                    case 'GET':
                        echo json_encode(["message" => "Hello World !"]);
                        break;
                    default:
                        http_response_code(405);
                        echo json_encode(["message" => "Method not allowed"]);
                        break;
                }
                break;
            case 'users':
                $controller = new UsersController();

                switch ($requestMethod) {
                    case 'POST':
                        $controller->createUser();
                        break;
                    default:
                        http_response_code(405);
                        echo json_encode(["message" => "Method not allowed"]);
                        break;
                }
                break;
            case 'login':
                    $controller = new UsersController();
                
                    switch ($requestMethod) {
                        case 'POST':
                            $controller->loginUser();
                            break;
                        default:
                            http_response_code(405);
                            echo json_encode(["message" => "Method not allowed"]);
                            break;
                    }
                    break;
            case 'cart': 
                        session_start();
                        $controller = new CartController();
                        switch ($requestMethod) {
                            case 'GET':
                                $id_user = $_GET['id_user'] ?? null;                                
                                $controller->getCart($id_user);
                                break;
                            case 'POST':
                                // Récupérer les données de la requête
                                $data = json_decode(file_get_contents('php://input'), true);
                                $id_user = $data['id_user'] ?? '';
                                $id_movie = $data['id_movie'] ?? '';
                                $controller->addToCart($id_user, $id_movie);
                                break;
                            case 'DELETE':
                                // Récupérer l'id du film à supprimer du panier depuis la requête
                                parse_str(file_get_contents('php://input'), $deleteParams);
                                $id_cart = $deleteParams['id_cart'] ?? '';
                                $controller->removeFromCart($id_cart);
                                break;
                            default:
                                http_response_code(405);
                                echo json_encode(["message" => "Method not allowed"]);
                                break;
                        }
                        break;
            case 'movie': // Nouveau cas pour récupérer les informations d'un film
                        $controller = new MovieController();
                        switch ($requestMethod) {
                            case 'GET':
                                // Appel de la méthode pour récupérer les informations du film
                                $controller->getMovie();
                                break;
                            default:
                                http_response_code(405);
                                echo json_encode(["message" => "Method not allowed"]);
                                break;
                        }
                        break;
            case 'film_categ':
                        $controller= new CategoriesController();
                        switch ($requestMethod){
                            case 'GET':
                                $category=
                                $controller->getMoviesByCategory($category);
                                break;
                            default:
                                http_response_code(405);
                                echo json_encode(["message"=>"Method not allowed"]);
                                break;
                        }
            

            default:
                http_response_code(404);
                echo json_encode(["message" => "The requested URL was not found on this server."]);
                break;
        }
    }
}