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
     * Si se ha enviado el ID por GET entonces lo utiliza para eliminar la bodega
     */
    if(isset($_GET['id'])){
        $sql = "DELETE FROM bodega WHERE id_bodega = " . $_GET['id'];
        if($resultado = $conexion->query($sql)){
            die(header('Location:http://localhost/admin/bodega/?message=success'));
        }else{
            die(header('Location:http://localhost/admin/bodega/?message=error-db'));
        }
    }
?>