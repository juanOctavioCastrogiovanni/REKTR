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
		private $subject=NULL;
		private $body=NULL;
		
		function __construct( $email = '', $pass = '' )
		{
			$this->email = $email;
			$this->pass = $pass;
		}

		public function setSubject( $subject){	$this->subject = $subject; }
		public function getSubject(){ return $this->subject; }
		public function setBody( $body ){	$this->body = $body; }
		public function getBody(){ return $this->body; }
		public function setId( $id ){	$this->id = $id; }
		public function getId(){ return $this->id; }
		public function setFirstName( $name ){	$this->firstname = $name; }
		public function getFirstName(){ return $this->firstname; }
		public function setLastName( $lastName ){	$this->lastname = $lastName; }
		public function getLastName(){ return $this->lastname; }
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
		
		public function configActivationCode(){	
			$string = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789ª!·$%&/()=?¿*^¨ç_:;\|@#~€¬][}{}]";
			$key = str_shuffle($string);
			$key = md5($key);
			$this->activation = $key;
		}
		public function createUser($con){
			$this->pass = $this->encryptPass($this->pass);
			$sql = sprintf( "INSERT INTO users( firstname, lastname, email, pass, activation, state, admin) VALUES ( '%s', '%s', '%s','%s', '%s', '%d', '%d')", $this->firstname, $this->lastname , $this->email, $this->pass, $this->activation,$this->state,$this->admin );
			$user = $con->prepare($sql);
			return $user;
		}
		
		public function selectUser(){
			$sql = sprintf( "SELECT * FROM users WHERE email = '%s' AND state = %d", $this->email,0);
			return $sql;
		}

		public function User(){
			$sql = sprintf( "SELECT * FROM users WHERE userId = '%d'", $this->id );

			return $sql;
		}

		public function recoveryUser($conect){
			$user = $conect->prepare("UPDATE users SET pass = :pass WHERE email = :email");
            $user->bindParam(":pass", $this->pass, PDO::PARAM_STR);
            $user->bindParam(":email", $this->email, PDO::PARAM_STR);
			return $user;
		}
		
		public function activeUser($conect){
			$user = $conect->prepare("UPDATE users SET state = 1 WHERE email = :email AND activation = :activation");
            $user->bindParam(":email", $this->email, PDO::PARAM_STR);
            $user->bindParam(":activation", $this->activation, PDO::PARAM_STR);
			return $user;
		}

	    public function checkUser($pass){
			if (password_verify($pass, $this->pass)) {
				$_SESSION["user"] = array(
					"firstname" => $this->firstname,
					"lastName" => $this->lastname,
					"email" => $this->email
				);
				return TRUE;
			} 	
			return FALSE;
			
		}

		public function activationMail(){
					$url_activation = BACK_END_URL . "/";
                    $url_activation.= "user.php";
                    $url_activation.= "?u=" . $this->email;
                    $url_activation.= "&k=" . $this->activation;
                    $url_activation.= "&action=activeUser";

					$body = "<!-- 	<div style='background-color: grey; width: 100%; display: flex; justify-content: center;'>
								<img src='./themes/images/logo-250.png' style='width: 100%; max-width: 250px; width: 100%;' > 
							</div> --> 
					<div style='background-color: rgba(0,0,0,.8); width: 100%;'>    
						<div style=' color: whitesmoke; text-align: center; padding-top: 30px;'>
							<div style='margin-bottom: -25px;'><h2>Welcome</h2></div>
							<div style='background-color: rgb(255, 136, 0); height: 0.5px;max-width: 250px; width: 100%; text-align: center; display: inline-block;'></div>
						</div>    
						<div style='margin-top: 10px; '>
							<table style='margin: auto;margin: auto; border-spacing: 5px; max-width: 300px; width: 100%;'>
								<tbody>
									<tr>
										<td style='color: whitesmoke; '><p>Firstname: </p></td>
										<td style='color: whitesmoke; '><p>{$this->firstname}</p></td>
									</tr>
									<tr>
										<td style='color: whitesmoke; '><p>Lastname: </p></td>
										<td style='color: whitesmoke; '><p>{$this->lastname}</p></td>
									</tr>
									<tr>
										<td style='color: whitesmoke; '><p>Email: </p></td>
										<td style='color: whitesmoke; '><p>{$this->email}</p></td>
									</tr>
									
								</tbody>
							</table>
						</div>
						<div style='text-align: center;'>
							<p style='max-width: 500px; width: 100%; color: whitesmoke; text-align: center; display: inline-block;'>Please activate your account</p>
						</div>
						<div style='text-align: center; height: 100px; padding-top: 30px;'>
							<a href='".$url_activation."' style='border-radius: 30px; background: #f3a333;
							color: #ffffff; padding: 10px 15px; text-decoration: none;'>Activate your account</a>
						</div>
					</div>
				<div style='background-color:grey; width: 100%; display: flex; justify-content: center;'>
					<p style='max-width: 500px; width: 100%; color: whitesmoke; text-align: center; display: inline-block;'>
						HTML and CSS design by Juan Octavio Castrogiovanni
						 </p>
				</div>";
    
                       
                    $header = "From: no-reply@" . $_SERVER["SERVER_NAME"] . "\r\n";
                    $header.= "MIME-Version: 1.0" . "\r\n";
                    $header.= "Content-Type: text/html; charset=utf-8" . "\r\n";
                    mail($this->email, "Welcome", $body, $header);
					
		}
		public function contactForm(){
		$body= "<div style='background-color: rgba(0,0,0,.8); width: 100%;'>
				<div style='background: grey; width: 100%; display: flex; justify-content: center;'>
					<img src='./themes/images/logo-250.png' style='width: 100%; max-width: 250px; width: 100%;' >
				</div>    
				<div style=' color: whitesmoke; text-align: center; padding-top: 30px;'>
					<div style='margin-bottom: -25px;'><h2>New contact email</h2></div>
					<div style='background-color: rgb(255, 136, 0); height: 0.5px;max-width: 250px; width: 100%; text-align: center; display: inline-block;'></div>
				</div>    
				<div style='text-align: center;'>
					   <p style='max-width: 500px; width: 100%; color: whitesmoke; text-align: center; display: inline-block;'>Hello, you have received a new contact email::</p>
				   </div> 
				<div style='margin-top: 10px; '>
					<table style='margin: auto;margin: auto; border-spacing: 5px; max-width: 500px; width: 100%;'>
						<tbody>
							<tr>
								<td style='color: whitesmoke; '><p>Name: </p></td>
								<td style='color: whitesmoke; '><p>".$this->firstname."</p></td>
							</tr>
							<tr>
								<td style='color: whitesmoke; '><p>email: </p></td>
								<td style='color: whitesmoke; '><p>".$this->email."</p></td>
							</tr>
							<tr>
								<td style='color: whitesmoke; '><p>subject: </p></td>
								<td style='color: whitesmoke; '><p>".$this->subject."</p></td>
							</tr>
							<tr>
								<td style='color: whitesmoke; '><p>message: </p></td>
								<td style='color: whitesmoke; '><p>".$this->body."</p></td>
							</tr>
						</tbody>
					</table>
				</div>
			
			</div>
			<div style='background-color: grey; width: 100%; display: flex; justify-content: center;'>
				<p style='max-width: 500px; width: 100%; color: whitesmoke; text-align: center; display: inline-block;'>
					HTML and CSS design by Juan Octavio Castrogiovanni
					</p>
			</div>"; 

			$header = "From: no-reply@" . $_SERVER["SERVER_NAME"] . "\r\n";
            $header.= "MIME-Version: 1.0" . "\r\n";
            $header.= "Content-Type: text/html; charset=utf-8" . "\r\n";
            if(mail("iesoctavio@gmail.com", "New contact email", $body, $header)){
				return TRUE;
			}
			return FALSE;
		}

		public function recoveryEmail(){
					$url_activation = BACK_END_URL . "/";
                    $url_activation.= "?page=recovery";
                    $url_activation.= "&u=" . $this->email;
                    $url_activation.= "&k=" . $this->activation;

					$body = "<!-- 	<div style='background-color: grey; width: 100%; display: flex; justify-content: center;'>
									<img src='./themes/images/logo-250.png' style='width: 100%; max-width: 250px; width: 100%;' > 
								</div> -->   
							<div style='background-color:rgba(0,0,0,.8);width:100%;'>
								<div style=' color: whitesmoke; text-align: center; padding-top: 30px;'>
									<div style='margin-bottom: -25px;'><h2>Recovery password</h2></div>
									<div style='background-color: rgb(255, 136, 0); height: 0.5px;max-width: 250px; width: 100%; text-align: center; display: inline-block;'></div>
								</div>    
								<div style='margin-top: 10px; '>
									<table style='margin: auto;margin: auto; border-spacing: 5px; max-width: 300px; width: 100%;'>
										<tbody>
											<tr>
												<td style='color: whitesmoke; '><p>Email: </p></td>
												<td style='color: whitesmoke; '><p>{$this->email}</p></td>
											</tr>		
										</tbody>
									</table>
								</div>
								<div style='text-align: center;'>
									<p style='max-width: 500px; width: 100%; color: whitesmoke; text-align: center; display: inline-block;'>Please click on the link below to reactivate your password.</p>
								</div>
								<div style='text-align: center; height: 100px; padding-top: 30px;'>
									<a href='".$url_activation."' style='border-radius: 30px; background: #f3a333;
									color: #ffffff; padding: 10px 15px; text-decoration: none;'>Reactivate your password.</a>
								</div>
							</div>
							<div style='background-color:grey; width: 100%; display: flex; justify-content: center; '>
								<p style='max-width: 500px; width: 100%; color: whitesmoke; text-align: center; display: inline-block;'>
									HTML and CSS design by Juan Octavio Castrogiovanni
								</p>
							</div>";
    
                    $header = "From: no-reply@" . $_SERVER["SERVER_NAME"] . "\r\n";
                    $header.= "MIME-Version: 1.0" . "\r\n";
                    $header.= "Content-Type: text/html; charset=utf-8" . "\r\n";

					
                    mail( $this->email, "Recovery password", $body, $header);

		}
		private function encryptPass($pass){
			$this->pass = password_hash($pass, PASSWORD_DEFAULT);
			return $this->pass;
		}



	}
?>