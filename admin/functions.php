<?php
    function pagination(){
        if(isset($_GET['category'])){
            $query = "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory WHERE categories.idCategory=:category";
            $q="products?category=$categ";
        } else {
            $query = "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory";
            $q="products?";
        }
    
        try{
            $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
            $conect = $conect->conect();
        }catch(Exception $e){
            echo "<p>".$e->getMessage()."</p>";
        }
        
        try{
            $products = $conect->prepare($query);
            $products->bindValue(':category',$categ);
            $products->execute();
            $count = $products->rowcount();
            $array = array();
            foreach($products->fetchAll(PDO::FETCH_ASSOC) as $product){
                array_push($array,new Product($product['idProduct'],$product['name'],$product['price'],$product['brand'],$product['category'],$product['stock'],$product['short_description'],$product['description'],$product['image1'],$product['image2'],$product['image3'],$product['new']));
            }
        }catch(Exception $e){
            echo "<p>".$e->getMessage()."</p>";
        }
    }

    function roundDown($a,$b){
        if($a%$b!=0){
            return ($a/$b)-1;
        }
        return ($a/$b);
    }

?>