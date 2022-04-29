<?php
$point = 1;

include "../components/header.php";
include "../init.php";
?>
<div id="mainBody">
    <div class="container">
        <div class="row">
            <?php
    $load = isset($_GET['action'])?$_GET['action']:'userDetails';
        switch($load){
            case 'userDetails': $option=1;
            break;
            case 'orderList': $option=2;
            break;
            case 'orderDetail': $option=2;
            break;
            case 'passwordChange': $option=3;
            break;
            case 'accountDelete': $option=4;
            break;
        }
	include "../components/userMenu.php";
	include "./$load.php";
?>
            

        </div>
    </div>
</div>
</div>
<!-- MainBody End ============================= -->
<?php
include "../components/footer.php";
?>