<?php
session_start();
$point = 1;
if(isset($_GET['b'])){
    session_destroy();
    header("location:../");
}

?>