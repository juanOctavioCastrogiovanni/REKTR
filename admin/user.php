<?php
    if( isset( $_GET["action"] ) ){
        include("functions.php");
        include("../Class/conect.class.php");

        $action = $_GET["action"];
    
        switch ($action) {
            case 'addUser':
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $email = $_POST["email"];
                $pass = $_POST["pass"];
    
                registrarUsuario($nombre, $apellido, $email, $pass);
            break;
    
            case 'activeUser':
                $email = $_GET["u"];
                $clave = $_GET["k"];
                activarUsuario($email, $clave);
            break;
    
            case 'loginUser':
                $email = $_POST["email"];
                $pass = $_POST["password"];
                login($email, $pass);
            break;
    
            case 'logoutUser':
                cerrarSesion();
            break;
    
            case 'recoveryUser':
                $email = $_POST["email"];
                recuperarClave( $email );
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