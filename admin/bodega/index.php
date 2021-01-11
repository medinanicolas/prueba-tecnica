<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bodegas</title>
    <!-- Header & Reqs-->
    <?php include_once '../../base/header.inc'; ?>
    <?php require_once '../../base/require.php'; ?>
</head>
<body>
    <!-- Barra de Navegación -->
    <?php include_once '../../base/nav.inc'; ?>
    <!-- Contenido -->
    <div class="container pt-5">
        <div class="row justify-content-center p-5 bg-light">
            <div class="col-12 p-0">
                <h1 class="text-center mb-5">Bodegas</h1>
                <!-- Ejemplo de boton con integración de FontAwesome -->
                <a class="btn btn-success my-2" href="http://localhost/admin/bodega/agregar_bodega.php"><i class="fas fa-plus-circle"></i> Agregar</a>
                <?php 
                /**
                 * Configuración SQL
                 */
                require_once '../../config/conexion.php';
                /**
                 * Busca bodegas existentes
                 */
                $sql = "SELECT * FROM bodega";
                ?>
                <?php if(!$resultado = $conexion->query($sql)):
                    (new SweetAlertMessages)->error();
                    exit;
                    /**
                     * Si es que encuentra resultados los lista en tabla
                     */
                    else: ?>
                    <?php if($resultado->num_rows > 0):?>
                        <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                        <tr">
                            <th class="text-center" scope="col">Codigo</th>
                            <th class="text-center" scope="col">Nombre</th>
                            <th class="text-center" scope="col">Dirección</th>
                            <th class="text-center" cope="col">Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                    <?php
                        while($bodega = $resultado->fetch_assoc()){
                            echo "<tr>
                                <th class='text-center' scope='row'>" . $bodega['id_bodega'] . "</th>
                                <td class='text-center'>" . $bodega['nombre_bodega'] . "</td>
                                <td class='text-center'>" . $bodega['direccion_bodega'] . "</td>
                                <td class='text-center'>
                                    <a onclick=eliminarBodega(". $bodega['id_bodega'] .") class='btn btn-danger text-white' href='#'>
                                        <i class='fas fa-trash'></i>
                                    </a>
                                    <a class='btn btn-warning text-white' href='./modificar_bodega.php?id=". $bodega['id_bodega']."'
                                        ><i class='fas fa-edit'></i></a>
                                </td>
                                </tr>";
                        }
                        echo    "</tbody>
                                </table>";
                    ?>
                    <?php
                        /**
                         * De lo contrario informa de la no existencia de bodegas
                         */
                        else: ?>
                        
                        <h6 class='text-muted'>No se han encontrado resultados</h6>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include_once '../../base/footer.inc'; ?>
    <!-- Funcion para eliminar bodega con SweetAlert -->
    <script>function eliminarBodega(id){
                Swal.fire({
                    title: "¿Está seguro?",
                    text:"Se eliminiará la bodega con todos sus productos",
                    icon: "question",
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    confirmButtonText: "Eliminar",
                    reverseButtons: true,
                    confirmButtonColor: "#dc3545"
                })
                .then(function (result) {
                    if (result.isConfirmed) {
                        window.location.href = "./eliminar_bodega.php?id=" + id
                    }
                })
            }
    </script>
</body>
</html>