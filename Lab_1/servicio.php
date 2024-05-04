<?php
// Definir la f u n c i n del servicio web
function obtenerSaludo ( $nombre ) {
    return "Hola , $nombre!" ;
}
// Obtener el nombre del p a r m e t r o desde la URL
$nombre = $_GET ["nombre"];
// Invocar la f u n c i n del servicio web y obtener el resultado
$resultado = obtenerSaludo ( $nombre ) ;
// Enviar el resultado en formato XML
header ( 'Content-Type: application/xml');
echo "<respuesta>";
echo "<mensaje>$resultado</mensaje>";
echo "</respuesta>";
?>