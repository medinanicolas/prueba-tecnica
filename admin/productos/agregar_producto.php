
<?php
/**
 * Requeriments
 */

include_once '../../config/sesion.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <!-- Header & Reqs-->
    <?php include_once '../../base/header.inc'; ?>
    <?php require_once '../../base/require.php'; ?>
</head>
<body>
    <!-- Barra de Navegación -->
    <?php include_once '../../base/nav.inc'; ?>
    <!-- Contenido -->
    <?php
    /**
     * Si los compos son enviados desde el formulario entonces los comprueba y los agrega a la base de datos
     */
    if(isset($_POST['bodega_producto']) &&
        isset($_POST['nombre_producto']) &&
        isset($_POST['descripcion_producto']) &&
        isset($_POST['marca_producto']) &&
        isset($_POST['categoria_producto']) &&
        isset($_POST['precio_producto']) &&
        isset($_POST['stock_producto'])){
        $bodega_producto = $_POST['bodega_producto'];
        $nombre_producto = $_POST['nombre_producto'];
        $descripcion_producto = $_POST['descripcion_producto'];
        $marca_producto = $_POST['marca_producto'];
        $categoria_producto = $_POST['categoria_producto'];
        $precio_producto = $_POST['precio_producto'];
        $stock_producto = $_POST['stock_producto'];
        $sql = "INSERT INTO producto VALUES(null, '$nombre_producto', '$precio_producto', '$descripcion_producto',
                '$stock_producto', '$marca_producto', '$categoria_producto', '$bodega_producto')";
        if($resultado = $conexion->query($sql)){
            /**
             * En caso de ser exitosa la operación envía un mensage con un parametro GET
             * que será interceptado por 'sweetalert.php', el que enviará una alerta 
             * con el mensaje correspondiente
             */
            (new SweetAlertMessages)->success('.');
        }else{
            /**
             * En caso contratio termina la operación con un mensaje de error
             */
            (new SweetAlertMessages)->error('agregar_producto.php');
        }
    }
    ?>
    <div class="container pt-5">
    <div class="row justify-content-center p-5 border bg-light">
        <div class="col-6 p-0">
            <h1 class="text-center">AGREGAR PRODUCTO</h1>

            <!-- Formulario POST para agregar bodegas -->
            <form action="./agregar_producto.php" method="POST" class="form-group" enctype="application/x-www-form-urlencoded">
                <label for="bodega_producto">Bodega Producto:</label>
                <select name="bodega_producto" class="form-control">
                    <?php
                    /**
                     * Lista las bodegas para seleccionar
                     */
                    #include_once '../../config/conexion.php';
                    $sql = "SELECT * FROM bodega";
                    if($resultado = $conexion->query($sql)){
                        if($resultado->num_rows>0){
                            while($bodega = $resultado->fetch_assoc()){
                                echo "<option value='". $bodega['id_bodega']."'>",$bodega['nombre_bodega']."</option>";
                            }
                        }
                    }
                    ?>
                    <option value="0" selected>Seleccione...</option>
                </select>

                <label for="marca_producto">Marca Producto:</label>
                <a href="./agregar_marca.php" class="float-right">agregar marca</a>
                <select name="marca_producto" class="form-control">
                    <?php
                    /**
                     * Lista las marcas para seleccionar
                     */
                    #include_once '../../config/conexion.php';
                    $sql = "SELECT * FROM marca";
                    if($resultado = $conexion->query($sql)){
                        if($resultado->num_rows>0){
                            while($marca = $resultado->fetch_assoc()){
                                echo "<option value='". $marca['id_marca']."'>",$marca['nombre_marca']."</option>";
                            }
                        }
                    }
                    ?>
                    <option value="0" selected>Seleccione...</option>
                </select>
                
                <label for="categoria_producto">Categoría Producto:</label>
                <a href="./agregar_categoria.php" class="float-right">agregar categoria</a>
                <select name="categoria_producto" class="form-control">
                    <?php
                    /**
                     * Lista las marcas para seleccionar
                     */
                    #include_once '../../config/conexion.php';
                    $sql = "SELECT * FROM categoria";
                    if($resultado = $conexion->query($sql)){
                        if($resultado->num_rows>0){
                            while($categoria = $resultado->fetch_assoc()){
                                echo "<option value='". $categoria['id_categoria']."'>",$categoria['nombre_categoria']."</option>";
                            }
                        }
                    }
                    unset($resultado);
                    ?>
                    <option value="0" selected>Seleccione...</option>
                </select>

                <label for="nombre_producto">Nombre Producto:</label>
                <input type="text" class="form-control" placeholder="ej. Producto de Ejemplo 1" name="nombre_producto">

                <label for="descripcion_producto">Descripción Producto:</label>
                <input type="text" class="form-control" placeholder="ej. Descripción de ejemplo" name="descripcion_producto">

                <label for="precio_producto">Precio Producto:</label>
                <input type="text" class="form-control" placeholder="ej. 19990" name="precio_producto">

                <label for="stock_producto">Stock Producto:</label>
                <input type="text" class="form-control" placeholder="ej. 3000" name="stock_producto">


                <button type="submit" class="text-light btn btn-success mt-3 float-right"><i class="fas fa-plus-circle"></i> Agregar</button>
                <a class="text-light btn btn-danger mt-3 float-left" href="http://localhost/admin/productos/"
                ><i class="fas fa-window-close"></i> Cancelar</a>
            </form>
        </div>
    </div>
    </div>
    <!-- Footer -->
    <?php include_once '../../base/footer.inc'; ?>
</body>
</html>