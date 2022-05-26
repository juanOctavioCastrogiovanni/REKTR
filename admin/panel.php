<?php
$point = 1;
include "../components/header.php";
include "./functions.php";

if(isset($_SESSION["admin"])&&$_SESSION["admin"]){
      echo  "<div id='mainBody'>
                <div class='container'>
                    <div class='row'>";
                    include './orderList.php';
      echo "</div>
                </div>
            </div>
            </div>";
} 



?>

<!-- MainBody End ============================= -->
