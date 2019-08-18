<?php

class Errores extends Controller{

    function __construct()
    {
        parent::__construct();
        $this->view->mensaje = "Hubo un Error en la solicitud o al cargar la Página";
        $this->view->render('errores/index');
        echo "<p>Error al cargar recuerso</p>";
    }
}

?>