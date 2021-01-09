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
        if($_POST['stock_producto'] == 0){
            die(header('Location:http://localhost/admin/stock/?message=error-db'));
            exit;
        }
        $id_producto = $_POST['id_producto'];
        $sql = "SELECT nombre_producto, stock_producto FROM producto WHERE id_producto = '$id_producto'";
        if($resultado = $conexion->query($sql)){
            if($resultado->num_rows>0){
                $producto = $resultado->fetch_assoc();
                $stock_atual = $producto['stock_producto'];
                $stock_entrante = $_POST['stock_producto'];
                $stock_total = $stock_atual + $stock_entrante;
                if($stock_total<0){
                    die(header('Location:http://localhost/admin/stock/?message=stock'));
                }else{
                    $sql = "UPDATE producto SET stock_producto = '$stock_total' WHERE id_producto = '$id_producto'";
                    if($resultado = $conexion->query($sql)){
                        /**
                         * En caso de ser exitosa la operación envía un mensage con un parametro GET
                         * que será interceptado por 'sweetalert.php', el que enviará una alerta 
                         * con el mensaje correspondiente
                         */
                        #die(header('Location:http://localhost/admin/stock/?message=success'));
                    }else{
                        /**
                         * En caso contratio termina la operación con un mensaje de error
                         */
                        die(header('Location:http://localhost/admin/stock/?message=error-db'));
                    }
                    $sql = "INSERT INTO registro_stock VALUES(null, '$id_producto', '$stock_atual', '$stock_entrante', '$stock_total', now())";
                    if($resultado = $conexion->query($sql)){
                        die(header('Location:http://localhost/admin/stock/?message=success'));
                    }else{
                        die(header('Location:http://localhost/admin/stock/?message=error-db'));
                    }
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
            <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    /**
                     * Comprueba que exista el id indicado
                     */
                    $sql = "SELECT id_producto, stock_producto FROM producto WHERE id_producto = '$id'";
                    if($resultado = $conexion->query($sql)){
                        if($resultado->num_rows>0){
                                $producto = $resultado->fetch_assoc();
                            $stock = $producto['stock_producto'];
                            echo '<form action="." method="POST" enctype="application/x-www-form-urlencoded">';

                            echo '<label for="id_producto">Código Producto:</label>';

                            echo '<input type="text" class="form-control" value="'.$id.'" name="id_producto" readonly>';

                            echo '<label>Stock Actual:</label>';
                            echo '<input readonly type="text" class="form-control" value="'.$stock.'">';

                            echo '<label for="stock_producto">Stock Entrante:</label>';
                            echo '<input type="text" class="form-control" placeholder="ej. 1000" name="stock_producto">';

                            echo '<button type="submit" class="text-light btn btn-success mt-3 float-right"><i class="fas fa-box"></i> Actualizar</button>';
                            echo '</form>';
                        }else{
                            die(header('Location:http://localhost/admin/stock/?message=not-found'));   
                        }
                        
                    }else{
                        die(header('Location:http://localhost/admin/stock/?message=error-db'));   
                    }
                }else{
                    echo '<h4 class="text-center text-muted">No se ha seleccionado ningun producto</h4>';
                }
            ?>
        </div>
    </div>
    <?php 
    /**
     * Lista los registros, de no haber entonces no inserta código
     */
    $sql = "SELECT * FROM registro_stock";
    if($resultado = $conexion->query($sql)){
        if($resultado->num_rows>0){
            echo '<div class="row justify-content-center p-5 border bg-light">';
            echo '<div class="col-12 p-0 mt-3">';
            echo '<table class="table table-striped table-hover">
                <thead class="thead-dark">
                <tr">
                    <th class="text-center" scope="col">Registro</th>
                    <th class="text-center" scope="col">Producto</th>
                    <th class="text-center" scope="col">Stock Anterior</th>
                    <th class="text-center" scope="col">Stock Entrante</th>
                    <th class="text-center" scope="col">Stock Posterior</th>
                    <th class="text-center" scope="col">Fecha Registro</th>
                </tr>
                </thead>
                ';
            echo "<tbody>";
            while($registro = $resultado->fetch_assoc()){
                echo "<tr>
                    <th class='text-center' scope='row'>" . $registro['id_registro'] . "</th>
                    <td class='text-center'>" . $registro['id_producto'] . "</td>
                    <td class='text-center'>" . $registro['stock_antes'] . "</td>
                    <td class='text-center'>" . $registro['stock_entrante'] . "</td>
                    <td class='text-center'>" . $registro['stock_despues'] . "</td>
                    <td class='text-center'>" . $registro['fecha_registro'] . "</td>
                    </tr>
                    ";
            }
            echo "</tbody>
                </table>
                ";
            echo '</div>';
            echo '</div>"';
        }
    }
    ?>
    </div>
    <!-- Footer -->
    <?php include_once '../../base/footer.inc'; ?>
</body>
</html>