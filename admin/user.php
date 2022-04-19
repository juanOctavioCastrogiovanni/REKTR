<?php
    if( isset( $_GET["action"] ) ){
        include("functions.php");
        include("../Class/conect.class.php");

        $action = $_GET["action"];
    
        switch ($action) {
            case 'addUser':
                $firstname = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $email = $_POST["email"];
                $pass = $_POST["password"];
                if($pass==$_POST["rePassword"]){
                    addUser($firstname, $lastname, $email, $pass);
                } else {
                    header("location: ../register?rta=0x027");
                }
            break;
    
            case 'activeUser':
                $email = $_GET["u"];
                $clave = $_GET["k"];
                activeUser($email, $clave);
            break;
    
            case 'loginUser':
                $email = $_POST["email"];
                $pass = $_POST["password"];
                login($email, $pass);
            break;
    
            case 'logoutUser':
                logoutUser();
            break;
    
            case 'recoveryUser':
                $email = $_POST["email"];
                recoveryUser( $email );
            break;
    
            case 'savePass':
                $email = $_POST["email"];
                $pass = $_POST["pass"];
                $clave = $_POST["clave"];
                guardarClave( $email, $pass, $clave );
            break;
        }
    }
?>