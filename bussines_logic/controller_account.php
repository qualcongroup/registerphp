<?php 
	require_once('../data_layer/modelos/usuario.php');
	require_once('../bussines_logic/class_security.php');
	//require_once('crud_users.php');
	//require_once('../datalayer/conexion_db.php');

	//inicio de sesion
	session_start();

	$objModelUser = new Usuario();  //Modelo de Usuarios
	$objBussinesLogic = new Seguridad(); //Objeto de Clase Seguridad
	//SI ES PARA REGISTRARSE
	if (isset($_POST['registrarse'])) {

		$objModelUser->setUserName($_POST['nombre']); //OJO ver si queda este Username o se genera automaticao
		$objModelUser->setNombre($_POST['nombre']);
		$objModelUser->setApellido($_POST['apellido']);
		$objModelUser->setClave($_POST['clave']);

        //
        $respuesta = $objBussinesLogic->registrar_usuarios($objModelUser);
        echo $respuesta;    

		//$crud->insertar($objModelUser);
		//header('Location: login.php');
		
		//Validar si existe ya el usuario
		/*if ($crud->buscarUsuario($_POST['usuario'])) {
			$crud->insertar($usuario);
			header('Location: index.php');
		}else{
			header('Location: error.php?mensaje=El nombre de usuario ya existe');
		}*/		
		
	}elseif (isset($_POST['entrar'])) { //verifica si la variable entrar está definida
		$usuario=$crud->obtenerUsuario($_POST['usuario'],$_POST['pas']);
		// si el id del objeto retornado no es null, quiere decir que encontro un registro en la base
		if ($usuario->getId()!=NULL) {
			$_SESSION['usuario']=$usuario; //si el usuario se encuentra, crea la sesión de usuario
			header('Location: cuenta.php'); //envia a la página que simula la cuenta
		}else{
			header('Location: error.php?mensaje=Tus nombre de usuario o clave son incorrectos'); // cuando los datos son incorrectos envia a la página de error
		}
	}elseif(isset($_POST['salir'])){ // cuando presiona el botòn salir
		header('Location: index.php');
		unset($_SESSION['usuario']); //destruye la sesión
	}
?>