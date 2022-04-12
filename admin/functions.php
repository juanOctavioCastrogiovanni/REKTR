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
                return preQuery($page,"WHERE categories.idCategory=:category",$min,$max,$sort,"LIMIT 6 OFFSET ". 6*$page);
            } else {
                return preQuery($page," ",$min,$max,$sort, "LIMIT 6 OFFSET ". 6*$page);
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

?>