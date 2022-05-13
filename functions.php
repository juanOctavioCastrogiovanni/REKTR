<?php  
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


?>