<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identificación</title>
</head>
<body>
    <h1>GESTION DE BODEGA</h1>
    <h2>BIENVENIDO</h2>
    <h3>Por favor, ingrese sus datos</h3>
    <form action="validar.php" method="POST" enctype="application/x-www-form-urlencoded">
        <label for="usuario">Ususario:</label>
        <input type="text" name="usuario">

        <label for="password">Password:</label>
        <input type="password" name="password">

        <input type="submit" value="Entrar">
    </form>
</body>
</html>