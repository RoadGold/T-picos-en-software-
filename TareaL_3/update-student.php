<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lee el contenido del archivo JSON y decodifícalo a un array asociativo de PHP
    $data = json_decode(file_get_contents('data.json'), true);

    // Obtener los datos enviados en la solicitud POST
    $updated_student = array(
        "id" => isset($_POST['id']) ? (int)$_POST['id'] : null,
        "nombre" => isset($_POST['nombre']) ? $_POST['nombre'] : null,
        "curso" => isset($_POST['curso']) ? $_POST['curso'] : null,
        "nota" => isset($_POST['nota']) ? (int)$_POST['nota'] : null
    );

    // Validar que el ID está presente y no es nulo
    if ($updated_student['id'] === null) {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array('error' => 'ID del estudiante es requerido.'));
        exit;
    }

    // Verificar si el estudiante con el ID proporcionado existe
    if (!isset($data[$updated_student['id']])) {
        header('HTTP/1.0 404 Not Found');
        echo json_encode(array('error' => 'Estudiante no encontrado.'));
        exit;
    }

    // Actualizar solo los campos proporcionados (no nulos)
    foreach ($updated_student as $key => $value) {
        if ($value !== null) {
            $data[$updated_student['id']][$key] = $value;
        }
    }

    // Guardar el array actualizado de vuelta al archivo JSON
    file_put_contents('data.json', json_encode($data, JSON_PRETTY_PRINT));

    // Devolver una respuesta de éxito
    header('Content-Type: application/json');
    echo json_encode(array('message' => 'Estudiante actualizado exitosamente.'));
} else {
    // Si no se usa el método POST, mostrar un mensaje de error
    header('HTTP/1.0 405 Method Not Allowed');
    echo json_encode(array('error' => 'Método no permitido.'));
}
?>
