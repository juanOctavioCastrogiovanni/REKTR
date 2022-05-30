<?php
    include "./functions.php";
    include "../Class/Conect.class.php";

    if(isset($_GET['action'])&&isset($_GET['id'])){
        try{ 
            $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
            $conect = $conect->conect();

        switch($_GET['action']){
            case 'paid':
                if(stock($_GET['id'],$conect)){
                    $stmt = $conect->prepare("UPDATE carts SET pay=1 WHERE cartId=:id");
                    $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
                    $stmt->execute();
                }
            break;
            case 'pick':
                $stmt = $conect->prepare("UPDATE carts SET pickup=1 WHERE cartId=:id");
                $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
                $stmt->execute();
            break;
            // FALTA HACER EL CANCEL, TENER EN CUENTA QUE SI NO SE HA PAGADO NO DEBE HACER NADA REALMENTE, 
            // SOLO OCULTAR LOS BOTONES, SI YA SE PAGO DEBE VOLVER A SUMAR EL STOCK
            case 'cancel': 
            if(cancel($_GET['id'],$conect)){
                $stmt = $conect->prepare("UPDATE carts SET cancel=1 WHERE cartId=:id");
                $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
                $stmt->execute();
            }
            break;
        }
            
        }catch(Exception $e){
            echo "<p>".$e->getMessage()."</p>";
        }

    }
    header('Location:./orderList');
?>