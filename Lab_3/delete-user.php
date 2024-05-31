<?php
include('data.php');

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $id = $_GET['id'];

    if (isset($users[$id])) {
        unset($users[$id]);
        echo json_encode($users);
        http_response_code(204);
        echo json_encode(["mensaje" => "Usuario eliminado"]);
    } else {
        http_response_code(404);
        echo json_encode(["mensaje" => "Usuario no encontrado"]);
    }
}
?>