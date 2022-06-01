<?php
    include $_SERVER["DOCUMENT_ROOT"] ."/php-ecommerce/init.php";


    // SE MOSTRARAN DISTINTOS MENSAJES DEPENDIENDO DEL CODIGO DE RESPUESTA DE LA URL
    // different messages will be displayed depending on the response code of the url
		function showMenssage($cod){

            switch ($cod) {
                case '0x013':
                    $message = "User already exists";
                break;
    
                case '0x014':
                    $message = "Correct registration! Check your email to activate your account.";
                break;
    
                case '0x015':
                    $message = "Registration failed, please try again";
                break;
    
                case '0x016':
                case '0x017':
                    $message = "Activation invalid";
                break;
    
                case '0x018':
                    $message = "sussessful acount!";
                break;
    
                case '0x019':
                    $message = "your certificates are invalid, please check your email or password";
                break;
    
                case '0x020':
                    $message = "Successful login";
                break;
    
                case '0x021':
                    $message = "Thanks for comming";
                break;
    
                case '0x022':
                    $message = "An email has been sent to your email address to recover your password. ";
                break;
    
                case '0x023':
                    $message = "Email invalid";
                break;
    
                case '0x024':
                    $message = "successful key update!";
                break;
    
                case '0x025':
                    $message = "Password invalid!";
                break;
    
                case '0x026':
                    $message = "Error, password is not update";
                break;
                case '0x027':
                    $message = "The password must have at least 8 and must be the same";
                break;
                case '0x028':
                    $message = "account deleted";
                break;
                case '0x029':
                    $message = "Error: the account is not deleted";
                break;
            }
            return "<p class='rta rta-".$cod."'>".$message."</p>";
        }


        function login($email, $pass){
            $rta = "0x019";         
            // INSTANCIO UN NUEVO OBJETO CONEXION
            // new instance for connection object
            try{ 
                $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
                $conect = $conect->conect();
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }
            
            // EXTRAIGO SOLO DE LA BASE DE DATOS EL USUARIO CON EL MAIL QUE VIENE DEL PARAMETRO Y SU ESTADO DE ACTIVACION DE CUENTA SEA VERDADERO
            // i extract only from the database the user with the mail that comes from the parameter and his account activation status is true
            $user = $conect->prepare("SELECT * FROM users WHERE email = :email AND state = 1");
            $user->bindParam(":email", $email, PDO::PARAM_STR);
            
            if ( $user->execute() && $user->rowCount() > 0 ) {
                // SI ESE USUARIO EXISTE, CON FETCH CONVIERTO SUS DATOS EN UN ARRAY ASOCIATIVO
                // If that user exists, with fetch i convert its data into an associative array
                $user = $user->fetch(PDO::FETCH_ASSOC);
                try{ 
                    $newUser = new User($user['email'],$user['pass']);
                    $newUser->setId($user['userId']);
                    $newUser->setFirstName($user['firstname']);
                    $newUser->setLastName($user['lastname']); 

                        if ($newUser->checkUser($pass)&&$user['admin']){
                            $_SESSION['admin'] = TRUE;
                            $_SESSION['id'] = $user['admin'];
                            header("location:". BACK_END_URL."/orderList");
                        } else if ($newUser->checkUser($pass)) {
                            //SI NO HAY NADA EN EL CARRITO DB NI TAMPOCO EN SESSION ENTONCES CREO UNO NUEVO Y GUARDO EN SESSION LOS IDS
                            //If there is nothing in the db cart or in the session i create a new one and save the ids in the session
                            if(!isset($_SESSION['cartArray'])&&!existCart($conect,$user['userId'])){
                                $newCart = new Cart();
                                $createCart = $newCart->createCartDB($conect,$user['userId']);
                                if($createCart->execute()){
                                    $newCart = $newCart->lastId($conect);
                                    if($newCart->execute()){
                                        $_SESSION['ids'] = $newCart->fetch(PDO::FETCH_ASSOC);
                                    }
                                    unset($newCart);
                                }
                                //SI NO HAY NADA EN EL CARRITO SESSION PERO TENGO CARRITO EN LA BASE DE DATOS, CREO UN NUEVO OBJETO CARRITO EN BASE A LA BASE DE DATOS
                                // If there is nothing in the session cart but i have a cart in the database, i create a new cart object based on the database
                            } else if(($cartId = existCart($conect,$user['userId']))!=0 && !isset($_SESSION['cartArray'])){
                                
                                $existCart = new Cart();
                                $prepareSql = $existCart->getProductsDB($conect,$user['userId'],$cartId);
                                if($prepareSql->execute()){
                                    $cart = Array();
                                    foreach($prepareSql->fetchAll(PDO::FETCH_ASSOC) as $item){
                                        array_push($cart,$item);
                                    }
                                    $newCart = array_to_cart($cart,TRUE);                                                 
                                    $_SESSION['cartArray'] = cart_to_array($newCart);      
                                    $newCart = $newCart->lastId($conect);
                                    if($newCart->execute()){$_SESSION['ids'] = $newCart->fetch(PDO::FETCH_ASSOC);}                                    
                                    unset($newCart);
                                    // else if() AL LOGUEARME TENGO UN CARRITO EN SESSION Y NO TENGO UN CARRITO EN DB, DEBO CREAR UN CARRITO EN LA BASE
                                    //  DE DATOS GUARDAR LOS DATOS DEL CARRITO Y LUEGO CREAR TANTAS FILAS DE PRODUCTSCARTS POR TANTOS PRODUCTOS
                                    // TENGA. TODO DE UN SAQUE

                                    // When i log in. I have a cart in session and i don't have a cart in db, i have to create a cart in the base
                                    // from data save the cart data and then create as many rows of productscarts for as many products
                                    // have. everything in one piece
                                    }   
                            } else {

                                $newObject = array_to_cart($_SESSION['cartArray']['productsArray'],FALSE);
                                $newObject->saveCart($user['userId']);
                                $newCart = $newObject->lastId($conect);
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

        // SI EXISTE UN EXISTE UN CARRITO DEVUELVE SU ID SINO 0
        // if existCart return 0 else return cartId
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
                    $user = $recoveryUser->recoveryUser($conect);
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
       
        function deleteUser($id){
            try{ 
                $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
                $conect = $conect->conect();
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }
            
            $rta = "0x029";
            $sql = sprintf("DELETE FROM users WHERE userId = %d", $id);
            $stmt = $conect->prepare($sql);
            if($stmt->execute()){
                $rta = "0x028";
                session_destroy();
            }
    
            unset($conect);
            // die();
            header("location: " . FRONT_END_URL . "/login.php?rta=" .$rta);
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

        function filterQuery($page,$category,$min,$max,$sort,$limit){
            if($limit){
                if($category){    
                    return preQuery($page,"WHERE categories.categoryId=:category",$min,$max,$sort,"LIMIT 8 OFFSET ". 8*$page);
                } else {
                    return preQuery($page," ",$min,$max,$sort, "LIMIT 8 OFFSET ". 8*$page);
                }
            } else {
                if($category){    
                    return preQuery($page,"WHERE categories.categoryId=:category",$min,$max,$sort," ");
                    } else {
                    return preQuery($page," ",$min,$max,$sort," ");
                }
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
        
        function roundDown($a,$b){
            if($a%$b!=0){
                return ($a/$b)-1;
            }
            return ($a/$b);
        }
        
        
          //this functions prepare all querys for filter. 
          function preQuery($page,$category,$min,$max,$sort,$limit){
            //if nobody query url exist. 
            if($min==NULL&&$max==NULL&&$sort==NULL){
                return "SELECT productId,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.brandId INNER JOIN categories ON products.category=categories.categoryId $category $limit";
            }
            //if just exist sort param. 
            if($min==NULL&&$max==NULL){
                //is sort asc?. 
                if($sort=="asc"){
                    return "SELECT productId,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.brandId INNER JOIN categories ON products.category=categories.categoryId $category ORDER BY price ASC $limit";
                } else if($sort=="desc"){
                    return "SELECT productId,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.brandId INNER JOIN categories ON products.category=categories.categoryId $category ORDER BY price DESC $limit";
                }
            }
            //if just exist min param. 
            if($max==NULL&&$sort==NULL){
                return "SELECT productId,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.brandId INNER JOIN categories ON products.category=categories.categoryId $category AND products.price > $min $limit";
            }
            //if just exist max param. 
            if($min==NULL&&$sort==NULL){
                return "SELECT productId,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.brandId INNER JOIN categories ON products.category=categories.categoryId $category AND products.price < $max $limit";
            }
            //if exist min and max params. 
            if($sort==NULL){
                return "SELECT productId,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.brandId INNER JOIN categories ON products.category=categories.categoryId $category AND products.price BETWEEN $min AND $max $limit";
            }
            //if exist min and sort params. 
            if($min==NULL){
                //is sort asc?. 
                if($sort=="asc"){
                    return "SELECT productId,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.brandId INNER JOIN categories ON products.category=categories.categoryId $category AND products.price < $max ORDER BY price ASC $limit";
                } else if($sort=="desc"){
                    return "SELECT productId,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.brandId INNER JOIN categories ON products.category=categories.categoryId $category AND products.price < $max ORDER BY price DESC $limit";
                }
            }
            
            //if exist min and sort params. 
            if($max==NULL){
                if($sort=="asc"){
                    return "SELECT productId,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.brandId INNER JOIN categories ON products.category=categories.categoryId $category AND products.price > $min ORDER BY price ASC $limit";
                } else if($sort=="desc"){
                    return "SELECT productId,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.brandId INNER JOIN categories ON products.category=categories.categoryId $category AND products.price > $min ORDER BY price DESC $limit";
                }
            }
        
            // this is the last way, exist params all
            if($sort=="asc"){
                    return "SELECT productId,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.brandId INNER JOIN categories ON products.category=categories.categoryId $category AND products.price BETWEEN $min AND $max  ORDER BY price ASC $limit";
                }else if($sort=="desc"){
                    return "SELECT productId,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.brandId INNER JOIN categories ON products.category=categories.categoryId $category AND products.price BETWEEN $min AND $max  ORDER BY price DESC $limit";
                }
        }

        // ESTA FUNCION ES PARA CONVERTIR UN OBJETO EN ARRAY PARA POSTERIORMENTE ALMACENARLO EN UN SESSION
        // This function is to convert an object into array to later store it in a session
        
        
        function cart_to_array($object){
            $array = Array();
            $array['total'] = $object->getTotal();
            $array['products'] = $object->getProducts();
            $array['listId'] = $object->getListId(); 
            // $array['productsArray'] = $object->getProductListArray();
            $array['productsArray'] = $object->getProductListArray();
            return $array;             
        }

        // ESTA FUNCION ES PARA CONVERTIR ARRAY A OBJETO, SIEMPRE DEBE PASARSE EL ARRAY DE PRODUCTOS Y LUEGO UN BOOLEANO PARA SABER SI GUARDAR LOS ITEMS EN LA BASE DE DATOS.
        // This function is to convert array to object, you must always pass the array of products and then a boolean to know whether to save the items in the database.
        function array_to_cart($productListArray,$write){
            try{
            $newCart = new Cart();
                foreach($productListArray as $productArray){
                    try{ 
                        $product = new Product($productArray['productId'],$productArray['name'],$productArray['price']);
                        $product->setImage($productArray['image1']);
                    }catch(Exception $e){
                        echo "<p>".$e->getMessage()."</p>";
                    }
                    $newCart->addItem($product,$productArray['qty'],$write);
                    $newCart->setTotal();
                    $newCart->setProducts();
                }
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }
                        
            return $newCart;      
        }

        // FUNCION QUE FILTRA CARACTERES ESPECIALES PARA EVITAR FUTURAS INYECCIONES EN EL SQL
        
        function RemoveSpecialChar($str){
            $res = preg_replace('/[\;\=\<\>\" "]+/', '', $str);
            return $res;
        }



        // ESTA FUNCION TRAE TODOS LOS PRODUCTOS RELACIONADOS CON UN CARRITO, Y AL RECORRERLO EJECUTA LA FUNCION UPDATESTOCK. 
        // DEPENDIENDO SI SE PAGO LA ORDEN O SE CANCELO VA A RESTAR O SUMAR EL STOCK  
        // I get all products related to the cart that comes by id. For each product use updateStock.

        function stock($id,$conect,$symbol){
                $stmt = $conect->prepare("SELECT products.productId, productscarts.qty, products.stock 
                FROM productsCarts 
                INNER JOIN carts 
                INNER JOIN products ON 
                productscarts.cartId=carts.cartId AND 
                products.productId=productscarts.productId AND 
                carts.cartId = :id");
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                if($stmt->execute()){
                    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $product){
                        if(!updateStock($product['productId'],$product['qty'],$product['stock'],$conect,$symbol)){
                            return FALSE;
                        }   
                    }
                    return TRUE;
                } 
                return FALSE;
        }

          // ACTUALIZA EL STOCK DE CADA PRODUCTO HACIENDO UNA SIMPLE SUMA O RESTA.
        // Updates the stock of each product.

        function updateStock($id,$qty,$stock,$conect,$symbol){
            $totalStock = 0;
                if($symbol=='-'){
                    $totalStock = $stock - $qty;
                } else if($symbol=='+'){
                    $totalStock = $stock + $qty;                    
                }
                $stmt = $conect->prepare("UPDATE products SET stock=:stock WHERE productId=:id");
                $stmt->bindValue(':stock', $totalStock, PDO::PARAM_INT);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                if($stmt->execute()){
                    return TRUE;
                }
                return FALSE;
        }

        function cancel($id,$conect){
           
        }

   
        
        

?>