<?php
// Verificar si la solicitud es DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Leer la entrada de la solicitud
    parse_str(file_get_contents('php://input'), $_DELETE);

    // Lee el contenido del archivo JSON y decodifícalo a un array asociativo de PHP
    $data = json_decode(file_get_contents('data.json'), true);

    // Asegurarse de que $data sea un array
    if (!is_array($data)) {
        $data = [];
    }

    // Obtener el parámetro 'id' enviado en la solicitud DELETE
    $id = isset($_DELETE['id']) ? $_DELETE['id'] : null;

    // Validar que el parámetro 'id' está presente
    if ($id === null) {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array('error' => 'ID del estudiante es requerido.'));
        exit;
    }

    // Verificar si el parámetro es 'all'
    if ($id === 'all') {
        // Eliminar todos los estudiantes
        $data = array();

        // Guardar el array vacío de vuelta al archivo JSON
        file_put_contents('data.json', json_encode($data, JSON_PRETTY_PRINT));

        // Devolver una respuesta de éxito con los datos actualizados
        header('Content-Type: application/json');
        echo json_encode(array('message' => 'Todos los estudiantes han sido eliminados exitosamente.', 'data' => $data));
    } else {
        // Verificar si el estudiante con el ID proporcionado existe
        if (!isset($data[$id])) {
            header('HTTP/1.0 404 Not Found');
            echo json_encode(array('error' => 'Estudiante no encontrado.'));
            exit;
        }

        // Eliminar el estudiante con el ID especificado
        unset($data[$id]);

        // Guardar el array actualizado de vuelta al archivo JSON
        file_put_contents('data.json', json_encode($data, JSON_PRETTY_PRINT));

        // Devolver una respuesta de éxito con los datos actualizados
        header('Content-Type: application/json');
        echo json_encode(array('message' => 'Estudiante eliminado exitosamente.', 'data' => $data));
    }
} else {
    // Si no se usa el método DELETE, mostrar un mensaje de error
    header('HTTP/1.0 405 Method Not Allowed');
    echo json_encode(array('error' => 'Método no permitido.'));
}
?>
