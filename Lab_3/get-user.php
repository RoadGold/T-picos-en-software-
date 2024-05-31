<?php
include('data.php');
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if(array_key_exists($id, $users)) {
            echo json_encode($users[$id]);
            http_response_code(200);
        } else {
            echo json_encode(["mensaje" => "Usuario no encontrado"]);
            http_response_code(404);
        }
    } else {
        echo json_encode($users);
        http_response_code(200);
    }
}
?>