    <?php
    $xml = simplexml_load_file('vehiculo.xml');
    echo '<h2>Lista de vehiculos</h2>';
    $list = $xml->coche;
    for ($i = 0; $i < count($list); $i++) {
        echo '<b>Id:</b> '.$list[$i]->attributes()->id.'<br>';
        echo 'Marca: '.$list[$i]->marca.'<br>';
        echo 'Modelo: '.$list[$i]->modelo.'<br>';
        echo 'Fecha: '.$list[$i]->fechaCompra.'<br><br>';
    }
    ?>