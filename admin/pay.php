<?php
    include "./admin/functions.php";
    include "../Class/Conect.class.php";

    if(isset($_GET['action'])&&isset($_GET['id'])){
        try{ 
            $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
            $conect = $conect->conect();

        switch($_GET['action']){
            // SI EL CLIENTE PAGA LA ORDEN, SE RESTAN DEL STOCK Y CAMBIA EL ESTADO "PAGADO" EN VERDADERO.
            // If the customer pays for the order, the quantities of each product in stock are deducted and the status changes to paid. 
            case 'paid':
                if(stock($_GET['id'],$conect,'-')){
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
            case 'cancel': 
            // SI EL CLIENTE CANCELA EL PEDIDO, SI EL CLIENTE LO PAGO, SE RESTABLECE EL STOCK ORIGINAL, SINO, NO PASA NADA
            // If the customer cancels the order paid, the original stock is restored.
                $stmt = $conect->prepare("SELECT pay FROM carts WHERE cartId=:id");
                $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
                if($stmt->execute()){
                    if($stmt->fetch(PDO::FETCH_ASSOC)['pay']==1){
                        stock($_GET['id'],$conect,'+');                    
                    }
                    $stmt1 = $conect->prepare("UPDATE carts SET cancel=1 WHERE cartId=:id");
                    $stmt1->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
                    $stmt1->execute();
                }
            break;
        }
            
        }catch(Exception $e){
            echo "<p>".$e->getMessage()."</p>";
        }

    }
    header('Location:./orderList');
?>