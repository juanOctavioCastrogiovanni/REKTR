<?php
    if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['subject'])&&isset($_POST['body'])){
        try{
            $newUser = new User();
            $newUser->setName(RemoveSpecialChar($_POST['name']));
            $newUser->setEmail(RemoveSpecialChar($_POST['email']));
            $newUser->setSubject(RemoveSpecialChar($_POST['subject']));
            $newUser->setBody(RemoveSpecialChar($_POST['body']));
        }catch(Exception $e){
            echo "<p>".$e->getMessage()."</p>";
        }
    }


?>
