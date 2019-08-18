<?php 

class ResumenPedidoModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function resumenPedido(){
        try{
            $query = $this->db->connect()->query("CALL controlPendientes()")->fetchAll();
        return $query;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        
    }
}

?>