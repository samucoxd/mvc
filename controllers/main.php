<?php

class Main extends Controller{

    function __construct(){
        parent::__construct();
        
        //echo "<p>Nuevo Controllers Main</p>";
    }
    function render(){
        $this->view->render('main/index');
    }
}

?>