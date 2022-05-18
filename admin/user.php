<?php
session_start();
if( isset( $_GET["action"] ) ){
        include "../Class/Cart.class.php";
        include("functions.php");
        include("../Class/Conect.class.php");
        include("../Class/User.class.php");

        $action = $_GET["action"];
    
        switch ($action) {
            case 'addUser':
                $firstname = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $email = $_POST["email"];
                $pass = $_POST["password"];
                if($pass==$_POST["rePassword"]&&strlen($pass)>8){
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
                logOutUser();
            break;
            
            case 'recoveryUser':
                $email = $_POST["email"];
                recoveryUser( $email );
            break;
           
            case 'deleteUser':
                $email = $_POST["email"];
                if($_SESSION['user']['email']==$email){
                    deleteUser( $_SESSION['ids']['userId'] );
                }
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