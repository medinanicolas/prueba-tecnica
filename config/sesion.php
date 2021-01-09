<?php
/**
 * Se trabaja con sesiones para validar los privilegios asignados al usuario
 * 
 * En caso de no tener los privilegios es redirigido al login
 */
    session_start();
    if(isset($_SESSION['tipo_usuario'])){
        if($_SESSION['tipo_usuario']!='Administrador'){
            header('Location:http://localhost/login/');
        }
    }else{
        header('Location:http://localhost/login/');
    }
?>