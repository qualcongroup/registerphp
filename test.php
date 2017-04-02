<?php
 require_once('datalayer/clases/operaciones.php');
 require_once('datalayer/modelos/general.php');


//$foo = array('bar' => 'baz');
 $arrParametros = ['Operacion' => EnumOperacion::STORED_PROCEDURE,
                   'StringSQL' => "XXXXXX",
 ];
 
 //$prmMsgError="";
 $objTEST = operaciones::test_conexion_bd($prmMsgError);


 if ($objTEST == true){
    echo strlen($prmMsgError);
     echo "ar pelo";
 }
 else
 {
    echo strlen($prmMsgError);
   //if(strlen("Hello") > 0)

     //  echo ($prmMsgError);
 }








// $objDB = conectormysql::conectar();

    /*if ($db == null){
    	echo "peos";

    }else{
    	echo "ar pelo";
    }*/
			
/*	}
catch(Exception $e)
            {
            
             echo "Connection failed: " . $e->getMessage();
            }*/
?>