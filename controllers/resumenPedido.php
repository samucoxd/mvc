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

}

?>