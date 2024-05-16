<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = $_POST['a'];
    $b = $_POST['b'];

    // Validar que los parámetros sean numéricos
    if (is_numeric($a) && is_numeric($b)) {
        // Definir la URL del servicio web
        $url_servicio_web = "http://localhost/T-picos-en-software-/Ejercicio1/suma-serv.php";

        // Enviar una solicitud al servicio web utilizando cURL
        $ch = curl_init($url_servicio_web . "?a=$a&b=$b");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $respuesta_xml = curl_exec($ch);
        curl_close($ch);

        // Convertir la respuesta XML a un objeto PHP
        $respuesta = simplexml_load_string($respuesta_xml);

        // Verificar si la carga XML fue exitosa
        if ($respuesta !== false) {
            // Extraer el mensaje de la respuesta XML
            $mensaje = $respuesta->mensaje;
            // Mostrar el mensaje en la pantalla
            $resultado = "La suma de $a y $b es: $mensaje";
        } else {
            // Manejar el caso en el que la carga XML falló
            $resultado = "Error al procesar la respuesta XML.";
        }
    } else {
        // Manejar el caso de parámetros no válidos
        $resultado = "Error: Los parámetros deben ser numéricos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sumar Números</title>
</head>
<body>
    <h1>Sumar Números</h1>
    <form method="post">
        <label for="a">Número 1:</label>
        <input type="number" id="a" name="a" required>
        <br>
        <label for="b">Número 2:</label>
        <input type="number" id="b" name="b" required>
        <br>
        <input type="submit" value="Sumar">
    </form>

    <?php
    if (isset($resultado)) {
        echo "<h2>Resultado:</h2>";
        echo "<p>$resultado</p>";
    }
    ?>
</body>
</html>