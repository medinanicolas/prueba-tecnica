<?php
/**
 * Sesión para comprobar privilegios
 */
    session_start();
    require_once '../../config/sesion.php';
    require_once '../../config/conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-6">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <!-- Header & Reqs-->
    <?php include_once '../../base/header.inc'; ?>
    <?php require_once '../../base/require.php'; ?>
</head>
<body>
    <!-- Barra de Navegación -->
    <?php include_once '../../base/nav.inc'; ?>
    <!-- Contenido -->
    <div class="container p-0 pt-5">
        <div class="row justify-content-center px-5 pt-5 bg-light">
            <div class="col-6 p-0">
            <h1 class="text-center">Productos</h1>   
            </div>
        </div>
        <div class="row justify-content-center px-5 pt-0 bg-light">
        <!-- Listar desde bodegas -->
            <div class="col-6">
                <h5>Listar desde:</h5>
                <form method="POST" action="." class="form-inline">
                    <select name="bodega" class="form-control">
                        <?php
                        /**
                         * Lista las bodegas para seleccionar
                         */
                        $sql = "SELECT * FROM bodega";
                        if($resultado = $conexion->query($sql)){
                            if($resultado->num_rows>0){
                                while($bodega = $resultado->fetch_assoc()){
                                    echo "<option value='". $bodega['id_bodega']."'>",$bodega['nombre_bodega']."</option>";
                                }
                            }
                        }
                        /** 
                         * Libera la variable '$resultado' para ocuparla posteriormente
                         * en otra consulta
                         */
                        unset($resultado)
                        ?>
                        <option value="1" selected>Todos los productos</option>
                    </select>
                    <button type="submit" class="btn btn-primary ml-2"><i class="fas fa-hand-pointer"></i> Seleccionar</button>
                </form>
            </div> 
        <!-- Listar por producto -->
            <div class="col-6">
                <h5>Código producto:</h5>
                <form action="" method="POST" class="form-inline">
                    <!-- Formulario Búsqueda por Código -->
                    <label for="busqueda_codigo">
                    <input name="busqueda_codigo" class="form-control" placeholder="ej. 100">
                    <button type="submit" class="btn btn-primary ml-2"><i class="fas fa-search"></i> Búsqueda</button>
                </form>
            </div>
        </div>
        <div class="row justify-content-center px-5 pb-5 bg-light">  
            <!-- Resultados búsqueda -->  
            <div class="col-12 p-0 mt-3">
                <hr>
                <a class="btn btn-success my-1 float-right" href="http://localhost/admin/productos/agregar_producto.php"><i class="fas fa-plus-circle"></i> Agregar</a> 
                <a class="btn btn-warning text-light my-1 mr-2 float-right" href="http://localhost/admin/productos/"><i class="fas fa-broom"></i> Limpiar</a> 
                <?php 
                    /**
                     * Lista los productos de la opción seleccionada
                     */
                    if(isset($_POST['bodega']) && $_POST['bodega']!="1"){
                        $id_bodega = $_POST['bodega'];
                        $sql = "SELECT * FROM bodega WHERE id_bodega = '$id_bodega'";
                        if($resultado = $conexion->query($sql)){
                            /**
                             * Verifica si es que la bodega existe
                             */
                            if($resultado->num_rows>0){
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
                                    (new SweetAlertMessages)->error();
                                }
                            }else{
                                (new SweetAlertMessages)->not_found();
                            }
                        }else{
                            (new SweetAlertMessages)->error();
                        }
                    }elseif(isset($_POST['bodega']) && $_POST['bodega']==="1"){
                        /**
                         * Selecciona todos los productos en la base de datos
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
                                    JOIN bodega b ON b.id_bodega = p.id_bodega";
                        if(!$resultado = $conexion->query($sql)){
                            (new SweetAlertMessages)->error();
                        }
                    }elseif(isset($_POST['busqueda_codigo'])){
                        /**
                         * Búsqueda por código de producto
                         */
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
                        if(!$resultado = $conexion->query($sql)){
                            (new SweetAlertMessages)->error();
                        }
                    }else{
                        echo "<h4 class='text-muted'>No se ha seleccionado ninguna fuente</h4>";
                    }
                /**
                 * Si '$resultado' está definida entonces continua para llenar tabla
                 */
                if(isset($resultado)):?>
                    <?php
                        /**
                         * Si es que encuentra resultados los lista en tabla
                         */ 
                        if($resultado->num_rows > 0): ?>
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                <tr>
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
                            <tbody>
                            <?php
                            while($producto = $resultado->fetch_assoc()){
                                echo "  <tr>
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
                                                <i class='fas fa-trash'></i>
                                            </a>
                                            <a class='btn btn-warning text-white' href='modificar_producto.php?id=".$producto['id_producto']."'
                                                ><i class='fas fa-edit'></i></a>
                                            <a class='btn btn-success text-white' href='http://localhost/admin/stock/?id=".$producto['id_producto']."'
                                            ><i class='fas fa-boxes'></i></a>
                                            <a class='btn btn-primary text-white' href='http://localhost/admin/entregas/?id=".$producto['id_producto']."'
                                            ><i class='fas fa-truck-loading'></i></a>
                                        </td>
                                        </tr>"; 
                            }
                            echo    "</tbody>
                                    </table>";
                        /**
                         * De lo contrario informa de la no existencia de bodegas
                         */
                        else:
                    ?>    
                        <h4 class='text-muted'>No se han encontrado resultados</h4>
                    <?php 
                        endif;
                endif;?>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include_once '../../base/footer.inc'; ?>
    <!-- Funcion para eliminar el producto con SweetAlert -->
    <script>function eliminarProducto(id){
                Swal.fire({
                    title: "¿Está seguro?",
                    text:"Se eliminiará el producto y todos sus registros",
                    icon: "question",
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
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