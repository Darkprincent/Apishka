

<?php
header('Content-Type: application/json');
require 'connetDB.php';
require 'function.php';

$method = $_SERVER['REQUEST_METHOD'];

$params = explode('/', $_GET['q']);
$type = $params [0];
if (isset($params[1])) {
    $id = $params[1];
}

switch ($method) {
    case 'GET':
        if ($method === 'GET') {
            http_response_code(404);
            if (isset($id)) {
                getPost($pdo, $id);
            } else {
                getPosts($pdo);
            }
        }
        break;
    case 'POST':
                http_response_code(201);
                addPost($pdo, $_POST, $id);
        break;
    case 'DELETE': 
                http_response_code(410);
                deletePost($pdo, $id);
        break;
    case 'PATCH': 
                if ($type === 'posts') {
                    if (isset($id)) {
                    $data = file_get_contents('php://input');
                    $data = json_decode($data, true);
                    updatePost($pdo, $data, $id);
                    }
                }
        break;
}