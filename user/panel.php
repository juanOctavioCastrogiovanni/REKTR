<?php
$point = 1;
include "../components/header.php";
include "../init.php";
?>
<div id="mainBody">
    <div class="container">
        <div class="row">
            <?php
	include "../components/userMenu.php";
    $load = isset($_GET['action'])?$_GET['action']:'userDetails';
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