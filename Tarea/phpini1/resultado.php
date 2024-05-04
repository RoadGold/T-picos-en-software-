<!DOCTYPE html>
<html>
<head>
    <title>Resultado</title>
</head>
<body>
    <h1>Resultado</h1>
    <?php
    if (isset($_POST['numero1']) && isset($_POST['numero2'])) {
        $numero1 = $_POST['numero1'];
        $numero2 = $_POST['numero2'];
        $suma = $numero1 + $numero2;
        echo "La suma de $numero1 y $numero2 es: $suma";
    } else {
        echo "Por favor, ingrese dos números.";
    }
    ?>
</body>
</html>
