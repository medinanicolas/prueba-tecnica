<?php
/**
 * Se trabaja con la sesión iniciada en la validación
 * y se verifica que el usuario tenga los privilegios para ver la página
 */
    session_start();
    require_once '../config/sesion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>

    <?php
    /**
     * Integración de la libreería Boostrap (offline) y sus componentes escenciales
     */
    include_once '../base/header.inc' ?>
</head>
<body> 
    <?php
    /**
     * Integración de plantilla de navegación con boostrap
     */ 
    include_once '../base/nav.inc' ?>
    <div class="container pt-5">
    <div class="row justify-content-center p-5 bg-light">
        <div class="col-6 p-0">
            <h1 class="text-center mb-5">Panel de administración</h1>
            <ul class="list-group list-group-horizontal justify-content-center">
                <li class="list-group-item"><a class="btn btn-white" href=""><img width="100px" 
                    src="../base/images/bodega.png"/><p class="text-center text-primary">Bodegas</p></a></li>
                <li class="list-group-item"><a class="btn btn-white" href=""><img width="100px" 
                    src="../base/images/caja.png"/><p class="text-center text-primary">Productos</p></a></li>
                <li class="list-group-item"><a class="btn btn-white" href=""><img width="100px" 
                    src="../base/images/entrega.png"/><p class="text-center text-primary">Entregas</p></a></li>
                <li class="list-group-item"><a class="btn btn-white" href=""><img width="100px" 
                    src="../base/images/stock.png"/><p class="text-center text-primary">Stock</p></a></li>
                <li class="list-group-item"><a class="btn btn-white" href=""><img width="100px" 
                    src="../base/images/usuario.png"/><p class="text-center text-primary">Usuarios</p></a></li>
            </ul>
        </div>
    </div>
    </div>
    <?php 
    /**
     * Integración de plantilla con boostrap
     */
    include_once '../base/footer.inc'; ?>
</body>
</html>
