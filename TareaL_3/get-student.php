<?php
// Decodifica el archivo JSON a un array asociativo de PHP
$data = json_decode(file_get_contents('data.json'), true);

// Comprueba si se ha pasado un parámetro 'id' en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Verifica si el estudiante con el ID proporcionado existe
    if (isset($data[$id])) {
        // Muestra los datos del estudiante en formato JSON
        header('Content-Type: application/json');
        echo json_encode($data[$id]);
    } else {
        // Si el estudiante no existe, muestra un mensaje de error
        header('HTTP/1.0 404 Not Found');
        echo json_encode(array('error' => 'Estudiante no encontrado.'));
    }
} else {
    // Si no se ha proporcionado un ID, muestra la lista completa de estudiantes
    header('Content-Type: application/json');
    echo json_encode($data);
}
?>
