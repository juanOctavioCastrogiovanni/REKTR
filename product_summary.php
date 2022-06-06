<?php
	include "./components/header.php";
	include "./admin/functions.php";
	include "./Class/Product.class.php";
	
	
?>
<div id="mainBody">
	<div class="container">
		<div class="row">
			<?php
	include "./components/sidebar.php";
?>
			<div class='span9'>
				<ul class='breadcrumb'>
					<li><a href='index'>Home</a> <span class='divider'>/</span></li>
					<li class='active'> SHOPPING CART</li>
				</ul>
				<h3 class='marginPlus15'> SHOPPING CART [ <small>
					<?php if(isset($_SESSION['cartArray'])){echo $_SESSION['cartArray']['products'];}else{echo 0;} ?> &nbsp</small>]<a href='products'
						class='btn btn-large pull-right margin-15'><i class='icon-arrow-left'></i> Continue Shopping
					</a></h3>
				<hr class='soft' />
				<?php if(!isset($_SESSION['user'])){ ?>
				<table class='table table-bordered'>
					<tr>
						<th> I AM ALREADY REGISTERED </th>
					</tr>
					<tr>
						<td>
							<form action='./admin/user.php?action=loginUser' method='POST'>
								<div class='control-group'>
									<label class='control-label' for='inputUsername'>Email</label>
									<div class='controls'>
										<input type='text' id='inputUsername' placeholder='Email' name='email'>
									</div>
								</div>
								<div class='control-group'>
									<label class='control-label' for='inputPassword1'>Password</label>
									<div class='controls'>
										<input type='password' id='inputPassword1' placeholder='Password'
											name='password'>
									</div>
								</div>
								<div class='control-group'>
									<div class='controls'>
										<button type='submit' class='btn'>Sign in</button> OR <a href='register'
											class='btn'>Register Now!</a>
									</div>
								</div>
								<div class='control-group'>
									<div class='controls'>
										<a href='forgetpass' style='text-decoration:underline'>Forgot password ?</a>
									</div>
								</div>
							</form>
						</td>
					</tr>
				</table>
				<?php } ?>

				<div style='overflow:auto;'>
					<table class='table table-bordered'>
						<thead>
							<tr>
								<th>Image</th>
								<th>Product</th>
								<th>Quantity/Update</th>
								<th>Price</th>

								<th>Total</th>
							</tr>
						</thead>
						<tbody>

	<?php if(isset($_SESSION['cartArray'])&&$_SESSION['cartArray']['total']>0){
		$newObject = array_to_cart($_SESSION['cartArray']['productsArray'],FALSE);
		$newObject->showCart();
	} else { ?>
							<td colspan='5' style=''>
								<div
									style='background:#e9e9e9; height:100px; color:#949494;font-size:24px; display:flex; justify-content:center; padding-top:80px;'>
									<strong><i>EMPTY CART</i></strong></div>
							</td>
						</tbody>
					</table>
				</div>
		<?php } ?>
		<a href="products" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
	<?php
		if(isset($_SESSION['user'])&&isset($_SESSION['cartArray'])&&$_SESSION['cartArray']['total']>0){
			echo "<a href='paypage' class='btn-pay pull-right'>Next <i class='icon-arrow-right'></i></a>";
		}
	?>

			</div>
		</div>
	</div>
</div>
<!-- MainBody End ============================= -->
<?php
	include "./components/footer.php";
?>