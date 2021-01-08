<?php
    include 'config/conexion.php';
    $password = md5('5f4dcc3b5aa765d61d8327deb882cf99');
    $sql = 'SELECT  u.rut_usuario,
    u.dv_usuario,
    u.alias_usuario,
    u.password_usuario,
    u.p_apellido_usuario,
    u.id_tipo_usuario,
    tu.nombre_tipo_usuario
FROM usuarios u JOIN tipo_usuario tu ON u.id_tipo_usuario = tu.id_tipo_usuario
WHERE u.alias_usuario = "nmedina" AND u.password_usuario = "$password"';
    if (!$resultado = $conexion->query($sql)){
        echo 'No se ha podido consultar la base de datos';
        exit;
    }else{
        echo $resultado->num_rows;
        while($usuario = $resultado->fetch_assoc()){
	    
            echo 'Bueno aquí tenemos a ' . $usuario['alias_usuario'];
            
        }
    }
    $conexion->close()
?>
