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
    if(isset($_POST['nombre_bodega']) && isset($_POST['direccion_bodega']) && isset($_POST['id_bodega'])){
        $id_bodega = $_POST['id_bodega'];
        $nombre_bodega = $_POST['nombre_bodega'];
        $direccion_bodega = $_POST['direccion_bodega'];
        $sql = "UPDATE bodega SET nombre_bodega = '$nombre_bodega', direccion_bodega = '$direccion_bodega' WHERE id_bodega = '$id_bodega'";
        if($resultado = $conexion->query($sql)){
            /**
             * En caso de ser exitosa la operación envía un mensage con un parametro GET
             * que será interceptado por 'sweetalert.php', el que enviará una alerta 
             * con el mensaje correspondiente
             */
            die(header('Location:http://localhost/admin/bodega/?message=success'));
        }else{
            /**
             * En caso contratio termina la operación con un mensaje de error
             */
            die(header('Location:http://localhost/admin/bodega/?message=error'));
        }
    }else{
        echo "No se ha ingresado ningun parametro válido";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Bodega</title>
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
            <h1 class="text-center">MODIFICAR BODEGA</h1>
            <!-- Formulario POST para modificar bodegas -->
            <form action="modificar_bodega.php" method="POST" class="form-group" enctype="application/x-www-form-urlencoded">
            <?php
                /**
                 * Revisa el parametro GET para rellenar los datos
                 */
                if(isset($_GET['id'])){
                    $id_bodega = $_GET['id'];
                    $sql = "SELECT * FROM bodega WHERE id_bodega = '$id_bodega'";
                    if($resultado = $conexion->query($sql)){
                        if($resultado->num_rows>0){
                            $bodega = $resultado->fetch_assoc();
                            
                            echo '<label for="id_bodega">Código Bodega:</label>';
                            echo '<input type="text" class="form-control" readonly value="'.$bodega['id_bodega'].'" name="id_bodega">';

                            echo '<label for="nombre_bodega">Nombre Bodega:</label>';
                            echo '<input type="text" class="form-control" value="'.$bodega['nombre_bodega'].'" name="nombre_bodega">';

                            echo '<label for="direccion_bodega">Dirección Bodega:</label>';
                            echo '<input type="text" class="form-control" value="'.$bodega['direccion_bodega'].'" name="direccion_bodega">';
                            }else{
                                die(header('Location:http://localhost/admin/bodega/?message=error'));
                            }
                        }
                    }else{
                        die(header('Location:http://localhost/admin/bodega/?message=error'));
                    }
                ?>
                <button type="submit" class="text-light btn btn-warning mt-3 float-right"><i class="fas fa-edit"></i> Modificar</button>
                <a class="text-light btn btn-danger mt-3 float-left" href="http://localhost/admin/bodega/"
                ><i class="fas fa-window-close"></i> Cancelar</a>
            </form>
        </div>
    </div>
    </div>
    <!-- Footer -->
    <?php include_once '../../base/footer.inc'; ?>
</body>
</html>