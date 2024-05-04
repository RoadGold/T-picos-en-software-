<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = $_POST['a'];
    $b = $_POST['b'];

    // Definir la URL del servicio web
    $url_servicio_web = "http://localhost/laboratorios/lab_1/suma-serv.php";

    // Enviar una solicitud al servicio web utilizando cURL
    $ch = curl_init($url_servicio_web . "?a=$a&b=$b");
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
        echo "La suma de $a y $b es: $mensaje";
    } else {
        // Manejar el caso en el que la carga XML falló
        echo "Error al procesar la respuesta XML.";
    }
}
?>

<form method="post">
    <label for="a">Número 1:</label>
    <input type="number" id="a" name="a" required>
    <label for="b">Número 2:</label>
    <input type="number" id="b" name="b" required>
    <input type="submit" value="Sumar">
</form>
