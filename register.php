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
    <ul class="breadcrumb">
		<li><a href="index">Home</a> <span class="divider">/</span></li>
		<li class="active">Registration</li>
    </ul>
	<h3> Registration</h3>	
	<?php if (isset( $_GET["rta"]) ) {
				echo showMenssage( $_GET["rta"] );
			} ?>
	<div class="well">
	<form class="form-horizontal" action="./admin/user.php?action=addUser" method="POST">
		<h4>Your personal information</h4>
		
		<div class="control-group">
			<label class="control-label" for="inputFname1">First name <sup>*</sup></label>
			<div class="controls">
			  <input type="text" id="inputFname1"  placeholder="First Name"  name="firstname" required>
			</div>
		 </div>
		 <div class="control-group">
			<label class="control-label" for="inputLnam" >Last name <sup>*</sup></label>
			<div class="controls">
			  <input type="text" id="inputLnam"  placeholder="Last Name" name="lastname" required>
			</div>
		 </div>
		<div class="control-group">
		<label class="control-label" for="input_email">Email <sup>*</sup></label>
		<div class="controls">
		  <input type="text" id="input_email"  placeholder="Email" name="email" required>
		</div>
	  </div>	  
	<div class="control-group">
		<label class="control-label" for="inputPassword1">Password <sup>*</sup></label>
		<div class="controls">
		  <input type="password" id="inputPassword1" placeholder="Password" name="password" required>
		</div>
	  </div>	
	  <div class="control-group">
		<label class="control-label" for="inputPassword1">Repeat password <sup>*</sup></label>
		<div class="controls">
		  <input type="password" id="inputPassword1" placeholder="Repeat password" name="rePassword" required>
		</div>
	  </div>  
		
		
	<p><sup>*</sup>Required field	</p>
	
	<div class="control-group">
			<div class="controls">
				<input type="hidden" name="email_create" value="1">
				<input type="hidden" name="is_new_customer" value="1">
				<input class="btn btn-large btn-success" type="submit" value="Register" />
			</div>
		</div>		
	</form>
</div>

</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->
<?php
	include "./components/footer.php";
?>