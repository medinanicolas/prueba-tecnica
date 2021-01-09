<?php
    /**
     * Utiliza la sesion para comprobar privilegios
     */
    session_start();
    require_once '../../config/sesion.php';
    /**
     * Configuración de la base de datos
     */
    require_once '../../config/conexion.php';
    /**
     * Si se ha enviado el ID por GET entonces lo utiliza para eliminar el producto
     */
    if(isset($_GET['id'])){
        $sql = "DELETE FROM producto WHERE id_producto = " . $_GET['id'];
        if($resultado = $conexion->query($sql)){
            die(header('Location:http://localhost/admin/productos/?message=success'));
        }else{
            die(header('Location:http://localhost/admin/productos/?message=error-db'));
        }
    }
?>