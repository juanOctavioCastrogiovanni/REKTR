<?php
include "./components/header.php";
include "./admin/functions.php";
?>
<div id="mainBody">
	<div class="container">
	<div class="row">
<?php
	include "./components/sidebar.php";
?>
	<div class="span9">
                <h3> PASSWORD CHANGE</h3>
                <hr class="soft" />

                <div class="row">
                    <!-- <div class="span9" style="min-height:900px"> -->
                   
                        <?php if (isset( $_GET["rta"]) ) {
				                echo showMenssage( $_GET["rta"] );
                        }
                        if (isset( $_GET['u'])&&isset( $_GET['k'])) {
				            $email = $_GET['u'];
				            $codeActivation =  $_GET['k'];
                        ?>
			     <form action='./admin/user.php?action=recoveryPass' method='POST'>
                    <div class="well" style="margin-left: 25px !important;">
                        <h5>Reset your password</h5><br />
                        Welcome, on this page you can update or recover your password.<br /><br /><br />
                            <div class="control-group">
                                <label class="control-label" for="inputEmail1">New password</label>
                                <div class="controls">
                                    <input class="span3" type="password" id="inputEmail1" name="pass">
                                </div>
                                <label class="control-label" for="inputEmail1">Repeat password</label>
                                <div class="controls">
                                    <input class="span3" type="password" id="inputEmail1" name="rePass">
                                </div>
                                <input type="hidden" name='u' value="<?php echo $email; ?>">
                                <input type="hidden" name='k' value="<?php echo $codeActivation; ?>">
                            </div>
                            <div class="controls">
                                <button type="submit" class="btn block">Submit</button>
                            </div>
                        </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->
<?php
include "./components/footer.php";
?>