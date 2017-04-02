<?php 
	/*
	*
	*
	*/
	class Usuario{

		private $id_user;
		private $user_name;
		private $first_name;
		private $last_name;
		//private $email_main;
		private $clave;

        public function getIdUser(){
			return $this->id_user;
		}

		public function setIdUser($id_user){
			$this->id_user = $id_user;
		}

		public function getUserName(){
			return $this->user_name;
		}

		public function setUserName($user_name){
			$this->user_name = $user_name;
		}

		public function getNombre(){
			return $this->first_name;
		}

		public function setNombre($first_name){
			$this->first_name = $first_name;
		}

        public function getApellido(){
			return $this->last_name;
		}

		public function setApellido($last_name){
			$this->last_name = $last_name;
		}

		public function getClave(){
			return $this->clave;
		}

		public function setClave($clave){
			$this->clave = $clave;
		}
	}
?>