<?php
include('data.php');
header("Content-Type: application/json");
$data_post = $_POST;

if (isset($data_post['nombre']) && isset($data_post['email'])) {
    $new_user = [
        "id" => count($users) + 1,
        "nombre" => $data_post['nombre'],
        "email" => $data_post['email']
    ];

    http_response_code(201);
    array_push($users, $new_user);
    echo json_encode($users);
} else {
    http_response_code(400);
    echo json_encode(["mensaje" => "Datos invalidos"]);
}
?>