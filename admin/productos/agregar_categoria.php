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
    if(isset($_POST['nombre_categoria'])){
        $nombre_categoria = $_POST['nombre_categoria'];
        $sql = "INSERT INTO categoria VALUES(null, '$nombre_categoria')";
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
            die(header('Location:http://localhost/admin/productos/agregar_producto.php?message=error-db'));
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Categoría</title>
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
            <h1 class="text-center">AGREGAR CATEGORIA</h1>
            <!-- Formulario POST para agregar categorias -->
            <form action="./agregar_categoria.php" method="POST" class="form-group" enctype="application/x-www-form-urlencoded">
                <label for="nombre_categoria">Nombre Categoría:</label>
                <input type="text" class="form-control" placeholder="ej. Categoria de Ejemplo" name="nombre_categoria">

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