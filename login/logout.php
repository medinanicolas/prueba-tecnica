<?php
/**
 * Toma la sesión activa y borra sus datos
 * Luego redirige a donde sea necesario
 */
    session_start();
    session_unset();
    session_destroy();
    require_once '../config/sesion.php';
?>