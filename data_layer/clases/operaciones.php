<?php
	class Operaciones{

    /*Procesa las operaciones
     Parametros: $prmParametrosProcesar
     enumOperacion Operacion
     string StringSQL
     string NombreSP
     public List<struParametrosValor> ListaParametros { get; set; } (ojo implementar)
     bool DevuelveValor
     string MsgError
    */  
public function procesar_operacion(&$parametrosProcesar, $camposValores){
    
    $resultado = null;
    //Obtiene los parametros de configuración de la base de datos para saber que manejador utilizar
    require_once('../config/database.php');
    require_once('../data_layer/modelos/general.php');
    switch ($DB_MANEJADOR) {

        case EnumManejadorBD::MYSQL: //MySql
            require_once('../data_layer/clases/conector_mysql.php');
            $objConectorMySQL = new ConectorMySql();
            //llama la clase conector mysql
            switch ($parametrosProcesar['Operacion']) {
             	//-----------------SELECCIONAR----------------------------------------
        	    case EnumOperacion::SELECCIONAR:
        	        echo "es igual a SELECCIONAR";
        	        break;
        	    //------------------INSERTAR, MODIFICAR, ELIMINAR---------------------
        		case EnumOperacion::ACTUALIZAR:
        		    echo "es igual a INSERTAR, MODIFICAR, ELIMINAR";
        		    break;
        		//------------------STORED PROCEDURE----------------------------------
        		case EnumOperacion::STORED_PROCEDURE:
        					        
                    $resultado = $objConectorMySQL->Ejecutar_Stored_Procedure($parametrosProcesar, $camposValores);
                    break;
        	}
            //Limpia objeto conectormysql
            break;
    }

    //ACA DEBE RETORNAR RESULTADO
    return $resultado;

}// fin procesar_operaciones

		public function test_conexion_bd(&$prmMsgError)
        {

            //$resultado = 'false';
            //Obtiene los parametros de configuración de la base de datos para saber que manejador utilizar
            require_once('config/database.php');
            switch ($DB_MANEJADOR)
            {
                case EnumManejadorBD::MYSQL: //MySQL
                     require_once('datalayer/clases/conector_mysql.php');
                     $objDB = conectormysql::conectar($prmMsgError);
                     if (!$objDB==null)
                     {
                        $resultado = true;
                     }
                     else
                     {
                     	$resultado = false;
                     }
                     $objDB = null;
                     //ver como cerrar la base de datos
                     break;
            }

            return $resultado;

        }
		
	} //Fin clase
?>