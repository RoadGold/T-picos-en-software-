<?php
// Verificar si la solicitud es PUT
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Leer la entrada de la solicitud
    parse_str(file_get_contents('php://input'), $_PUT);

    // Lee el contenido del archivo JSON y decodifícalo a un array asociativo de PHP
    $data = json_decode(file_get_contents('data.json'), true);

    // Obtener los datos enviados en la solicitud PUT
    $updated_student = array(
        "id" => isset($_PUT['id']) ? (int)$_PUT['id'] : null,
        "nombre" => isset($_PUT['nombre']) ? $_PUT['nombre'] : null,
        "curso" => isset($_PUT['curso']) ? $_PUT['curso'] : null,
        "nota" => isset($_PUT['nota']) ? (int)$_PUT['nota'] : null
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
    // Si no se usa el método PUT, mostrar un mensaje de error
    header('HTTP/1.0 405 Method Not Allowed');
    echo json_encode(array('error' => 'Método no permitido.'));
}
?>
