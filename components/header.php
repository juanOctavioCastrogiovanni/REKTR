<?php
	$point = isset($point)?"..":".";
	include $point."/Class/Conect.class.php";

?>
<!-- Todos las paginas llamaran con un include a header -->
<!-- All the pages will call with an include header -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Bootshop online Shopping cart</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<!--Less styles -->
	<!-- Other Less css file //different less files has different color scheam
	<link rel="stylesheet/less" type="text/css" href="themes/less/simplex.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/classified.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/amelia.less">  MOVE DOWN TO activate
	-->
	<!--<link rel="stylesheet/less" type="text/css" href="themes/less/bootshop.less">
	<script src="themes/js/less.js" type="text/javascript"></script> -->

	<!-- Bootstrap style -->
	<link id="callCss" rel="stylesheet" href="<?php echo $point ?>/themes/bootshop/bootstrap.min.css" media="screen" />
	<link href="<?php echo $point ?>/themes/css/base.css" rel="stylesheet" media="screen" />
	<!-- Bootstrap style responsive -->
	<!-- <link href="<?php echo $point ?>/themes/css/priceFilter.css" rel="stylesheet" type="text/css"> -->
	<link href="<?php echo $point ?>/themes/css/bootstrap-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo $point ?>/themes/css/font-awesome.css" rel="stylesheet" type="text/css">
	<!-- Google-code-prettify -->
	<link href="<?php echo $point ?>/themes/js/google-code-prettify/prettify.css" rel="stylesheet" />
	<!-- fav and touch icons -->
	<link rel="shortcut icon" href="<?php echo $point ?>/themes/images/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144"
	href="<?php echo $point ?>/themes/images/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114"
	href="<?php echo $point ?>/themes/images/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $point ?>/themes/images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="<?php echo $point ?>/themes/images/ico/apple-touch-icon-57-precomposed.png">
	<link href="<?php echo $point ?>/<?php echo $point ?>/themes/css/styles.css" rel="stylesheet" type="text/css"> 
	<style type="text/css" id="enject"></style>
</head>

<body>
	<div id="header">
		<div class="container">
			<div id="welcomeLine" class="row">
				 <div class="span6">Welcome!<strong> User</strong></div> 
				<?php
				 	
				?>
				<div class="span6">
					<div class="pull-right">
						<a href="<?php echo $point ?>/product_summary"><span>Total</span></a>
						<span class="btn btn-mini">$155.00</span>
						<a href="<?php echo $point ?>/product_summary"><span class="">$</span></a>
						<a href="<?php echo $point ?>/product_summary"><span class="btn btn-mini btn-primary"><i
									class="icon-shopping-cart icon-white"></i> [ 3 ] Itemes in your cart </span> </a>
					</div>
				</div>
			</div>
			<!-- Navbar ================================================== -->
			<div id="logoArea" class="navbar">
				<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<div class="navbar-inner">
					<a class="brand" href="<?php echo $point ?>/index"><img src="<?php echo $point ?>/themes/images/logo.png" alt="Bootsshop" /></a>
					<form class="form-inline navbar-search" method="post" action="products">
						<input id="srchFld" class="srchTxt" type="text" />
						<button type="submit" id="submitButton" class="btn btn-primary">Go</button>
					</form>
					<ul id="topMenu" class="nav pull-right">
						<li class=""><a href="<?php echo $point ?>/products">Products</a></li>
						<li class=""><a href="<?php echo $point ?>/user/panel">USER</a></li>
						<li class=""><a href="<?php echo $point ?>/contact">Contact</a></li>
						<li class="">
							<a href="#login" role="button" data-toggle="modal" style="padding-right:0"><span
									class="btn btn-large btn-warning">Login</span></a>
							<div id="login" class="modal hide fade in" tabindex="-1" role="dialog"
								aria-labelledby="login" aria-hidden="false">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal"
										aria-hidden="true">×</button>
									<h3>Login</h3>
								</div>
								<div class="modal-body">
									<div class="div1">
										<form class="form-horizontal loginFrm" action="./admin/user.php?action=loginUser" method="POST">
											<div class="control-group">
												<input type="text" id="inputEmail" placeholder="Email" name="email">
												<input type="hidden" name="type" value="login">
											</div>
											<div class="control-group" style="margin-bottom:10px">
												<input type="password" id="inputPassword" placeholder="Password" name="password">
											</div>
											<!-- <div class="control-group" >
												<label class="checkbox" style="display: inline-block;">
													<input type="checkbox"> Remember me
												</label>
											</div> -->
											<button type="submit" class="btn btn-success">Sign in</button>
											<!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
											<a href="<?php echo $point ?>forgetpass" class="btn-sm" >Forget password</a>
										</form>
									</div>
									<div class="div2">
										<p>you are not registered?</p>
										<a href="<?php echo $point ?>/register" class="btn-info btn">Register</a>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Header End====================================================================== -->