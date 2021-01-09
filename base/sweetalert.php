<?php
/**
 * Comprueba el mensage recibido por GET y suelta el mensaje correspondiente
 *
 * Al hacer clic en 'OK' se redirige a la página actual sin el mensage GET
 */
    if($_GET['message']==='success'){
        echo "<script>
            Swal.fire({
            title:'Enhorabuena!',
            text:'La acción se completó con exito',
            icon:'success'
            })
            .then(function (result) {
                if (result.isConfirmed) {
                    window.location.href = window.location.pathname
                }
            })
        </script>";
    }elseif($_GET['message']==='error'){
        echo "<script>
            Swal.fire({
            title:'Oops..',
            text:'Ha ocurrido un error',
            icon:'error'
            })
            .then(function (result) {
                if (result.isConfirmed) {
                    window.location.href = window.location.pathname
                }
            })
        </script>";
    }elseif($_GET['message']==='error-db'){
        echo "<script>
            Swal.fire({
            title:'Oops..',
            text:'No se pudo realizar la acciòn en la base de datos',
            icon:'error'
            })
            .then(function (result) {
                if (result.isConfirmed) {
                    window.location.href = window.location.pathname
                }
            })
        </script>";
    }elseif($_GET['message']==='not-found'){
        echo "<script>
            Swal.fire({
            title:'Oops...',
            text:'No se han encontrado datos para la consulta',
            icon:'info'
            })
            .then(function (result) {
                if (result.isConfirmed) {
                    window.location.href = window.location.pathname
                }
            })
        </script>";
    }elseif($_GET['message']==='stock'){
        echo "<script>
            Swal.fire({
            title:'Oops...',
            text:'El stock saliente excede el stock actual',
            icon:'warning'
            })
            .then(function (result) {
                if (result.isConfirmed) {
                    window.location.href = window.location.pathname
                }
            })
        </script>";
    }
?>