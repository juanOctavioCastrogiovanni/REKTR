<?php
session_start();
if( isset( $_GET["action"] ) ){
        include "../Class/Cart.class.php";
        include("./functions.php");
        include("../Class/Conect.class.php");
        include("../Class/User.class.php");
        include("../Class/Product.class.php");

        $action = $_GET["action"];
    
        switch ($action) {
            case 'addUser':
                
                $firstname = RemoveSpecialChar($_POST["firstname"]);
                $lastname = RemoveSpecialChar($_POST["lastname"]);
                $email = RemoveSpecialChar($_POST["email"]);
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
                $email = RemoveSpecialChar($_POST["email"]);
                $pass = RemoveSpecialChar($_POST["password"]);
                login($email, $pass);
            break;
    
            case 'logoutUser':
                logOutUser();
            break;
            
            case 'recoveryUser':
                $email = RemoveSpecialChar($_POST["email"]);
                recoveryUser( $email );
            break;
           
            case 'deleteUser':
                $email = RemoveSpecialChar($_POST["email"]);
                if($_SESSION['user']['email']==$email){
                    deleteUser( $_SESSION['ids']['userId'] );
                }
            break;
    
            case 'recoveryPass':
            	$key = $_POST['k'];
            	$pass = $_POST['pass'];
            	$rePass = $_POST['rePass'];
            	if($pass!=$rePass||strlen($pass)<=8){
            	    header("location: ../recoveryPass?u=$email&k=$key&rta=0x027");
            	} 
            	header(savePass($key,$pass)?"location: ../recoveryPass?rta=0x011":"location: ../recoveryPass?rta=0x012");
                
            break;
        }
    }
?>