<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = $_POST['a'];
    $b = $_POST['b'];

    // Definir la URL del servicio web
    $url_servicio_web = "http://localhost/T-picos-en-software-/Ejercicio1/suma-serv.php";

    // Enviar una solicitud al servicio web utilizando cURL
    $ch = curl_init($url_servicio_web . "?a=$a&b=$b");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $respuesta_xml = curl_exec($ch);
    curl_close($ch);

    // Convertir la respuesta XML a un objeto PHP
    $respuesta = simplexml_load_string($respuesta_xml);

    // Preparar el encabezado de la respuesta
    header('Content-Type: application/xml');
    ob_start();
    // Generar la respuesta en formato XML
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<respuesta>';
    ob_end_flush();
    // Verificar si la carga XML fue exitosa
    if($respuesta !== false) {
        // Extraer el mensaje de la respuesta XML
        $mensaje = $respuesta->mensaje;
        // Mostrar el mensaje en la pantalla
        echo "<mensaje>La suma de $a y $b es: $mensaje</mensaje>";
    } else {
        // Manejar el caso en el que la carga XML falló
        echo '<mensaje>Error al procesar la respuesta XML.</mensaje>';
    }
    echo '</respuesta>';
}
?>

<form method="post">
    <label for="a">Número 1:</label>
    <input type="number" id="a" name="a" required>
    <label for="b">Número 2:</label>
    <input type="number" id="b" name="b" required>
    <input type="submit" value="Sumar">
</form>
