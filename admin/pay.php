<?php
    include "./function.php";

    if(isset($_GET['action'])&&isset($_GET['id'])){
        switch($_GET['action']){
            case 'paid':
                stock($_GET['id']);
            break;
            case 'pick':
                pick($_GET['id']);
            break;
            case 'cancel': cancel($_GET['id']);
            break;
        }
    }
    header('Location:./orderList');
?>