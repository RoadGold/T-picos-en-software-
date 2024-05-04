<?php
$nombre = $_POST['nombre'];
$edad = $_POST['edad'];

$xml = new DOMDocument('1.0', 'utf-8');
$xml->formatOutput = true;

if (file_exists('alumnos.xml') && filesize('alumnos.xml') > 0) {
    $xml->load('alumnos.xml');
    $alumnos = $xml->documentElement;
} else {
    $alumnos = $xml->createElement('alumnos');
    $xml->appendChild($alumnos);
}

$alumno = $xml->createElement('alumno');
$nombreNodo = $xml->createElement('nombre', $nombre);
$edadNodo = $xml->createElement('edad', $edad);
$alumno->appendChild($nombreNodo);
$alumno->appendChild($edadNodo);
$alumnos->appendChild($alumno);

$xml->save('alumnos.xml');

echo "Alumno guardado correctamente.";
?>
