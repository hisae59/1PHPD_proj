<?php

require_once 'users.php';
require_once 'cart.php';
require_once 'movie.php';
require_once 'search.php';

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
                                $id_user = $_GET['id_user'] ;  
                                $id_movie = $_GET['id_movie'] ?? null;  
                                $controller->addToCart($id_user, $id_movie);
                                break;
                            case 'DELETE':
                                $id_cart = $_GET['id_cart'];
                                $controller->removeFromCart($id_cart);
                                break;
                            default:
                                http_response_code(405);
                                echo json_encode(["message" => "Method not allowed"]);
                                break;
                        }
                        break;
            case 'movie_index': // Nouveau cas pour récupérer les informations d'un film
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
            case 'search':
                    $controller = new SearchController();
                    switch ($requestMethod) {
                        case 'GET':
                            $query=$_GET['query'];
                            $controller->searchMovies($query);
                            break;
                        default:
                            http_response_code(405);
                            echo json_encode(["message" => "Method not allowed"]);
                            break;
                    }
            break;
            

            default:
                http_response_code(404);
                echo json_encode(["message" => "The requested URL was not found on this server."]);
                break;
        }
    }
}
