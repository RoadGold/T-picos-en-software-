<?php
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "pro";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
