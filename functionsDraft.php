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

 // SE MOSTRARAN DISTINTOS MENSAJES DEPENDIENDO DEL CODIGO DE RESPUESTA DE LA URL
    // different messages will be displayed depending on the response code of the url
function showMenssage($cod){

    switch ($cod) {
        case '0x011':
            $message = "Send email";
        break; 
        case '0x012':
            $message = "Error, please try again";
        break; 
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

function cart_to_array($object){
    $array = Array();
    $array['total'] = $object->getTotal();
    $array['products'] = $object->getProducts();
    $array['listId'] = $object->getListId(); // $array['sale'] = $object->getSale();
    $array['productsArray'] = $object->getProductListArray();
    return $array;             
}

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

function RemoveSpecialChar($str){
    $res = preg_replace('/[\;\=\<\>\" "]+/', '', $str);
    return $res;
}


?>