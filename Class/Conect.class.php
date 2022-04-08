<?php
    class Conect extends PDO{

        private $host;
        private $user;
        private $password;
        private $db;

        public function __construct($array){
            if(!$array['host']){
                throw new Exception("Error: array['host'] is invalid");
            }

            if(!$array['user']){
                throw new Exception("Error: array['user'] is invalid");
            }

            if(!isset($array['password'])){
                throw new Exception("Error: array['password'] is invalid");
            }

            if(!$array['db']){
                throw new Exception("Error: array['db'] is invalid");
            }
   
            $this->host = $array['host'];
            $this->user = $array['user'];
            $this->password = $array['password'];
            $this->db = $array['db'];
            
        
        }

        public function conect(){
            try {
                $con = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->user, $this->password);
                $con->exec("SET CHARACTER SET utf8");

                return $con;
            }catch (Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }

        }
        
        
    }
    //$conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
    // $conect = $conect->conect();
    // $stmt = $conect->prepare('SELECT * FROM products');
    // $stmt->execute();
    // foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $ind){
    // var_dump($ind);
    // }
?>