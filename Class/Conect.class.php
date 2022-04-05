<?php
    class Conect extends PDO{

        private $host;
        private $usuario;
        private $password;
        private $db;

        public function __construct($array){
            
   
            $this->host = $array['host'];
            $this->user = $array['user'];
            $this->password = $array['password'];
            $this->db = $array['db'];
            
        
        }

        public function conect(){
            $con = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->user, $this->password);
	        $con->exec("SET CHARACTER SET utf8");

            return $con;
        }
        
    }
?>