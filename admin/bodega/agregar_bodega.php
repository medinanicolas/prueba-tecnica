<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Bodega</title>
    <!-- Header & Reqs-->
    <?php include_once '../../base/header.inc'; ?>
    <?php require_once '../../base/require.php'; ?>
</head>
<body>
    <?php require_once '../../base/sweetalert.php'; ?>
    <!-- Barra de Navegación -->
    <?php include_once '../../base/nav.inc'; ?>
    <!-- Contenido -->
    <?php
    if(isset($_POST['nombre_bodega']) && isset($_POST['direccion_bodega'])){
        $nombre_bodega = $_POST['nombre_bodega'];
        $direccion_bodega = $_POST['direccion_bodega'];
        $sql = "INSERT INTO bodega VALUES(null, '$nombre_bodega', '$direccion_bodega')";
        if($resultado = $conexion->query($sql)){
            /**
             * En caso de ser exitosa la operación envía un mensage con un parametro GET
             * que será interceptado por 'sweetalert.php', el que enviará una alerta 
             * con el mensaje correspondiente
             */
            (new SweetAlertMessages)->success($path = '.');
            exit;

        }else{
            /**
             * En caso contratio termina la operación con un mensaje de error
             */
            (new SweetAlertMessages)->error($path = '.');
            exit;
        }
    }
    ?>
    <div class="container pt-5">
    <div class="row justify-content-center p-5 border bg-light">
        <div class="col-6 p-0">
            <h1 class="text-center">AGREGAR BODEGA</h1>
            <!-- Formulario POST para agregar bodegas -->
            <form action="./agregar_bodega.php" method="POST" class="form-group" enctype="application/x-www-form-urlencoded">
                <label for="nombre_bodega">Nombre Bodega:</label>
                <input type="text" class="form-control" placeholder="ej. Bodega de Ejemplo #1" name="nombre_bodega">

                <label for="direccion_bodega">Dirección Bodega:</label>
                <input type="text" class="form-control" placeholder="ej. Dirección de ejemplo #123" name="direccion_bodega">

                <button type="submit" class="text-light btn btn-success mt-3 float-right"><i class="fas fa-plus-circle"></i> Agregar</button>
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