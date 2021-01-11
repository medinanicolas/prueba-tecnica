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
     * Header
     */
    include_once '../../base/header.inc';
    require_once '../../base/require.php';
    /**
     * Si se ha enviado el ID por GET entonces lo utiliza para eliminar la bodega
     */
    if(isset($_GET['id'])){
        $sql = "DELETE FROM bodega WHERE id_bodega = " . $_GET['id'];
        if($resultado = $conexion->query($sql)){
            (new SweetAlertMessages)->success($path = '.');
            exit;
        }else{
            (new SweetAlertMessages)->error($path = '.');
            exit;
        }
    }
?>
</body>
</html>
