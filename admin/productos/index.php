<?php
/**
 * Sesión para comprobar privilegios
 */
    session_start();
    require_once '../../config/sesion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <!-- Header -->
    <?php include_once '../../base/header.inc'; ?>
</head>
<body>
    <!-- Sweetalert -->
    <?php include_once '../../base/sweetalert.php'; ?>
    <!-- Barra de Navegación -->
    <?php include_once '../../base/nav.inc'; ?>
    <!-- Contenido -->
    <div class="container pt-5">
    <div class="row justify-content-center px-5 pt-5 bg-light">
        <div class="col-6 p-0">
        <h1 class="text-center">Productos <a class="btn btn-success my-2" href="http://localhost/admin/productos/agregar_producto.php"><i class="fas fa-plus-square"></i> Agregar</a> </h1>   
        </div>
    </div>
    <div class="row justify-content-center px-5 pt-0 bg-light">
    <div class="col-6">
            <form method="POST" action=".">
                <h3>Bodega:</h3>
                <select name="bodega" class="form-control">
                    <?php
                    /**
                     * Lista las bodegas para seleccionar
                     */
                    include_once '../../config/conexion.php';
                    $sql = "SELECT * FROM bodega";
                    if($resultado = $conexion->query($sql)){
                        if($resultado->num_rows>0){
                            $bodega = $resultado->fetch_assoc();
                            echo "<option value='". $bodega['id_bodega']."'>",$bodega['nombre_bodega']."</option>";
                        }
                    }
                    ?>
                    <option value="1">Todos los productos</option>
                    <option value="0" selected>Seleccione...</option>
                </select>
                <button type="submit" class="btn btn-primary mt-3 float-left"><i class="fas fa-caret-square-right"></i> Seleccionar</button>
            </form>
        </div> 
        <div class="col-6">
            <form action="" method="POST" class="text-right">
                <h3>Código Producto:</h3>
                <label for="busqueda_codigo" class="text-right">
                <input name="busqueda_codigo" class="form-control" placeholder="100">
                <button type="submit" class="btn btn-primary float-right mt-3"><i class="fas fa-search"></i> Búsqueda</button>
            </form>
        </div>
    </div>
    <div class="row justify-content-center px-5 pb-5 bg-light">
        <div class="col-12 p-0 mt-3">
            <?php 
                /**
                 * Lista los productos de la bodega seleccionada
                 */
                if(isset($_POST['bodega']) && $_POST['bodega']!="0" && $_POST['bodega']!="1"){
                    #require_once '../../config/conexion.php';
                    $id_bodega = $_POST['bodega'];
                    $sql = "SELECT * FROM bodega WHERE id_bodega = '$id_bodega'";
                    if($resultado = $conexion->query($sql)){
                        if($resultado->num_rows>0){
                            $bodega = $resultado->fetch_assoc();
                            echo "<h2>".$bodega['nombre_bodega']."</h2>";
                            /**
                             * Busca productos existentes en la bodega seleccionada
                             */
                            $sql = "SELECT p.id_producto,
                                        p.nombre_producto,
                                        p.precio_producto,
                                        p.descripcion_producto,
                                        p.stock_producto,
                                        m.nombre_marca,
                                        c.nombre_categoria,
                                        b.nombre_bodega
                                    FROM producto p
                                    JOIN marca m ON m.id_marca = p.id_marca
                                    JOIN categoria c ON c.id_categoria = p.id_categoria
                                    JOIN bodega b ON b.id_bodega = p.id_bodega
                                    WHERE p.id_bodega = '$id_bodega'";
                            if(!$resultado = $conexion->query($sql)){
                                die(header('Location:http://localhost/admin/productos/?message=error'));
                            }else{
                                /**
                                 * Si es que encuentra resultados los lista en tabla
                                 */
                                if($resultado->num_rows > 0){
                                    echo '<table class="table table-striped table-hover">
                                        <thead class="thead-dark">
                                        <tr">
                                            <th class="text-center" scope="col">Codigo</th>
                                            <th class="text-center" scope="col">Nombre</th>
                                            <th class="text-center" scope="col">Descripcion</th>
                                            <th class="text-center" scope="col">Marca</th>
                                            <th class="text-center" scope="col">Categoria</th>
                                            <th class="text-center" scope="col">Precio</th>
                                            <th class="text-center" scope="col">Stock</th>
                                            <th class="text-center" cope="col">Acción</th>
                                        </tr>
                                        </thead>
                                        ';
                                    echo "<tbody>";
                                    while($producto = $resultado->fetch_assoc()){
                                        echo "<tr>
                                            <th class='text-center' scope='row'>" . $producto['id_producto'] . "</th>
                                            <td class='text-center'>" . $producto['nombre_producto'] . "</td>
                                            <td class='text-center'>" . $producto['descripcion_producto'] . "</td>
                                            <td class='text-center'>" . $producto['nombre_marca'] . "</td>
                                            <td class='text-center'>" . $producto['nombre_categoria'] . "</td>
                                            <td class='text-center'>" . number_format($producto['precio_producto']) . "</td>
                                            <td class='text-center'>" . $producto['stock_producto'] . "</td>
                                            <td class='text-center'>
                                                <a onclick=eliminarProducto(". $producto['id_producto'] .") class='btn btn-danger text-white' href='#'>
                                                    <i class='far fa-minus-square'></i>
                                                </a>
                                                <a class='btn btn-warning text-white' href='modificar_producto.php?id=".$producto['id_producto']."'
                                                    ><i class='far fa-edit'></i></a>
                                            </td>
                                            </tr>
                                            ";
                                    }
                                    echo "</tbody>
                                        </table>
                                        ";
                                }else{
                                    /**
                                     * De lo contrario informa de la no existencia de bodegas
                                     */
                                    echo "<h2 class='text-muted'>No se han encontrado resultados</h2>";
                                }
                            }
                        }
                    }else{
                        die(header('Location:http://localhost/admin/productos/?message=error'));
                    }
                }elseif(isset($_POST['bodega']) && $_POST['bodega']==="1"){
                    $sql = "SELECT p.id_producto,
                                    p.nombre_producto,
                                    p.precio_producto,
                                    p.descripcion_producto,
                                    p.stock_producto,
                                    m.nombre_marca,
                                    c.nombre_categoria,
                                    b.nombre_bodega
                                FROM producto p
                                JOIN marca m ON m.id_marca = p.id_marca
                                JOIN categoria c ON c.id_categoria = p.id_categoria
                                JOIN bodega b ON b.id_bodega = p.id_bodega";
                    if(!$resultado = $conexion->query($sql)){
                        die(header('Location:http://localhost/admin/productos/?message=error'));
                    }else{
                        /**
                         * Si es que encuentra resultados lista todos los productos en tabla
                         */
                        if($resultado->num_rows > 0){
                            echo '<table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                <tr">
                                    <th class="text-center" scope="col">Codigo</th>
                                    <th class="text-center" scope="col">Nombre</th>
                                    <th class="text-center" scope="col">Descripcion</th>
                                    <th class="text-center" scope="col">Marca</th>
                                    <th class="text-center" scope="col">Categoria</th>
                                    <th class="text-center" scope="col">Precio</th>
                                    <th class="text-center" scope="col">Stock</th>
                                    <th class="text-center" scope="col">Bodega</th>
                                    <th class="text-center" cope="col">Acción</th>
                                </tr>
                                </thead>
                                ';
                            echo "<tbody>";
                            while($producto = $resultado->fetch_assoc()){
                                echo "<tr>
                                    <th class='text-center' scope='row'>" . $producto['id_producto'] . "</th>
                                    <td class='text-center'>" . $producto['nombre_producto'] . "</td>
                                    <td class='text-center'>" . $producto['descripcion_producto'] . "</td>
                                    <td class='text-center'>" . $producto['nombre_marca'] . "</td>
                                    <td class='text-center'>" . $producto['nombre_categoria'] . "</td>
                                    <td class='text-center'>" . number_format($producto['precio_producto']) . "</td>
                                    <td class='text-center'>" . $producto['stock_producto'] . "</td>
                                    <td class='text-center'>" . $producto['nombre_bodega'] . "</td>
                                    <td class='text-center'>
                                        <a onclick=eliminarProducto(". $producto['id_producto'] .") class='btn btn-danger text-white' href='#'>
                                            <i class='far fa-minus-square'></i>
                                        </a>
                                        <a class='btn btn-warning text-white' href='modificar_producto.php?id=".$producto['id_producto']."'
                                            ><i class='far fa-edit'></i></a>
                                    </td>
                                    </tr>
                                    ";
                            }
                            echo "</tbody>
                                </table>
                                ";
                        }else{
                            /**
                             * De lo contrario informa de la no existencia de bodegas
                             */
                            echo "<h2 class='text-muted'>No se han encontrado resultados</h2>";
                        }
                    }
                }elseif(isset($_POST['busqueda_codigo'])){
                    $id_producto = $_POST['busqueda_codigo'];
                    $sql = "SELECT p.id_producto,
                                    p.nombre_producto,
                                    p.precio_producto,
                                    p.descripcion_producto,
                                    p.stock_producto,
                                    m.nombre_marca,
                                    c.nombre_categoria,
                                    b.nombre_bodega
                                FROM producto p
                                JOIN marca m ON m.id_marca = p.id_marca
                                JOIN categoria c ON c.id_categoria = p.id_categoria
                                JOIN bodega b ON b.id_bodega = p.id_bodega
                                WHERE id_producto = '$id_producto'";
                    if($resultado = $conexion->query($sql)){
                        if($resultado->num_rows>0){
                            echo '<table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                <tr">
                                    <th class="text-center" scope="col">Codigo</th>
                                    <th class="text-center" scope="col">Nombre</th>
                                    <th class="text-center" scope="col">Descripcion</th>
                                    <th class="text-center" scope="col">Marca</th>
                                    <th class="text-center" scope="col">Categoria</th>
                                    <th class="text-center" scope="col">Precio</th>
                                    <th class="text-center" scope="col">Stock</th>
                                    <th class="text-center" scope="col">Bodega</th>
                                    <th class="text-center" cope="col">Acción</th>
                                </tr>
                                </thead>
                                ';
                            echo "<tbody>";
                            while($producto = $resultado->fetch_assoc()){
                                echo "<tr>
                                    <th class='text-center' scope='row'>" . $producto['id_producto'] . "</th>
                                    <td class='text-center'>" . $producto['nombre_producto'] . "</td>
                                    <td class='text-center'>" . $producto['descripcion_producto'] . "</td>
                                    <td class='text-center'>" . $producto['nombre_marca'] . "</td>
                                    <td class='text-center'>" . $producto['nombre_categoria'] . "</td>
                                    <td class='text-center'>" . number_format($producto['precio_producto']) . "</td>
                                    <td class='text-center'>" . $producto['stock_producto'] . "</td>
                                    <td class='text-center'>" . $producto['nombre_bodega'] . "</td>
                                    <td class='text-center'>
                                        <a onclick=eliminarProducto(". $producto['id_producto'] .") class='btn btn-danger text-white' href='#'>
                                            <i class='far fa-minus-square'></i>
                                        </a>
                                        <a class='btn btn-warning text-white' href='modificar_producto.php?id=".$producto['id_producto']."'
                                            ><i class='far fa-edit'></i></a>
                                    </td>
                                    </tr>
                                    ";
                            }
                            echo "</tbody>
                                </table>
                                ";
                        }else{
                            echo "<h2 class='text-muted'>No se han encontrado resultados</h2>";
                        }
                    }
                }else{
                    echo "<h3 class='text-muted'>No se ha seleccionado bodega</h3>";
                }
            ?>
        </div>
    </div>
    </div>
    <!-- Footer -->
    <?php include_once '../../base/footer.inc'; ?>
    <!-- Funcion para eliminar el producto con SweetAlert -->
    <script>function eliminarProducto(id){
                Swal.fire({
                    title: "¿Está seguro?",
                    text:"Se eliminiará el producto seleccionado",
                    icon: "question",
                    showCancelButton: true,
                    cancelbuttonText: "Cancelar",
                    confirmButtonText: "Eliminar",
                    reverseButtons: true,
                    confirmButtonColor: "#dc3545"
                })
                .then(function (result) {
                    if (result.isConfirmed) {
                        window.location.href = "./eliminar_producto.php?id=" + id
                    }
                })
            }
    </script>
</body>
</html>