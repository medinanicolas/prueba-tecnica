<?php
    session_start();
    require_once '../config/sesion.php';
?>
HOLA
<a href="<?php session_destroy() ?>">cerrar sesion</a>