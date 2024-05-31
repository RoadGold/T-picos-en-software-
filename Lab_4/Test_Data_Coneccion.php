<?php
require 'Data_Coneccion.php';

$dbConnection = new DatabaseConnection();
$conn = $dbConnection->getConnection();

// Usar $conn para realizar operaciones en la base de datos
// Ejm: $table = Clase::fetchAll($conn);
?>