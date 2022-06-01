<?php
    include "./Class/User.class.php";
    include "./admin/functions.php";
    include $_SERVER["DOCUMENT_ROOT"] ."/php-ecommerce/init.php";

    if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['subject'])&&isset($_POST['body'])){
        $rta = "0x012";
        try{
            $newUser = new User();
            $newUser->setFirstName(RemoveSpecialChar($_POST['name']));
            $newUser->setEmail(RemoveSpecialChar($_POST['email']));
            $newUser->setSubject(RemoveSpecialChar($_POST['subject']));
            $newUser->setBody(RemoveSpecialChar($_POST['body']));
            if($newUser->contactForm()){
                $rta = "0x011";
            }
            header("location:  " . FRONT_END_URL . "/contact?rta=" . $rta);

        }catch(Exception $e){
            echo "<p>".$e->getMessage()."</p>";
        }
    }


?>
