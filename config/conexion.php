<?php
/**
 * @author Nicolás Medina <medinanicolas@protonmail.com>
 * Se establece la conexión con la base de datos
 *
 * Host: localhost
 * User: admin
 * Password: p4ssw0rd
 * Database: gestion_bodegas
 * 
 * En caso de error muestra un mensaje
 */
$conexion = new mysqli('localhost', 'admin', 'p4ssw0rd', 'gestion_bodegas');
if ($conexion -> connect_error){
    die(
        'Error: No se puede conectar a MySQL' . PHP_EOL .
        $conexion->errno . ' ' . $conexion->error . PHP_EOL
    )  ;
}else{
    $conexion->set_charset('utf8');
}
?>