<?php 
    include "./Class/Cart.class.php";
    include "./Class/Product.class.php";
    include "./Class/Conect.class.php";
    include "./admin/functions.php";
    session_start();

    // SI EL AGREGO UN PRODUCTO POR EL FORMULARIO
    // IF I ADD A PRODUCT THROUGH THE FORM
    if(isset($_POST['productId'])&&isset($_POST['qty'])){
        $productArray = array(
            "productId"=>$_POST['productId'],
            "name"=>$_POST['name'],
            "price"=>$_POST['price'],
            "image1"=>$_POST['image1'],
            "qty"=>0,
            "subTotal"=>0
        );
        // EN EL CASO DE QUE NO HAYA UNA SESSION DE CARRITO ACTIVA EN ESE MOMENTO
        //if dont exist cart create in this moment
        if(!isset($_SESSION['cartArray'])){
            try{ 
                $product = new Product($_POST['productId'],$_POST['name'],$_POST['price']);
                $product->setImage($_POST['image1']);
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }
            try{
                $newCart = new Cart();
                $newCart->addItem($product, $_POST['qty'],$productArray,TRUE);
                $newCart->setTotal();
                $newCart->setProducts();
                if(isset($_SESSION['user'])&&isset($_SESSION['ids'])){
                    $newObject->updateCart($_SESSION['ids']['cartId']);
                } 
                $_SESSION['cartArray'] = cart_to_array($newCart);     
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }           
            
            // CASO CONTRARIO
            // opposite case
        } else if(isset($_SESSION['cartArray'])){
            try{
                $product = new Product($_POST['productId'],$_POST['name'],$_POST['price']);
                $product->setImage($_POST['image1']);
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }    
            // EN TODOS LOS CASOS SE RESUELVE IGUAL, SE CONVIERTE EL ARRAY DE SESSION EN OBJETO Y SE TRABAJA CON LOS METODOS YA ESTABLECIDOS EN CADA OBJETO INSTACIADO
            // In all cases it is solved the same, the session array is converted into an object and works with the methods already established in each instituted object

            $newObject = array_to_cart($_SESSION['cartArray']['productsArray'],FALSE);          
            $newObject->addItem($product, $_POST['qty'],$productArray,TRUE);
            $newObject->setTotal();
            $newObject->setProducts();
            if(isset($_SESSION['user'])&&isset($_SESSION['ids'])){
                $newObject->updateCart($_SESSION['ids']['cartId']);
            }
            // LUEGO CON LA FUNCION cart_to_array VUELVO A CONVERTIR ESE OBJETO EN UN ARRAY PARA PODER GUARDARLO EN SESSION.
            // then with the cart_to_array function I convert that object back into an array to be able to save it in session.
            $_SESSION['cartArray'] = cart_to_array($newObject);
            
        }

        header("location:./products");
    }


    // SI EXISTE UNA QUERY OPCIONES Y ID
    // if exist option and id querys
    if(isset($_GET['option'])&&isset($_GET['id'])){
        if($_GET['option']=='remove'){
            // COMO VEREMOS AQUI Y A LO LARGO DE TODOS LOS ARCHIVOS PHP EN SESSION SE CONVIERTE EL ARRAY DEL CARRITO A OBJETO Y VICEVERSA. 
            // As we will see here and in all the php files of the session, the cart array is converted to an object and vice versa.
            $newObject = array_to_cart($_SESSION['cartArray']['productsArray'],FALSE);
            $newObject->removeItem($_GET['id']);
            $newObject->setTotal();
            $newObject->setProducts();
            $_SESSION['cartArray'] = cart_to_array($newObject);
            header("location:./product_summary");
        }
        if($_GET['option']=='qtymodify'){
            $newObject = array_to_cart($_SESSION['cartArray']['productsArray'],FALSE);
            $newObject->updateItem($_GET['id'],$_POST['qty']);
            $_SESSION['cartArray'] = cart_to_array($newObject);
        }

        if(isset($_SESSION['user'])&&isset($_SESSION['ids'])){
            $newObject = array_to_cart($_SESSION['cartArray']['productsArray'],FALSE);
            $newObject->updateCart($_SESSION['ids']['cartId']);
            $_SESSION['cartArray'] = cart_to_array($newObject);
        }
        header("location:./product_summary");
        // EN EL CASO QUE EL USUARIO DESEE VACIAR EL CARRITO, PUEDO CREAR UNO NUEVO ASI LOS ANTERIORES QUEDAN ALMACENADOS EN LA BASE DE DATOS PARA ESTADISTICAS O ESTUDIOS.
        // if you click "cartDelete", another cart will be created. The returned cart is saved in the database for statistics.
        } else if(isset($_GET['option'])&&$_GET['option']=="cartDelete"){
        $newObject = array_to_cart($_SESSION['cartArray']['productsArray'],FALSE);
        $newObject->cartDelete();
        $newObject->setTotal();
        $newObject->setProducts();
        $_SESSION['cartArray'] = cart_to_array($newObject);
        header("location:./product_summary");
    }

    

?>