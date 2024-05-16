<?php
function sumar($a, $b) {
    return $a + $b;
}

header('Content-Type: application/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>';

if (isset($_GET['a']) && isset($_GET['b']) && is_numeric($_GET['a']) && is_numeric($_GET['b'])) {
    $a = floatval($_GET['a']);
    $b = floatval($_GET['b']);
    $resultado = sumar($a, $b);
    
    echo '<respuesta>';
    echo "<mensaje>$resultado</mensaje>";
    echo '</respuesta>';
} else {
    echo '<respuesta>';
    echo '<mensaje>Error: Parámetros inválidos.</mensaje>';
    echo '</respuesta>';
}
?>
