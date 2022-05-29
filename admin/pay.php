<?php
    include "./functions.php";
    include "../Class/Conect.class.php";

    if(isset($_GET['action'])&&isset($_GET['id'])){
        try{ 
            $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
            $conect = $conect->conect();

        switch($_GET['action']){
            case 'paid':
                
                stock($_GET['id'],$conect);
            break;
            case 'pick':
                pick($_GET['id'],$conect);
            break;
            case 'cancel': cancel($_GET['id'],$conect);
            break;
        }
            
        }catch(Exception $e){
            echo "<p>".$e->getMessage()."</p>";
        }

    }
    // header('Location:./orderList');
?>