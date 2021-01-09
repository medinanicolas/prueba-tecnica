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
    if(isset($_POST['id_producto']) && isset($_POST['stock_producto'])){
        $id_producto = $_POST['id_producto'];
        $sql = "SELECT nombre_producto, stock_producto FROM producto WHERE id_producto = '$id_producto'";
        if($resultado = $conexion->query($sql)){
            if($resultado->num_rows>0){
                $producto = $resultado->fetch_assoc();
                $stock_atual = $producto['stock_producto'];
                $stock_entrante = $_POST['stock_producto'];
                $stock_total = $stock_atual + $stock_entrante;
                $sql = "UPDATE producto SET stock_producto = '$stock_total' WHERE id_producto = '$id_producto'";
                if($resultado = $conexion->query($sql)){
                    /**
                     * En caso de ser exitosa la operación envía un mensage con un parametro GET
                     * que será interceptado por 'sweetalert.php', el que enviará una alerta 
                     * con el mensaje correspondiente
                     */
                    die(header('Location:http://localhost/admin/stock/?message=success'));
                }else{
                    /**
                     * En caso contratio termina la operación con un mensaje de error
                     */
                    die(header('Location:http://localhost/admin/stock/?message=error-db'));
                }
            }else{
                die(header('Location:http://localhost/admin/stock/?message=not-found'));
            }
        }else{
            die(header('Location:http://localhost/admin/stock/?message=error-db'));
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Productos</title>
    <!-- Header -->
    <?php include_once '../../base/header.inc'; ?>
</head>
<body>
    <!-- SweetAlert -->
    <?php include_once '../../base/sweetalert.php'; ?>
    <!-- Barra de Navegación -->
    <?php include_once '../../base/nav.inc'; ?>
    <!-- Contenido -->
    <div class="container pt-5">
    <div class="row justify-content-center p-5 border bg-light">
        <div class="col-6 p-0">
            <h1 class="text-center">STOCK PRODUCTOS</h1>
            <!-- Formulario POST para agregar categorias -->
            <form action="." method="POST" enctype="application/x-www-form-urlencoded">

                <label for="id_producto">Código Producto:</label>
                <input type="text" class="form-control" placeholder="ej. 100" name="id_producto">

                <label for="stock_producto">Stock Entrante:</label>
                <input type="text" class="form-control" placeholder="ej. 1000" name="stock_producto">

                <button type="submit" class="text-light btn btn-success mt-3 float-right"><i class="fas fa-sync-alt"></i> Actualizar</button>
            </form>
        </div>
    </div>
    </div>
    <!-- Footer -->
    <?php include_once '../../base/footer.inc'; ?>
</body>
</html>