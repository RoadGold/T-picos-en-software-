<!DOCTYPE html>
<html>
<head>
    <title>Registro de Alumnos</title>
</head>
<body>
    <h1>Registro de Alumnos</h1>
    <form action="guardar_alumno.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre"><br><br>
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad"><br><br>
        <input type="submit" value="Guardar">
    </form>
</body>
</html>
