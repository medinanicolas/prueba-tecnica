<?php
    session_start();
    if(isset($_SESSION['tipo_usuario'])){
        if($_SESSION['tipo_usuario']==='Administrador'){
            header('Location:../admin/');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identificación</title>
    <?php 
    /**
     * integración de boostrap y sus componentes escenciales
     */
    include_once '../base/header.inc'; ?>
</head>
<body style="background-image: url('../base/images/arch1.jpg'); background-size: cover">     
<div class="container pt-5">
    <div class="row justify-content-center p-5 mt-5 border bg-light">
        <div class="col-7 px-0">
            <h1 class="text-center">GESTION DE BODEGA</h1>
            <h5 class="text-center" >BIENVENIDO</h5>
            <form action="validar.php" method="POST" class="form-group" enctype="application/x-www-form-urlencoded">
                <label for="usuario">Ususario:</label>
                <input type="text" class="form-control" placeholder="username" name="usuario">

                <label for="password">Password:</label>
                <input type="password" class="form-control" placeholder="password" name="password">

                <input type="submit" class="btn btn-primary mt-3 float-right" value="Entrar">
            </form>
        </div>
    </div>
    </div>
    <?php
    /**
     * Plantilla footer
     */
    include_once '../base/footer.inc'; ?>
</body>
</html>