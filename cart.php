<?php 
    include "./Class/Cart.class.php";
    include "./Class/Product.class.php";
    session_start();
    if(isset($_GET['b'])){
        session_destroy();
        echo "<p>borrado</p><a href='product_details?id=4'>home</a>";
    }
    if(isset($_POST['idProduct'])&&isset($_POST['qty'])){
        //if dont exist cart create in this moment
        if(!isset($_SESSION['Cart'])){
            try{ 
                $product = new Product($_POST['idProduct'],$_POST['name'],$_POST['price']);
                $product->setImage($_POST['image1']);
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }
            try{
                $newCart = new Cart();
                $newCart->addItem($product, $_POST['qty']);
                $newCart->setTotal();
                $newCart->setProducts();
                $_SESSION['Cart'] = $newCart;     
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }           
            //if exist 
            var_dump($_SESSION['Cart']);
            die();
        } else if(isset($_SESSION['Cart'])){
            try{
                $product = new Product($_POST['idProduct'],$_POST['name'],$_POST['price']);
                $product->setImage($_POST['image1']);
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }    
            $_SESSION['Cart']->addItem($product, $_POST['qty']);
            $_SESSION['Cart']->setTotal();
            $_SESSION['Cart']->setProducts();
            var_dump($_SESSION['Cart']);
            die();
        }
    }

?>