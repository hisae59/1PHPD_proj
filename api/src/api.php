<?php

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
            default:
                http_response_code(404);
                echo json_encode(["message" => "The requested URL was not found on this server."]);
                break;
        }
    }
}
