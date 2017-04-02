<?php 
	require_once('../datalayer/conexion_db.php');
	require_once('../models/usuario.php');
	
	class CrudUsuario{

		public function __construct(){}

		//inserta los datos del usuario
		public function insertar($usuario){

			$db = DB::conectar();
			$insert = $db->prepare('INSERT INTO secu_users (user_name, first_name, last_name, clave) 
				VALUES(:user_name, :first_name, :last_name, :clave)');
            //Parámetros
			$insert->bindValue('user_name',$usuario->getUserName());
			$insert->bindValue('first_name',$usuario->getNombre());
            $insert->bindValue('last_name',$usuario->getNombre());
			//encripta la clave
			$pass=password_hash($usuario->getClave(),PASSWORD_DEFAULT);
			$insert->bindValue('clave',$pass);

			$insert->execute(); //Ejecuta el SQL
			
		}

		//obtiene el usuario para el login
		public function obtenerUsuario($nombre, $clave){
			$db=Db::conectar();
			$select=$db->prepare('SELECT * FROM USUARIOS WHERE nombre=:nombre');//AND clave=:clave
			$select->bindValue('nombre',$nombre);
			$select->execute();
			$registro=$select->fetch();
			$usuario=new Usuario();
			//verifica si la clave es conrrecta
			if (password_verify($clave, $registro['clave'])) {				
				//si es correcta, asigna los valores que trae desde la base de datos
				$usuario->setId($registro['Id']);
				$usuario->setNombre($registro['nombre']);
				$usuario->setClave($registro['clave']);
			}			
			return $usuario;
		}

		//busca el nombre del usuario si existe
		public function buscarUsuario($nombre){
			$db=Db::conectar();
			$select=$db->prepare('SELECT * FROM USUARIOS WHERE nombre=:nombre');
			$select->bindValue('nombre',$nombre);
			$select->execute();
			$registro=$select->fetch();
			if($registro['Id']!=NULL){
				$usado=False;
			}else{
				$usado=True;
			}	
			return $usado;
		}
	}
?>