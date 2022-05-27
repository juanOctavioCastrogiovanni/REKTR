<?php
$point = 1;

//middleware 
session_start();
if(!isset($_SESSION["admin"])){
    header("location: " . FRONT_END_URL . "/" );
} 
 session_abort();


?>

