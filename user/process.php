<?php
include "../Class/Conect.class.php";
include "../admin/functions.php";

    if(isset($_GET['action'])&&$_GET['action']=='cancel'&&isset($_GET['id'])){
        try{ 
            $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
            $conect = $conect->conect();
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
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }
    }

    header("location: ./panel?action=orderList");

?>