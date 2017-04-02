<?php
	class ConectorMySql
	{
        
		private static $conexion=null;
		//private function __construct(){}

		public static function conectar(&$prmMsgError){

			try {
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				include('../config/database.php');
				self::$conexion = new PDO('mysql:host='.$DB_HOST.';dbname='.$DB_DATABASE,
					$DB_USER, $DB_PASSWORD, $pdo_options);
		    }
		    catch(PDOException $e)
            {
             $conexion = null;
             //$prmMsgError = 'error';
             $prmMsgError = $e->getMessage();
            }

			return self::$conexion;
		}


        public function Ejecutar_Stored_Procedure(&$parametrosProcesar, $camposValores)
        {
            try{
            require_once('../config/database.php');
            require_once('conector_mysql.php');
            $objDB = conectormysql::conectar($prmMsgError);
            $resultado = null;
            if (!$objDB == null){
                
                // Prepara el SQL statement
                $statement = $objDB->prepare("CALL ".$parametrosProcesar['stringSQL']);
                //Agrega los parametros y los valores
                foreach($camposValores as $campo){
                    $statement->bindValue($campo['nombre'], $campo['valor'], $campo['tipo']);
                    echo $campo['valor'];
                }
    
                // Ejecuta el stored procedure
                $statement->execute();
    
                if($parametrosProcesar['devuelveValor'] == true){ //Si devuelve valor
                    foreach($camposValores as $campo){
                        if ($campo['direccion'] == 'OUT'){
                            $resultado = array($campo['nombre'] => $objDB->query("SELECT ".$campo['nombre'])->fetch(PDO::FETCH_ASSOC));
                        }
                    }
                }
                else
                    {
                        $resultado = array('resultado' => true);
                    }
            }
            else{
                $resultado = array('resultado' =>  false);
            }
            
            }
            catch (Exception $errException)
            {
                $resultado = array('resultado' =>  false);
                $parametrosProcesar['MsgError'] =  $errException->getMessage();
            }

            //List<Dictionary<string, object>> resultado = new List<Dictionary<string, object>>();//Resultado
            //prmParametros.MsgError = "";
            /*try
            {
                objConnMySQL = ConnectMySQL(); //Obtiene conexión con la Base de Datos
                if (objConnMySQL != null)
                {
                    objComand = new MySqlCommand(null, objConnMySQL);
                    objComand.CommandText = prmParametros.NombreSP;
                    objComand.CommandType = CommandType.StoredProcedure;
                    
                    foreach (General.struParametrosValor parametroValor in prmParametros.ListaParametros)
                    {
                        objComand.Parameters.Add(String.Concat("@", parametroValor.Campo), Convertir_Tipo_Dato(parametroValor.TipoDato)).Value = parametroValor.Valor;
                        objComand.Parameters[String.Concat("@", parametroValor.Campo)].Direction = parametroValor.Direccion;
                    }

                    objComand.ExecuteNonQuery();//Ejecuta el Stored Procedure
                    
                    if (prmParametros.DevuelveValor)
                    {
                        foreach (General.struParametrosValor parametro in prmParametros.ListaParametros)
                        {
                            if (parametro.Direccion== ParameterDirection.Output) {
                                resultado.Add(new Dictionary<string, object> { { parametro.Campo, objComand.Parameters[String.Concat("@", parametro.Campo)].Value } });
                            }
                        }
                    }
                    else
                    {
                        resultado.Add(new Dictionary<string, object> { { "resultado", true } });
                    }
                }
            }
            catch (MySqlException mySqlExcep)
            {
                resultado.Add(new Dictionary<string, object> { { "resultado", false } });
                switch (mySqlExcep.Number)
                {
                    case 1062:
                        prmParametros.MsgError = "No se pueden insertar valores duplicados, por favor verifique." + Environment.NewLine + Environment.NewLine +
                          "Ocurrido en: " + Environment.NewLine + prmParametros.NombreSP + Environment.NewLine + 
                          MethodBase.GetCurrentMethod().DeclaringType.FullName + "." + MethodBase.GetCurrentMethod().Name;
                        break;
                    case 1451:
                        prmParametros.MsgError = "No se puede eliminar ya que tiene datos relacionados, por favor verifique." + Environment.NewLine + Environment.NewLine +
                          "Ocurrido en: " + Environment.NewLine + prmParametros.NombreSP + Environment.NewLine +
                          MethodBase.GetCurrentMethod().DeclaringType.FullName + "." + MethodBase.GetCurrentMethod().Name;
                        break;
                    default:
                        prmParametros.MsgError = mySqlExcep.Message + Environment.NewLine + Environment.NewLine +
                            "Ocurrido en: " + Environment.NewLine + prmParametros.NombreSP + Environment.NewLine + 
                            MethodBase.GetCurrentMethod().DeclaringType.FullName + "." + MethodBase.GetCurrentMethod().Name;
                        break;
                }
            }
            catch (Exception errException)
            {
                resultado.Add(new Dictionary<string, object> { { "resultado", false } });
                prmParametros.MsgError = errException.Message + Environment.NewLine + Environment.NewLine +
                           "Ocurrido en: " + Environment.NewLine + prmParametros.NombreSP + Environment.NewLine +
                           MethodBase.GetCurrentMethod().DeclaringType.FullName + "." + MethodBase.GetCurrentMethod().Name;
            }
            finally
            {
                if (objComand != null) objComand.Dispose();
                if (objConnMySQL != null) if (objConnMySQL.State == ConnectionState.Open) objConnMySQL.Close();
            }*/
            return $resultado;
        }

	}
?>