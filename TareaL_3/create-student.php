<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lee el contenido del archivo JSON y decodifícalo a un array asociativo de PHP
    $data = json_decode(file_get_contents('data.json'), true);

    // Obtener los datos enviados en la solicitud POST
    $new_student = array(
        "id" => isset($_POST['id']) ? (int)$_POST['id'] : null,
        "nombre" => isset($_POST['nombre']) ? $_POST['nombre'] : null,
        "curso" => isset($_POST['curso']) ? $_POST['curso'] : null,
        "nota" => isset($_POST['nota']) ? (int)$_POST['nota'] : null
    );

    // Validar los datos del nuevo estudiante
    if ($new_student['id'] === null || $new_student['nombre'] === null || $new_student['curso'] === null || $new_student['nota'] === null) {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array('error' => 'Datos incompletos o inválidos.'));
        exit;
    }

    // Verificar si el ID ya existe
    if (isset($data[$new_student['id']])) {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array('error' => 'ID de estudiante ya existe.'));
        exit;
    }

    // Agregar el nuevo estudiante al array
    $data[$new_student['id']] = $new_student;

    // Guardar el array actualizado de vuelta al archivo JSON
    file_put_contents('data.json', json_encode($data, JSON_PRETTY_PRINT));

    // Devolver una respuesta de éxito
    header('Content-Type: application/json');
    echo json_encode(array('message' => 'Estudiante agregado exitosamente.'));
} else {
    // Si no se usa el método POST, mostrar un mensaje de error
    header('HTTP/1.0 405 Method Not Allowed');
    echo json_encode(array('error' => 'Método no permitido.'));
}
?>
