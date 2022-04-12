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
		
		function __construct( $nombre = '', $pass = '' )
		{
			$this->_nombre = $nombre;
			$this->_pass = $pass;
		}

		public function setId( $id ){	$this->_id = $id; }
		public function getId(){ return $this->_id; }
		public function setfirstname( $name ){	$this->firstName = $name; }
		public function getfirstname(){ return $this->firstName; }
		public function setLastname( $lastName ){	$this->lastName = $lastName; }
		public function getLastname(){ return $this->lastName; }
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


		private function encryptPass($pass)
		{
			$this->pass = hash('sha256', $pass);

			return $this->pass;
		}

	}
?>