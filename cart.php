<?php 
    include "./Class/Cart.class.php";
    include "./Class/Product.class.php";
    include "./Class/Conect.class.php";
    session_start();
    
    // CUANDO YA ESTOY LOGUEADO, APARTE DE HACER TODO EL MANEJO DE LOS OBJETOS QUE 
    // YA ESTA HECHO EXCEPTO EL BORRAR TODO EL CARRITO, DEBO GUARDAR CADA COSA EN LAS REPECTIVAS TABLAS DEL USUARIO.

    if(isset($_POST['productId'])&&isset($_POST['qty'])){
        //if dont exist cart create in this moment
        $productArray = array(
            "productId"=>$_POST['productId'],
            "name"=>$_POST['name'],
            "price"=>$_POST['price'],
            "image1"=>$_POST['image1'],
            "qty"=>0,
            "subTotal"=>0
        );
        if(!isset($_SESSION['Cart'])){
            try{ 
                $product = new Product($_POST['productId'],$_POST['name'],$_POST['price']);
                $product->setImage($_POST['image1']);
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }
            try{
                $newCart = new Cart();
                $newCart->addItem($product, $_POST['qty'],$productArray);
                $newCart->setTotal();
                $newCart->setProducts();
                $_SESSION['Cart'] = $newCart;     
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }           
            
            
        } else if(isset($_SESSION['Cart'])){
            try{
                $product = new Product($_POST['productId'],$_POST['name'],$_POST['price']);
                $product->setImage($_POST['image1']);
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }    
            $_SESSION['Cart']->addItem($product, $_POST['qty'],$productArray);
            $_SESSION['Cart']->setTotal();
            $_SESSION['Cart']->setProducts();
        }

        if(isset($_SESSION['user'])&&isset($_SESSION['ids'])){
            $_SESSION['Cart']->updateCart($_SESSION['ids']['cartId']);
        }
        header("location:./product_summary");
    }


    if(isset($_GET['option'])&&isset($_GET['id'])){
        if($_GET['option']=='remove'){
            $_SESSION['Cart']->removeItem($_GET['id']);
            $_SESSION['Cart']->setTotal();
            $_SESSION['Cart']->setProducts();
            header("location:./product_summary");
        }
        if($_GET['option']=='qtymodify'){
            $_SESSION['Cart']->updateItem($_GET['id'],$_POST['qty']);
        }

        if(isset($_SESSION['user'])&&isset($_SESSION['ids'])){
            $_SESSION['Cart']->updateCart($_SESSION['ids']['cartId']);
        }
        header("location:./product_summary");
    } else if(isset($_GET['option'])&&$_GET['option']=="cartDelete"){
        $_SESSION['Cart']->cartDelete();
        $_SESSION['Cart']->setTotal();
        $_SESSION['Cart']->setProducts();
        header("location:./product_summary");
    }

    

?>