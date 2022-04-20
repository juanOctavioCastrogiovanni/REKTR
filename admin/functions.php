<?php
    include $_SERVER["DOCUMENT_ROOT"] ."/php-ecommerce/init.php";
    


      function roundDown($a,$b){
        if($a%$b!=0){
            return ($a/$b)-1;
        }
        return ($a/$b);
    }

    function filterQuery($page,$category,$min,$max,$sort,$limit){
        if($limit){
            if($category){    
                return preQuery($page,"WHERE categories.idCategory=:category",$min,$max,$sort,"LIMIT 8 OFFSET ". 8*$page);
            } else {
                return preQuery($page," ",$min,$max,$sort, "LIMIT 8 OFFSET ". 8*$page);
            }
        } else {
            if($category){    
                return preQuery($page,"WHERE categories.idCategory=:category",$min,$max,$sort," ");
                } else {
                return preQuery($page," ",$min,$max,$sort," ");
            }
        }
    }

    //this functions prepare all querys for filter. 
    function preQuery($page,$category,$min,$max,$sort,$limit){
        //if nobody query url exist. 
        if($min==NULL&&$max==NULL&&$sort==NULL){
            return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category $limit";
        }
        //if just exist sort param. 
        if($min==NULL&&$max==NULL){
            //is sort asc?. 
            if($sort=="asc"){
                return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category ORDER BY price ASC $limit";
            } else if($sort=="desc"){
                return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category ORDER BY price DESC $limit";
            }
        }
        //if just exist min param. 
        if($max==NULL&&$sort==NULL){
            return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category AND products.price > $min $limit";
        }
        //if just exist max param. 
        if($min==NULL&&$sort==NULL){
            return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category AND products.price < $max $limit";
        }
        //if exist min and max params. 
        if($sort==NULL){
            return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category AND products.price BETWEEN $min AND $max $limit";
        }
        //if exist min and sort params. 
        if($min==NULL){
            //is sort asc?. 
            if($sort=="asc"){
                return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category AND products.price < $max ORDER BY price ASC $limit";
            } else if($sort=="desc"){
                return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category AND products.price < $max ORDER BY price DESC $limit";
            }
        }
        
        //if exist min and sort params. 
        if($max==NULL){
            if($sort=="asc"){
                return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category AND products.price > $min ORDER BY price ASC $limit";
            } else if($sort=="desc"){
                return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category AND products.price > $min ORDER BY price DESC $limit";
            }
        }

        // this is the last way, exist params all
        if($sort=="asc"){
                return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category AND products.price BETWEEN $min AND $max  ORDER BY price ASC $limit";
            }else if($sort=="desc"){
                return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category AND products.price BETWEEN $min AND $max  ORDER BY price DESC $limit";
            }
    }

    function filterUrl($p1,$p2,$p3,$p4){
        $array = array();
        if($p1!=""){
            array_push($array,'category='.$p1);
        }
        if($p2!=NULL){
            array_push($array,'min='.$p2);
        }
        if($p3!=NULL){
            array_push($array,'max='.$p3);
        }
        if($p4!=NULL){
            array_push($array,'sort='.$p4);
        }
        return "products?".implode('&',$array);
    }

    // Design an error array to display several errors simultaneously in validation
    // $errors=array();
    // if ( $email == "" || filter_var($email, FILTER_VALIDATE_EMAIL) === false ) {
    //     //email validation;
    //     array_push($errors,'email invalid, please check your mail');
    //     header("location: ./user/login");
    // }
    
    // if ( $pass == "" || count($pass) < 8 ) {
    //     //pass validation;
    //     array_push($errors,'password invalid, you not use less 8 chars');
    //     header("location: ./user/login");
    // }
    
		function showMenssage($cod){

            switch ($cod) {
                case '0x001':
                    $mensaje = "El firstname ingresado no es válido";
                break;
                
                case '0x002':
                    $mensaje = "El e-mail ingresado no es válido";
                break;
    
                case '0x003':
                    $mensaje = "El mensaje ingresado no es válido";
                break;
    
                case '0x004':
                    $mensaje = "Su consulta ha sido enviada... muchas gracias!";
                break;
    
                case '0x005':
                    $mensaje = "Ocurrio un error, intente de nuevo";
                break;
    
                case '0x006':
                    $mensaje = "Se creo un nuevo producto satisfactoriamente";
                break;
    
                case '0x007':
                    $mensaje = "Error al crear un producto";
                break;
    
                case '0x008':
                    $mensaje = "Se actualizo el producto satisfactoriamente";
                break;
    
                case '0x009':
                    $mensaje = "Error al actualizar el producto";
                break;
    
                case '0x010':
                    $mensaje = "Se elimino el producto satisfactoriamente";
                break;
    
                case '0x011':
                    $mensaje = "Error al eliminar el producto";
                break;
    
                case '0x012':
                    $mensaje = "Error al subir la imagen.";
                break;
    
                case '0x013':
                    $mensaje = "User already exists";
                break;
    
                case '0x014':
                    $mensaje = "Correct registration! Check your email to activate your account.";
                break;
    
                case '0x015':
                    $mensaje = "Registration failed, please try again";
                break;
    
                case '0x016':
                case '0x017':
                    $mensaje = "Activation invalid";
                break;
    
                case '0x018':
                    $mensaje = "sussessful acount!";
                break;
    
                case '0x019':
                    $mensaje = "your certificates are invalid, please check your email or password";
                break;
    
                case '0x020':
                    $mensaje = "Successful login";
                break;
    
                case '0x021':
                    $mensaje = "Thanks for comming";
                break;
    
                case '0x022':
                    $mensaje = "An email has been sent to your email address to recover your password. ";
                break;
    
                case '0x023':
                    $mensaje = "Email invalid";
                break;
    
                case '0x024':
                    $mensaje = "successful key update!";
                break;
    
                case '0x025':
                    $mensaje = "Password invalid!";
                break;
    
                case '0x026':
                    $mensaje = "Error, password is not update";
                break;
                case '0x027':
                    $mensaje = "Passwords are not the same";
                break;
            }
            return "<p class='rta rta-".$cod."'>".$mensaje."</p>";
        }

        function login($email, $pass){
            $rta = "0x019";         
            try{ 
                $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
                $conect = $conect->conect();
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }
            
            $user = $conect->prepare("SELECT * FROM users WHERE email = :email AND state = 1");
            $user->bindParam(":email", $email, PDO::PARAM_STR
        );
            
            if ( $user->execute() && $user->rowCount() > 0 ) {
                $user = $user->fetch();
                var_dump('usuario encontrado');
                try{ 
                    $newUser = new User($user['email'],$user['pass']);
                    $newUser->setId($user['idUser']);
                    $newUser->setFirstName($user['firstname']);
                    $newUser->setLastName($user['lastname']);
                    $newUser->checkUser($pass);
                }catch(Exception $e){
                    echo "<p>".$e->getMessage()."</p>";
                }
                unset($conect);
                var_dump('usuario encontrado');
                die();
                header("location:  " . FRONT_END_URL . "/login?rta=" . $rta);
            }
            
        }

        function logoutUser(){
			$rta = "0x021";
			session_start();
			setcookie(session_name(), '', time() - 42000, '/'); 
			unset( $_SESSION );
			session_destroy();
			header("location:  " . FRONT_END_URL . "/login?rta=" . $rta);
		}

        function recoveryUser( $email ){
            try{ 
                $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
                $conect = $conect->conect();
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }
            $rta = "0x023";
            $user = $conect->prepare("SELECT * FROM users WHERE email = :email AND estado = 1");
            $user->bindParam(":email", $email, PDO::PARAM_STR);
    
            if ( $user->execute() ) {
    
                $string = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789ª!·$%&/()=?¿*^¨ç_:;\|@#~€¬][}{}]";
                $key = str_shuffle( $string );
                $key = md5( $key );
    
                $user = $conect->prepare("UPDATE users SET activation = :activation WHERE email = :email");
                $user->bindParam(":email", $email, PDO::PARAM_STR);
                $user->bindParam(":activation", $key, PDO::PARAM_STR);
    
                if ( $user->execute() ) {
                    $url_recovery = BACK_END_URL . "/";
                    $url_recovery.= "?page=recovery";
                    $url_recovery.= "&u=" . $email;
                    $url_recovery.= "&k=" . $key;
    
                    $body = "<h1>recovery password</h1>";
                    $body.= "<br>";
                    $body.= "user: " . $email;
                    $body.= "<br>";
                    $body.= "<p>Please click on the link below to reactivate your password.</p>";
                    $body.= "<a style='background-color:blue;color:white;display:block;padding:10px' href='".$url_recovery."'>RECUPERAR MI CUENTA</a>";
    
                    $header = "From: no-reply@" . $_SERVER["SERVER_NAME"] . "\r\n";
                    $header.= "MIME-Version: 1.0" . "\r\n";
                    $header.= "Content-Type: text/html; charset=utf-8" . "\r\n";

                    mail( $email, "Recovery password", $body, $header);
                    $rta = "0x022";
                }
                unset($conect);
                header("location:  " . FRONT_END_URL . "/login?rta=" . $rta);
                
            }
        }

        function activeUser($email, $key){
            try{ 
                $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
                $conect = $conect->conect();
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }
            
            $rta = "0x016";
            $user = $conect->prepare("SELECT * FROM users WHERE email = :email AND activation = :activation");
            $user->bindParam(":email", $email, PDO::PARAM_STR);
            $user->bindParam(":activation", $key, PDO::PARAM_STR);
    
            if ( $user->execute() ) {
                
                $user = $conect->prepare("UPDATE users SET state = 1 WHERE email = :email");
                $user->bindParam(":email", $email, PDO::PARAM_STR);
    
                if ( $user->execute() ) {
                    $rta = "0x018";
                } else {
                    $rta = "0x017";
                }
    
            }
            unset($conect);
            header("location: " . FRONT_END_URL . "/register?rta=" . $rta);
        }

        function addUser($firstname, $lastname, $email, $pass){
            try{ 
                $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
                $conect = $conect->conect();
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }
            $rta = "0x014";
            $user = $conect->prepare("SELECT * FROM users WHERE email = :email");
            $user->bindParam(":email", $email, PDO::PARAM_STR);
            $user->execute();
    
            if ( $user->rowCount() == 0 ) {
    
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                
                $string = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789ª!·$%&/()=?¿*^¨ç_:;\|@#~€¬][}{}]";
                $key = str_shuffle( $string );
                $key = md5( $key );
    
                $user = $conect->prepare("INSERT INTO users (firstname, lastname, email, pass, activation) VALUES (:firstname, :lastname, :email, :pass, :activation)");
    
                $user->bindParam(":firstname", $firstname, PDO::PARAM_STR);
                $user->bindParam(":lastname", $lastname, PDO::PARAM_STR);
                $user->bindParam(":email", $email, PDO::PARAM_STR);
                $user->bindParam(":pass", $hash, PDO::PARAM_STR);
                $user->bindParam(":activation", $key, PDO::PARAM_STR);
                    
                if ( $user->execute() ) {
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
                } else {
                    $rta = "0x015";
                }
            } else {
                $rta = "0x013";
            }
            header("location: " . FRONT_END_URL . "/register?rta=" . $rta);
        }

?>