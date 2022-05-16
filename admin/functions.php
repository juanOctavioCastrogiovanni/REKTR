<?php
    include $_SERVER["DOCUMENT_ROOT"] ."/php-ecommerce/init.php";
    include "../Class/Product.class.php";

   

  

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
                    $mensaje = "The password must have at least 8 and must be the same";
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
            $user->bindParam(":email", $email, PDO::PARAM_STR);
            
            if ( $user->execute() && $user->rowCount() > 0 ) {
                $user = $user->fetch(PDO::FETCH_ASSOC);
                try{ 
                    $newUser = new User($user['email'],$user['pass']);
                    $newUser->setId($user['userId']);
                    $newUser->setFirstName($user['firstname']);
                    $newUser->setLastName($user['lastname']); 


                        if ($newUser->checkUser($pass)) {
                            //SI NO HAY NADA EN EL CARRITO DB NI TAMPOCO EN SESSION ENTONCES CREO UNO NUEVO Y GUARDO EN SESSION LOS IDS
                            if(!isset($_SESSION['Cart'])&&!existCart($conect,$user['userId'])){
                                $newCart = new Cart();
                                // $_SESSION['cartId'] = $newCart->createCartDB($conect,$newUser->getId());
                                $createCart = $newCart->createCartDB($conect,$user['userId']);
                                if($createCart->execute()){
                                    // $_SESSION['Cart']=$newCart;
                                    $newCart = $newCart->lastId($conect);
                                    if($newCart->execute()){
                                        $_SESSION['ids'] = $newCart->fetch(PDO::FETCH_ASSOC);
                                    }
                                    unset($newCart);
                                }
                                //SI NO HAY NADA EN EL CARRITO SESSION PERO TENGO CARRITO EN LA BASE DE DATOS, CREO UN NUEVO OBJETO CARRITO EN BASE A LA BASE DE DATOS
                            } else if(($cartId = existCart($conect,$user['userId']))!=0 && !isset($_SESSION['Cart'])){
                                
                                $existCart = new Cart();
                                $prepareSql = $existCart->getProductsDB($conect,$user['userId'],$cartId);
                                if($prepareSql->execute()){
                                    $cart = Array();
                                    foreach($prepareSql->fetchAll(PDO::FETCH_ASSOC) as $item){
                                        array_push($cart,$item);
                                    }
                                    
                                    $newCart = new Cart();
                                    foreach($cart as $productArray){
                                        $productArrays = array(
                                            "productId"=>$productArray['productId'],
                                            "name"=>$productArray['name'],
                                            "price"=>$productArray['price'],
                                            "image1"=>$productArray['image1'],
                                            "qty"=>0,
                                            "subTotal"=>0
                                        );
                                                try{ 
                                                    $product = new Product($productArray['productId'],$productArray['name'],$productArray['price']);
                                                    $product->setImage($productArray['image1']);
                                                }catch(Exception $e){
                                                    echo "<p>".$e->getMessage()."</p>";
                                                }
                                                $newCart->addItem($product, $productArray['qty'],$productArrays);
                                                $newCart->setTotal();
                                                $newCart->setProducts();
         
                                        }
                                                
                                    $_SESSION['Cart'] = $newCart;      
                                    $newCart = $newCart->lastId($conect);
                                    if($newCart->execute()){$_SESSION['ids'] = $newCart->fetch(PDO::FETCH_ASSOC);}                                    
                                    unset($newCart);
                                    // else if() AL LOGUEARME TENGO UN CARRITO EN SESSION Y NO TENGO UN CARRITO EN DB, DEBO CREAR UN CARRITO EN LA BASE
                                    //  DE DATOS GUARDAR LOS DATOS DEL CARRITO Y LUEGO CREAR TANTAS FILAS DE PRODUCTSCARTS POR TANTOS PRODUCTOS
                                    // TENGA. TODO DE UN SAQUE
                                    }   
                            } else {
                                $_SESSION['Cart']->saveCart($user['userId']);
                                $newCart = $_SESSION['Cart']->lastId($conect);
                                if($newCart->execute()){$_SESSION['ids'] = $newCart->fetch(PDO::FETCH_ASSOC);}
                            }
                      

                            $rta = "0x020";
                            header("location:". FRONT_END_URL."/");
                            // header("location:". BACK_END_URL."/profile?rta=" . $rta);
                        } else {
                            $rta = "0x019";
                            header("location:  " . FRONT_END_URL . "/login?rta=" . $rta);
                        }

                }catch(Exception $e){
                    echo "<p>".$e->getMessage()."</p>";
                }
                unset($conect);
            } else {
            header("location:  " . FRONT_END_URL . "/login?rta=" . $rta);
            }
            
        }

        function existCart($conect,$userId){
            $existCart = $conect->prepare("SELECT cartId, sale FROM carts WHERE userId = :user ORDER BY cartId DESC LIMIT 1;");
            $existCart->bindParam(":user", $userId, PDO::PARAM_INT);
            if($existCart->execute()){
                $array = Array();
                foreach($existCart->fetch(PDO::FETCH_ASSOC) as $item){
                    array_push($array,$item);
                }
                if ($array[1]==0){
                        return $array[0];
                    }
                return 0;

            }
        }
        

        function logOutUser(){
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
            try{ 
                $recoveryUser = new User();
                $recoveryUser->setEmail($email);
                $sql = $recoveryUser->selectUser();
                $user = $conect->prepare($sql);
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }
    
                if ($user->execute()) {              
                    $recoveryUser->configActivationCode();
                    $sql = $recoveryUser->recoveryUser();
                    $user = $conect->prepare($sql);
                    // $user = $conect->prepare("UPDATE users SET activation = :activation WHERE email = :email");
                    // $user->bindParam(":email", $email, PDO::PARAM_STR);
                    // $user->bindParam(":activation", $key, PDO::PARAM_STR);
        
                    if ( $user->execute() ) {
                        $recoveryUser->recoveryEmail();
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
            try{ 
                $activeUser = new User();
                $activeUser->setEmail($email);
                $activeUser->setActivation($key);                
                $user = $activeUser->activeUser($conect);
                if ( $user->execute() ) {
                        $rta = "0x018";
                }
             }catch(Exception $e){
                 echo "<p>".$e->getMessage()."</p>";
             }
        
    
            unset($conect);
            // die();
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
            try{ 
                $newUser = new User();
                $newUser->setEmail($email);
                $sql = $newUser->selectUser();
                $user = $conect->prepare($sql);
             }catch(Exception $e){
                 echo "<p>".$e->getMessage()."</p>";
             }
           
            $user->execute();
    
            if ($user->rowCount()==0) {
              $newUser->setFirstName($firstname);
              $newUser->setLastName($lastname);
              $newUser->setPass($pass);
              $newUser->configActivationCode();
              $newUser->setState(0);
              $newUser->setAdmin(0);
              $user = $newUser->createUser($conect);
              if ($user->execute()){
                   $newUser->activationMail();
                 } else {
                    $rta = "0x015";
                 }
            } else {
                $rta = "0x013";
            }
            header("location: " . FRONT_END_URL . "/register?rta=" . $rta);
        }

?>