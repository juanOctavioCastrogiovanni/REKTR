<?php
    include "./functions.php";
    include "../Class/Conect.class.php";

    if(isset($_GET['action'])&&isset($_GET['id'])){
        try{ 
            $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
            $conect = $conect->conect();

        switch($_GET['action']){
            // Si el cliente paga la orden, se restan del stock y cambia el estado "pagado" en verdadero
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
            // Si el cliente cancela el pedido, si el cliente lo pago, se restablece el stock original, sino, no pasa nada
            // If the customer cancels the order, if the customer pays for it, the original stock is restored, otherwise nothing happens.
                $stmt = $conect->prepare("SELECT pay FROM carts WHERE cartId=:id");
                $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
                if($stmt->execute()){
                    if($stmt->fetch(PDO::FETCH_ASSOC)['pay']==1){
                        stock($id,$conect,'+');                    
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