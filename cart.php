<?php 
    include "./Class/Cart.class.php";
    include "./Class/Product.class.php";
    include "./Class/Conect.class.php";
    include "./admin/functions.php";
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
        if(!isset($_SESSION['cartArray'])){
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
                // $_SESSION['Cart'] = $newCart;     
                $_SESSION['cartArray'] = cart_to_array($newCart);     
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }           
            
            
        } else if(isset($_SESSION['cartArray'])){
            try{
                $product = new Product($_POST['productId'],$_POST['name'],$_POST['price']);
                $product->setImage($_POST['image1']);
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }    

            $newObject = array_to_cart($_SESSION['cartArray']['productsArray']);
            $newObject->addItem($product, $_POST['qty'],$productArray);
            $newObject->setTotal();
            $newObject->setProducts();
            $_SESSION['cartArray'] = cart_to_array($newObject);


            // $_SESSION['Cart']->addItem($product, $_POST['qty'],$productArray);
            // $_SESSION['Cart']->setTotal();
            // $_SESSION['Cart']->setProducts();
        }

        if(isset($_SESSION['user'])&&isset($_SESSION['ids'])){
            $newObject = array_to_cart($_SESSION['cartArray']['productsArray']);
            $newObject->updateCart($_SESSION['ids']['cartId']);
        }
        header("location:./products");
    }


    if(isset($_GET['option'])&&isset($_GET['id'])){
        if($_GET['option']=='remove'){
            $newObject = array_to_cart($_SESSION['cartArray']['productsArray']);
            $newObject->removeItem($_GET['id']);
            $newObject->setTotal();
            $newObject->setProducts();
            $_SESSION['cartArray'] = cart_to_array($newObject);
            header("location:./product_summary");
        }
        if($_GET['option']=='qtymodify'){
            $newObject = array_to_cart($_SESSION['cartArray']['productsArray']);
            $newObject->updateItem($_GET['id'],$_POST['qty']);
            $_SESSION['cartArray'] = cart_to_array($newObject);
        }

        if(isset($_SESSION['user'])&&isset($_SESSION['ids'])){
            $newObject = array_to_cart($_SESSION['cartArray']['productsArray']);
            $newObject->updateCart($_SESSION['ids']['cartId']);
            $_SESSION['cartArray'] = cart_to_array($newObject);
        }
        header("location:./product_summary");
    } else if(isset($_GET['option'])&&$_GET['option']=="cartDelete"){
        $newObject = array_to_cart($_SESSION['cartArray']['productsArray']);
        $newObject->cartDelete();
        $newObject->setTotal();
        $newObject->setProducts();
        $_SESSION['cartArray'] = cart_to_array($newObject);
        header("location:./product_summary");
    }

    

?>