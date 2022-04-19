<?php

	class Usuario
	{
		private $id=NULL;
		private $firstname=NULL;
		private $lastname=NULL;
		private $email=NULL;
		private $pass=NULL;
		private $activation=NULL;
		private $state=NULL;
		private $admin=NULL;
		private $usuarios=NULL;
		
		function __construct( $email = '', $pass = '' )
		{
			$this->email = $email;
			$this->pass = $pass;
		}

		public function setId( $id ){	$this->_id = $id; }
		public function getId(){ return $this->_id; }
		public function setFirstName( $name ){	$this->firstName = $name; }
		public function getFirstName(){ return $this->firstName; }
		public function setLastName( $lastName ){	$this->lastName = $lastName; }
		public function getLastName(){ return $this->lastName; }
		public function setEmail( $email ){	$this->email = $email; }
		public function getEmail(){ return $this->email; }
		public function setPass( $pass ){	$this->pass = $pass; }
		public function getPass(){ return $this->pass; }
		public function setActivation( $activation ){	$this->activation = $activation; }
		public function getActivation(){ return $this->activation; }
		public function setState( $state ){	$this->state = $state; }
		public function getState(){ return $this->state; }
		public function setAdmin( $admin ){	$this->admin = $admin; }
		public function getAdmin(){ return $this->admin; }

		public function createUse()
		{
			$this->_pass = $this->encryptePass($this->pass);
			$sql = sprintf( "INSERT INTO users( firstname, lastname, email, pass, activation, state, admin) VALUES ( '%s', '%s', '%s','%s', '%s', '%s', '%s')", $this->firstName, $this->lastName , $this->email, $this->pass, $this->activation,$this->state,$this->admin );

			return $sql;

		}
		public function selectUser()
		{
			$sql = sprintf( "SELECT * FROM users WHERE email = '%s'", $this->email );

			return $sql;
		}
		public function User()
		{
			$sql = sprintf( "SELECT * FROM users WHERE idUser = '%d'", $this->id );

			return $sql;
		}

	    public function checkUser($pass){
			if (password_verify($pass, $this->pass)) {
				session_start();
				$_SESSION["user"] = array(
					"firstname" => $this->firstname,
					"lastName" => $this->lastName,
					"email" => $this->email
				);
				$rta = "0x020";
				header("location: ../admin/panel?rta=" . $rta);
			}
		}


		private function encryptPass($pass)
		{
			$this->pass = hash('sha256', $pass);

			return $this->pass;
		}

		

	}
?>