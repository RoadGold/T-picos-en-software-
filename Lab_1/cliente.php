<?php
// Definir la URL del servicio web
$url_servicio_web = "http://localhost/laboratorios/lab_1/servicio.php";

// Enviar una solicitud al servicio web utilizando cURL
$ch = curl_init($url_servicio_web . "?nombre=Stefany");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$respuesta_xml = curl_exec($ch);
curl_close($ch);

// Convertir la respuesta XML a un objeto PHP
$respuesta = simplexml_load_string($respuesta_xml);
// Verificar si la carga XML fue exitosa
if($respuesta !== false) {
    // Extraer el mensaje de la respuesta XML
    $mensaje = $respuesta->mensaje;
    // Mostrar el mensaje en la pantalla
    echo "Mensaje del servicio web: $mensaje";
} else {
    // Manejar el caso en el que la carga XML falló
    echo "Error al procesar la respuesta XML.";
}
?>  
