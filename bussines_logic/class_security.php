<?php
/**
* 
*/
class Seguridad {

    //Registra el usuario en la base de datos
    public function registrar_usuarios(&$prmDatosUsuario){
      
        $respuesta = 0; //Respuesta que se envia a las otras capas
        $datosObtenidos = null; //Para los datos obtenidos
        //Instancia un objeto de Data Layer -----------------
        require_once('../data_layer/clases/operaciones.php');
        $objDataLayer = new Operaciones();
        //---------------------------------------------------
        $xmlData =
        "<Parametros>
        <Datos prm_user_name = 'demo' prm_first_name = 'pedro' prm_last_name = 'perez' prm_email_main = 'mail@hotmail.com' />
        </Parametros>";
        //$xmlEnviar = simplexml_load_string($xmlData) or die("Error: Cannot create object");
        //print_r($xmlEnviar);

        //--------------------------------------------------------------------------
        //'stringSQL' => "SP_REGISTRAR_USUARIOS (:prm_XMLParametros,:prm_operacion,@prm_id_user)",
        require_once('../data_layer/modelos/general.php');
        $parametrosProcesar = array('Operacion' => EnumOperacion::STORED_PROCEDURE, 
                               'stringSQL' => "SP_REGISTRAR_USUARIOS (:prm_XMLParametros,:prm_operacion,@prm_id_user);",
                               'devuelveValor' => true,
                               'MsgError' => ''
                               );
        $camposValores = array();
        $camposValores[0] = array('nombre'=>':prm_XMLParametros', 'tipo'=>PDO::PARAM_STR, 'valor'=> $xmlData, 'direccion' => 'IN');
        $camposValores[1] = array('nombre'=>':prm_operacion', 'tipo'=>PDO::PARAM_STR, 'valor'=> "INSERTAR",'direccion'=>'IN');
        $camposValores[2] = array('nombre'=>'@prm_id_user', 'tipo'=>PDO::PARAM_INT, 'valor'=> 0, 'direccion'=> 'OUT');
        try{
                       
           $datosObtenidos = $objDataLayer -> Procesar_Operacion($parametrosProcesar, $camposValores);
          
           if(strlen($parametrosProcesar['MsgError']) > 0){
              $respuesta = $parametrosProcesar['MsgError'];
           }
           else{
               $respuesta = $datosObtenidos;
           }

          /*if (strlen(enviarParametrosSP['MsgError']) > 0)
            {
             prmMsgError = enviarParametrosSP.MsgError;
            }
            else
            {
                    foreach (Dictionary<string, object> item in resultado)
                    {
                        if (Convert.ToInt32(item["prm_id_motivo"]) > 0)
                            respuesta = Convert.ToInt32(item["prm_id_motivo"]);
                    }
                }
                //TODO listParametros = null;
                objDataLayer = null;*/
            
            
            
        } catch (Exception $errException) {
             /*prmMsgError = errException.Message + Environment.NewLine + Environment.NewLine +
              "Ocurrido en: " + Environment.NewLine +
              MethodBase.GetCurrentMethod().DeclaringType.FullName + "." + MethodBase.GetCurrentMethod().Name;*/
        }
        return $respuesta;
    } //Fin funcion registrar_usuarios
	
}//Fin Class Seguridad
?>