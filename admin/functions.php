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

    function preQuery($page,$category,$min,$max,$sort,$limit){
        if($min==NULL&&$max==NULL&&$sort==NULL){
            return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category $limit";
        }
        
        if($min==NULL&&$max==NULL){
            if($sort=="asc"){
                return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category ORDER BY price ASC $limit";
            }
            return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category ORDER BY price DESC $limit";
        }
        if($max==NULL&&$sort==NULL){
            return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category AND products.price > $min $limit";
        }
        if($min==NULL&&$sort==NULL){
            return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category AND products.price < $max $limit";
        }
        if($sort==NULL){
            return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category AND products.price BETWEEN $min AND $max $limit";
        }
        if($min==NULL){
            if($sort=="asc"){
                return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category AND products.price < $max ORDER BY price ASC $limit";
            }
            return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category AND products.price < $max ORDER BY price DESC $limit";
        }

        if($max==NULL){
            if($sort=="asc"){
                return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category AND products.price > $min ORDER BY price ASC $limit";
            }
            return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category AND products.price > $min ORDER BY price DESC $limit";
        }

        if($sort=="asc"){
                return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category AND products.price BETWEEN $min AND $max  ORDER BY price ASC $limit";
            }
            return "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory $category AND products.price BETWEEN $min AND $max  ORDER BY price DESC $limit";
    }

?>