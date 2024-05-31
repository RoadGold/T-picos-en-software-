<?php
include('data.php');
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = $_GET;
    $id = $data['id'];

    if (isset($users[$id])) {
        http_response_code(200);
        $users[$id] = array_merge($users[$id], $data);
        echo json_encode($users);
    } else {
        http_response_code(404);
        echo json_encode(["mensaje" => "Usuario no encontrado"]);
    }
}
?>