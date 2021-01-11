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