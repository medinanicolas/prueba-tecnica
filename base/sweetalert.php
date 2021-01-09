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
                    window.location.href = '.'
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
                    window.location.href = '.'
                }
            })
        </script>";
    }
?>