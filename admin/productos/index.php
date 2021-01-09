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
    <title>Bodegas</title>
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
    <div class="row justify-content-center p-5 bg-light">
        <div class="col-12 p-0">
            
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
                    cancelbuttonText: "Cancelar",
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