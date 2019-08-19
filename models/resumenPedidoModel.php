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

    public function subirExcel($nombreArchivo){

        require constant('URL').'libs/PHPExcel/IOFactory.php';

        //$nombreArchivo = 'prn5A.xls';
        
        $objPHPExcel = PHPEXCEL_IOFactory::load($nombreArchivo);
        
        $objPHPExcel->setActiveSheetIndex(0);
        
        $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
        
        for($i = 5; $i <= $numRows; $i++){
            $date = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
            $fecha = PHPExcel_Style_NumberFormat::toFormattedString($date, "YYYY/M/D");
            $idNota = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
            $noFac = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
            $noCli = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
            $noVen = $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
        
            $query = $this->db->connect()->query("CALL verificarNotaRepetida($idNota,$noFac)")->fetchAll();
            // and somewhere later:
            //print_r($data);
            $repetido=false;
            if(empty($query)){
                $repetido=true;
            }
            echo $repetido;
            //$database->closeConnection();
            if($repetido == true){
                try{
                    //$db = $database->openConnection();
                    // inserting data into create table using prepare statement to prevent from sql injections
                    $stm = $db->prepare("INSERT INTO controlpedido (idNota,fecha,noFac,noClie,cliente,noVende,vendedor) 
                    VALUES (:idNota,:fecha,:noFac,:noClie,:cliente,:noVende,:vendedor)") ;
                    // inserting a record
                    $stm->execute(array(
                    ':idNota' => $idNota ,
                    ':fecha' => $fecha ,
                    ':noFac' => $noFac , 
                    ':noClie' => $noCli,
                    ':cliente' => $cliente,
                    ':noVende' => $noVen,
                    ':vendedor' => $Vendedor));
                    //echo "New record created successfully";
                }
                catch (PDOException $e)
                {
                    echo "There is some problem in connection: " . $e->getMessage();
                }
            }
        }
    }
}

?>