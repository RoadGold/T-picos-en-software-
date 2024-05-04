<?php
function sumar($a, $b) {
    return $a + $b;
}
$a = $_GET['a'];
$b = $_GET['b'];

$resultado = sumar($a, $b);

header('Content-Type: application/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<respuesta>';
echo "<mensaje>$resultado</mensaje>";
echo '</respuesta>';
?>