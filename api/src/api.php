<?php

require_once 'users.php';
require_once 'cart.php';
require_once 'movie.php';
require_once 'search.php';
require_once 'categories.php';


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
                                if (isset($_GET['id_cart'])) {
                                    $id_cart = $_GET['id_cart'];
                                    $controller->removeFromCart($id_cart);
                                } elseif (isset($_GET['clear_cart'])) {
                                    $id_user = $_GET['id_user'] ?? null;
                                    $controller->clearCart($id_user);
                                } else {
                                    http_response_code(400);
                                    echo json_encode(["message" => "Paramètre invalide pour supprimer le panier."]);
                                }break;
                            default:
                                http_response_code(405);
                                echo json_encode(["message" => "Method not allowed"]);
                                break;
                        }
                        break;
            case 'movie_index': 
                        $controller = new MovieController();
                        switch ($requestMethod) {
                            case 'GET':
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
            case 'categories':
                $controller= new CategoryController();
                switch ($requestMethod){
                    case 'GET':
                        $controller->getMoviesByCategory();
                        break;
                    default:
                        http_response_code(405);
                        echo json_encode(["message"=>"Method not allowed"]);
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
