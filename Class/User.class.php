<?php

	class User
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
		public function getActivation(){ return $this->activation; }
		public function setState( $state ){	$this->state = $state; }
		public function getState(){ return $this->state; }
		public function setAdmin( $admin ){	$this->admin = $admin; }
		public function getAdmin(){ return $this->admin; }
		
		public function setActivation(){	
			$string = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789ª!·$%&/()=?¿*^¨ç_:;\|@#~€¬][}{}]";
			$key = str_shuffle($string);
			$key = md5($key);
			$this->activation = $key;
		}
		public function createUser($con)
		{
			$this->pass = $this->encryptPass($this->pass);
			$sql = sprintf( "INSERT INTO users( firstname, lastname, email, pass, activation, state, admin) VALUES ( '%s', '%s', '%s','%s', '%s', '%s', '%s')", $this->firstName, $this->lastName , $this->email, $this->pass, $this->activation,$this->state,$this->admin );
			$user = $con->prepare($sql);
			return $user;

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
				header("location:". BACK_END_URL."/profile?rta=" . $rta);
			} else {
				$rta = "0x019";
				header("location:  " . FRONT_END_URL . "/login?rta=" . $rta);
			}
		}

		public function emailActivation(){
					$url_activation = BACK_END_URL . "/";
                    $url_activation.= "user.php";
                    $url_activation.= "?u=" . $email;
                    $url_activation.= "&k=" . $key;
                    $url_activation.= "&action=activeUser";
    
                    $body = "<h1>Welcome</h1>";
                    $body.= "<br>";
                    $body.= "firstname: " . $firstname;
                    $body.= "<br>";
                    $body.= "lastname: " . $lastname;
                    $body.= "<br>";
                    $body.= "user: " . $email;
                    $body.= "<br>";
                    $body.= "<p>please activate your account </p>";
                    $body.= "<a style='background-color:blue;color:white;display:block;padding:10px' href='".$url_activation."'>activate your account</a>";
    
                    $header = "From: no-reply@" . $_SERVER["SERVER_NAME"] . "\r\n";
                    $header.= "MIME-Version: 1.0" . "\r\n";
                    $header.= "Content-Type: text/html; charset=utf-8" . "\r\n";
    
                    mail($email, "Welcome", $body, $header);
		}
		private function encryptPass($pass)
		{
			$this->pass = password_hash($pass, PASSWORD_DEFAULT);
			return $this->pass;
		}



	}
?>