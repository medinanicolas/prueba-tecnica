<?php
/**
 * Archivo de validación para incio de sesión en el sistema
 * 
 * incluye la configuración de la conexión a la base de datos
 */
    require_once "../config/conexion.php";
/**
 * Recibe los parametros desde el formulario de login
 */
    $usuario = $_POST['usuario'];
/**
 * Encripta la contraseña del formulario para compararla
 * con el hash de la base de datos
 */
    $password = md5($_POST['password']);

    $sql = "SELECT  u.rut_usuario,
                    u.dv_usuario,
                    u.alias_usuario,
                    u.password_usuario,
                    u.p_apellido_usuario,
                    u.id_tipo_usuario,
                    tu.nombre_tipo_usuario
            FROM usuarios u JOIN tipo_usuario tu ON u.id_tipo_usuario = tu.id_tipo_usuario
            WHERE u.alias_usuario = '$usuario' AND u.password_usuario = '$password'";
    if (!$resultado = $conexion->query($sql)){
        echo $conexion->error;
        exit;
    }else{
        $user=$resultado->fetch_assoc();
        if($resultado->num_rows === 1){
            /**
             * Si el resultado de la consulta arroja un usuario coincidente
             * entonces se inicia la sesión de php
             */
            session_start();
            $sql = "SELECT id_tipo_usuario FROM tipo_usuario WHERE nombre_tipo_usuario LIKE 'Administrador'";
            if(!$resultado = $conexion->query($sql)){
                echo 'Error: No se ha podido realizar la consulta';
            }else{
                $tipo_usuario = $resultado->fetch_assoc();
            }
            $_SESSION['rut_usuario'] = $user['rut_usuario'] . '-' . $user['dv_usuario'];
            $_SESSION['alias_usuario'] = $user['alias_usuario'];
            $_SESSION['nombre_usuario'] = $user['nombre_usuario'] . ' ' . $user['p_apellido_usuario'];
            $_SESSION['tipo_usuario'] = $user['nombre_tipo_usuario'];
            /**
             * Se redirige al usuario a donde corresponda
             * 
             * En este caso Administrador es el único rol existente
             * por lo tanto se redirige a la gestión de bodegas
             * 
             * Caso contratio vuelve al login nuevamente
             */
            if($user['id_tipo_usuario'] === $tipo_usuario['id_tipo_usuario']){
                header('Location:../admin/');
            }else{
                die(header('Location:index.php?error=usertype'));
            }
        }else{
            echo die('Error: No existe el usuario o la contraseña es invalida');
        }
    }
?>