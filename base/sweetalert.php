<?php
/**
 * Comprueba el mensage recibido por GET y suelta el mensaje correspondiente
 *
 * Al hacer clic en 'OK' se redirige a la página actual sin el mensage GET
 */
    if($_GET['message']==='success'){
        /**
         * Mensaje de éxito
         */
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
        /**
         * Mensaje de error general
         */
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
        /**
         * Mensaje de error con la base de datos
         */
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
        /**
         * Mensaje de sin resultados para la consulta de la base de datos
         */
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
        /**
         * mensaje para el stock y entregas
         */
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
<?php
class SweetAlertMessages{
    var $title;
    var $text;
    var $icon;
    var $path = 'window.location.pathname';

    private function printmessage($path = null){
        
        if(!empty($path)){
            $this->path = "'".$path."'";
        }
        echo "<script>
        Swal.fire({
        title:'".$this->title."',
        text:'".$this->text."',
        icon:'".$this->icon."'
        })
        .then(function (result) {
            if (result.isConfirmed) {
                    window.location.href = ".$this->path."
            }
        })
        </script>";
    }
    public function success($path = null){
        $this->title='Enhorabuena!';
        $this->text='La acción se completó con exito';
        $this->icon='success';
        $this->printmessage($path);
    }
    public function error($path = null){
        $this->title='Oops..!';
        $this->text='No se ha podido realizar la acción requerida';
        $this->icon='error';
        $this->printmessage($path);
    }
    public function not_found($path = null){
        $this->title='Oh oh..!';
        $this->text='No hemos podido encontrar ningun resultado';
        $this->icon='info';
        $this->printmessage($path);
    }
    public function custom($title = null, $text = null, $icon = null, $path = null){
        $this->title=$title;
        $this->text=$text;
        $this->icon=$icon;
        $this->printmessage($path);
    }
}
?>