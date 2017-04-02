<?php

/**
* 
*/
class Seguridad
{

//Inserta el usuario que se registra
public function registrar_usuarios(&$prmDatosUsuario){

    $respuesta = 0; //Respuesta que se envia a las otras capas
    //Instancia un objeto de Data Layer -----------------
    require_once('../data_layer/clases/operaciones.php');
    $objDataLayer = new Operaciones();
    //---------------------------------------------------
    $datosObtenidos = null; //Para los datos obtenidos
    //--------------------------------------------------------------------------
	//Arma el XML con los datos del usuario
    $stringXML=<<<XML
<Parametros>
 <Datos prm_user_name = $prmDatosUsuario->getNombre()    prm_first_name = $prmDatosUsuario->getNombre()
        prm_last_name = $prmDatosUsuario->getApellido()
        prm_email_main = $prmDatosUsuario->getApellido()
 />
</Parametros>
XML;

$datosXML = new SimpleXMLElement($stringXML);
echo $datosXML->asXML();

	/*$newsXML = new SimpleXMLElement('<Parametros></Parametros>');
	//$newsXML->addAttribute('newsPagePrefix', 'value goes here');
	$newsIntro = $newsXML->addChild('Datos');
	$newsIntro->addAttribute('prm_user_name', $prmDatosUsuario->getNombre()); //OJO cambiar por username
	$newsIntro->addAttribute('prm_first_name', $prmDatosUsuario->getNombre());
	$newsIntro->addAttribute('prm_last_name', $prmDatosUsuario->getApellido());
	$newsIntro->addAttribute('prm_email_main', $prmDatosUsuario->getApellido()); //OJO cambiar por email
	//Header('Content-type: text/xml');
	$datosXML = $newsXML->asXML();*/

    //--------------------------------------------------------------------------
    require_once('../data_layer/modelos/general.php');
	$parametrosProcesar = array('Operacion' => EnumOperacion::STORED_PROCEDURE, 
                               'stringSQL' => "SP_REGISTRAR_USUARIOS (:prm_XMLParametros,:prm_operacion,@prm_id_user)",
                               'devuelveValor' => true,
                               'MsgError' => ''
                               );
    $camposValores = array();
    $camposValores[0] = array('nombre'=>':prm_XMLParametros', 'tipo'=>PDO::PARAM_STR, 'valor'=> $datosXML, 'direccion'=>'IN');
    $camposValores[1] = array('nombre'=>':prm_operacion', 'tipo'=>PDO::PARAM_STR, 'valor'=> "INSERTAR",'direccion'=>'IN');
    $camposValores[2] = array('nombre'=>'@prm_id_user', 'tipo'=>PDO::PARAM_INT, 'valor'=> "ninguno", 'direccion'=> 'OUT');
        
    //--------------------------------------------------------------------------
    try
        {
          
          $datosObtenidos = $objDataLayer -> Procesar_Operacion($parametrosProcesar, $camposValores);
          
          if(strlen($parametrosProcesar['MsgError']) > 0){
             $respuesta = $parametrosProcesar['MsgError'];
          }


          //$respuesta = $datosObtenidos;

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
        }
        catch (Exception $errException)
        {
                /*prmMsgError = errException.Message + Environment.NewLine + Environment.NewLine +
                     "Ocurrido en: " + Environment.NewLine +
                     MethodBase.GetCurrentMethod().DeclaringType.FullName + "." + MethodBase.GetCurrentMethod().Name;*/
        }

	   return $respuesta;

	}//Fin funcion registrar_usuarios
	
}//Fin Class Seguridad
?>