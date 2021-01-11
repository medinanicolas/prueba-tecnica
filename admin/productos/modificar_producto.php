<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
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
    if(isset($_POST['id_producto']) &&
        isset($_POST['nombre_producto']) &&
        isset($_POST['precio_producto']) &&
        isset($_POST['descripcion_producto']) &&
        isset($_POST['marca_producto']) &&
        isset($_POST['categoria_producto']) && isset($_POST['bodega_producto'])
    ){
        /**
         * Se establecen las variables para la actualización
         */
        $id_producto = $_POST['id_producto'];
        $nombre_producto = $_POST['nombre_producto'];
        $precio_producto = $_POST['precio_producto'];
        $descripcion_producto = $_POST['descripcion_producto'];
        $marca_producto = $_POST['marca_producto'];
        $categoria_producto = $_POST['categoria_producto'];
        $bodega_produco = $_POST['bodega_producto'];

        $sql = "UPDATE producto SET nombre_producto = '$nombre_producto', 
                                    precio_producto = '$precio_producto' ,
                                    descripcion_producto = '$descripcion_producto',
                                    id_marca = '$marca_producto',
                                    id_categoria = '$categoria_producto',
                                    id_bodega = '$bodega_produco'
                WHERE id_producto = '$id_producto'";
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
            (new SweetAlertMessages)->error('.');
        }
    }else{
        echo "No se ha ingresado ningun parametro válido";
    }
?>
    <div class="container pt-5">
    <div class="row justify-content-center p-5 border bg-light">
        <div class="col-6 p-0">
            <h1 class="text-center">MODIFICAR PRODUCTO</h1>
            <!-- Formulario POST para modificar bodegas -->
            <form action="modificar_producto.php" method="POST" class="form-group" enctype="application/x-www-form-urlencoded">
                <?php
                    /**
                     * Revisa el parametro GET para rellenar los datos
                     */
                    if(isset($_GET['id'])){
                        $id_producto = $_GET['id'];
                        $sql = "SELECT * FROM producto WHERE id_producto = '$id_producto'";
                        if($resultado = $conexion->query($sql)){
                            if($resultado->num_rows>0){
                                $producto = $resultado->fetch_assoc();
                                
                                echo '<label for="id_producto">Código Producto:</label>';
                                echo '<input type="text" class="form-control" readonly value="'.$producto['id_producto'].'" name="id_producto">';

                                echo '<label for="bodega_producto">Bodega Producto:</label>';
                                echo '<select name="bodega_producto" class="form-control">';
                                /**
                                * Lista las categorías para seleccionar
                                */
                                #include_once '../../config/conexion.php';
                                $sql = "SELECT * FROM bodega";
                                if($resultado = $conexion->query($sql)){
                                    if($resultado->num_rows>0){
                                        while($bodega = $resultado->fetch_assoc()){
                                            if($bodega['id_bodega']===$producto['id_bodega']){
                                                echo "<option value='". $bodega['id_bodega']."' selected>".$bodega['nombre_bodega']."</option>";
                                            }else{
                                                echo "<option value='".$bodega['id_bodega']."'>".$bodega['nombre_bodega']."</option>";
                                            }
                                        }
                                    }
                                }else{
                                    (new SweetAlertMessages)->error();
                                }
                                echo '</select>';

                                echo '<label for="nombre_producto">Nombre producto:</label>';
                                echo '<input type="text" class="form-control" value="'.$producto['nombre_producto'].'" name="nombre_producto">';

                                echo '<label for="descripcion_producto">Descripción Producto:</label>';
                                echo '<input type="text" class="form-control" value="'.$producto['descripcion_producto'].'" name="descripcion_producto">';

                                echo '<label for="marca_producto">Marca Producto:</label>';
                                echo '<select name="marca_producto" class="form-control">';
                                /**
                                 * Lista las marcas para seleccionar
                                 */
                                #include_once '../../config/conexion.php';
                                $sql = "SELECT * FROM marca";
                                if($resultado = $conexion->query($sql)){
                                    if($resultado->num_rows>0){
                                        while($marca = $resultado->fetch_assoc()){
                                            /**
                                             * Si es igual a la del producto entonces aparece seleccionada
                                             */
                                            if($marca['id_marca']===$producto['id_marca']){
                                                echo "<option value='". $marca['id_marca']."' selected>".$marca['nombre_marca']."</option>";
                                            }else{
                                                echo "<option value='".$marca['id_marca']."'>".$marca['nombre_marca']."</option>";
                                            }
                                        }
                                    }
                                }else{
                                    (new SweetAlertMessages)->error('.');
                                }
                                echo "</select>";
                                echo '<label for="categoria_producto">Categoría Producto:</label>';
                                echo '<select name="categoria_producto" class="form-control">';
                                /**
                                * Lista las categorías para seleccionar
                                */
                                #include_once '../../config/conexion.php';
                                $sql = "SELECT * FROM categoria";
                                if($resultado = $conexion->query($sql)){
                                    if($resultado->num_rows>0){
                                        while($categoria = $resultado->fetch_assoc()){
                                            if($categoria['id_categoria']===$producto['id_categoria']){
                                                echo "<option value='". $categoria['id_categoria']."' selected>".$categoria['nombre_categoria']."</option>";
                                            }else{
                                                echo "<option value='".$categoria['id_categoria']."'>".$categoria['nombre_categoria']."</option>";
                                            }
                                        }
                                    }
                                }else{
                                    (new SweetAlertMessages)->error('.');
                                }
                                echo '</select>';

                                echo '<label for="precio_producto">Precio Producto:</label>';
                                echo '<input type="text" class="form-control" value="'.$producto['precio_producto'].'" name="precio_producto">';

                                echo '<button type="submit" class="text-light btn btn-warning mt-3 float-right"><i class="fas fa-edit"></i> Modificar</button>
                                    <a class="text-light btn btn-danger mt-3 float-left" href="http://localhost/admin/productos/"
                                    ><i class="fas fa-window-close"></i> Cancelar</a>';
                            }else{
                                (new SweetAlertMessages)->not_found('.');   
                            }
                        }else{
                            (new SweetAlertMessages)->error('.');
                        }
                    }
                ?>
            </form>
        </div>
    </div>
    </div>
    <!-- Footer -->
    <?php include_once '../../base/footer.inc'; ?>
</body>
</html>