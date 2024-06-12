<?php
// Incluir el archivo de conexión a la base de datos y la clase Producto
require_once('DatabaseConnection.php');
require_once('Product.php');

// Consulta SQL para seleccionar todos los productos
$sql = "SELECT * FROM Product";
$result = $conn->query($sql);

// Crear un array para almacenar los objetos Producto
$productos = array();

// Crear objetos Producto para cada fila de resultados
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $producto = new Product($row['name'], $row['price'], $row['description']);
        array_push($productos, $producto);
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Listado de Productos</h1>
        <div class="row">
            <?php foreach ($productos as $producto): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $producto->getName(); ?></h5>
                            <p class="card-text">Precio: $<?php echo $producto->getPrice(); ?></p>
                            <p class="card-text"><?php echo $producto->getDescription(); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
