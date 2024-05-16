<?php
    $xml = simplexml_load_file('alumnos.xml');
    echo '<table border="1">';
    echo '<tr><th>Id</th><th>Nombre</th><th>Apellido</th><th>Grado</th></tr>';
    foreach ($xml->alumno as $alumno) {
        echo '<tr>';
        echo '<td>' . $alumno->attributes()->id . '</td>';
        echo '<td>' . $alumno->nombre . '</td>';
        echo '<td>' . $alumno->apellido . '</td>';
        echo '<td>' . $alumno->grado . '</td>';
        echo '</tr>';
    }
    echo '</table>';
?>