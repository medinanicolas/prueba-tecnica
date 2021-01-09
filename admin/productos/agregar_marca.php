<?php 
    /**
     * Utiliza la sesion para comprobar privilegios
     */
    require_once '../../config/sesion.php';
    /**
     * Requiere de la configuración de la base de datos
     */
    require_once '../../config/conexion.php';
    /**
     * Si los compos son enviados desde el formulario entonces los comprueba y los agrega a la base de datos
     */
    if(isset($_POST['nombre_marca'])){
        $nombre_marca = $_POST['nombre_marca'];
        $sql = "INSERT INTO marca VALUES(null, '$nombre_marca')";
        if($resultado = $conexion->query($sql)){
            /**
             * En caso de ser exitosa la operación envía un mensage con un parametro GET
             * que será interceptado por 'sweetalert.php', el que enviará una alerta 
             * con el mensaje correspondiente
             */
            die(header('Location:http://localhost/admin/productos/agregar_producto.php?message=success'));
        }else{
            /**
             * En caso contratio termina la operación con un mensaje de error
             */
            die(header('Location:http://localhost/admin/productos/agregar_producto.php?message=error'));
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Marca</title>
    <!-- Header -->
    <?php include_once '../../base/header.inc'; ?>
</head>
<body>
    <!-- Barra de Navegación -->
    <?php include_once '../../base/nav.inc'; ?>
    <!-- Contenido -->
    <div class="container pt-5">
    <div class="row justify-content-center p-5 border bg-light">
        <div class="col-6 p-0">
            <h1 class="text-center">AGREGAR MARCA</h1>
            <!-- Formulario POST para agregar marcas -->
            <form action="./agregar_marca.php" method="POST" class="form-group" enctype="application/x-www-form-urlencoded">
                <label for="nombre_marca">Nombre Marca:</label>
                <input type="text" class="form-control" placeholder="Marca de Ejemplo #1" name="nombre_marca">

                <button type="submit" class="text-light btn btn-success mt-3 float-right"><i class="fas fa-plus-square"></i> Agregar</button>
                <a class="text-light btn btn-danger mt-3 float-left" href="http://localhost/admin/productos/agregar_producto.php"
                ><i class="fas fa-window-close"></i> Cancelar</a>
            </form>
        </div>
    </div>
    </div>
    <!-- Footer -->
    <?php include_once '../../base/footer.inc'; ?>
</body>
</html>