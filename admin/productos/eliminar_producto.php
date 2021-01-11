

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    /**
     * Utiliza la sesion para comprobar privilegios
     */
    include_once '../../base/header.inc';
    require_once '../../base/require.php';
    /**
     * Si se ha enviado el ID por GET entonces lo utiliza para eliminar el producto
     */
    if(isset($_GET['id'])){
        $sql = "DELETE FROM producto WHERE id_producto = " . $_GET['id'];
        if($resultado = $conexion->query($sql)){
            (new SweetAlertMessages)->success('.');
        }else{
            (new SweetAlertMessages)->error('.');
        }
    }
?>
</body>
</html>