<?php

class ResumenPedido extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->datos = [];
    }

    function render(){
        $resumen = $this->model->resumenPedido();
        $this->view->datos = $resumen;
        $this->view->render('resumenPedido/index');
    }

    function subirExcel(){
        
        $target_path = constant('URL')."libs/uploads/";
        $target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
        if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
            echo "El archivo ".  basename( $_FILES['uploadedfile']['name']). 
            " ha sido subido";
        } else{
            echo "Ha ocurrido un error, trate de nuevo!";
        }
        $nombreArchivo =$_FILES['uploadedfile']['name'];

        $resumen = $this->model->resumenPedido($nombreArchivo);
        $this->view->render('resumenPedido/subirArchivo');
    }   
        
}

?>