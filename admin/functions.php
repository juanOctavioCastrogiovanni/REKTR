<?php
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
    
		function MostrarMensaje($cod){

            switch ($cod) {
                case '0x001':
                    $mensaje = "El nombre ingresado no es válido";
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
                    $mensaje = "Usuario ya registrado";
                break;
    
                case '0x014':
                    $mensaje = "Registro correcto! Revise su email para activar su cuenta.";
                break;
    
                case '0x015':
                    $mensaje = "Error en la registración, intente de nuevo";
                break;
    
                case '0x016':
                case '0x017':
                    $mensaje = "Error de activación, intente de nuevo";
                break;
    
                case '0x018':
                    $mensaje = "Su cuenta se ha activado correctamente!";
                break;
    
                case '0x019':
                    $mensaje = "your certificates are invalid, please check your email or password";
                break;
    
                case '0x020':
                    $mensaje = "Successful login";
                break;
    
                case '0x021':
                    $mensaje = "Sesión finalizada!";
                break;
    
                case '0x022':
                    $mensaje = "Revise su casilla de e-mail para recuperar su cuenta";
                break;
    
                case '0x023':
                    $mensaje = "Error, e-mail no valido o inexistente";
                break;
    
                case '0x024':
                    $mensaje = "Clave actualizada satisfactoriamente!";
                break;
    
                case '0x025':
                    $mensaje = "Error, contraseña invalida!";
                break;
    
                case '0x026':
                    $mensaje = "Error, no se pudo actualizar su contraseña";
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
            
            $user = $conect->prepare("SELECT * FROM users WHERE email = :email AND :parameter = 1");
            $user->bindParam(":email", $email, PDO::PARAM_STR);
            
            if ( $user->execute() && $user->rowCount() > 0 ) {
                    var_dump("correcto1");
                    die();
                    $user = $user->fetch();
                    
                    if (password_verify($pass, $user["Pass"])) {
                        session_start();
                        $_SESSION["user"] = array(
                            "firstname" => $user["firstname"],
                            "lastName" => $user["lastName"],
                            "email" => $user["email"]
                        );
                        $rta = "0x020";
                        
                    }
                }
                header("location: ../login.php?rta=" . $rta);
        }

?>