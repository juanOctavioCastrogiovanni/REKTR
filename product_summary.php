<?php
	include "./components/header.php";
	
	
?>
<div id="mainBody">
	<div class="container">
	<div class="row">
<?php
	include "./components/sidebar.php";

	echo "<div class='span9'>
			<ul class='breadcrumb'>
				<li><a href='index'>Home</a> <span class='divider'>/</span></li>
				<li class='active'> SHOPPING CART</li>
			</ul>
			<h3>  SHOPPING CART [ <small>"; if(isset($_SESSION['Cart'])){echo $_SESSION['Cart']->getProducts();}else{echo 0;} echo "&nbsp</small>]<a href='products' class='btn btn-large pull-right'><i class='icon-arrow-left'></i> Continue Shopping </a></h3>	
			<hr class='soft'/>";

	if(!isset($_SESSION['user'])){
		echo "<table class='table table-bordered'>
				<tr><th> I AM ALREADY REGISTERED  </th></tr>
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
							<input type='password' id='inputPassword1' placeholder='Password' name='password'>
						</div>
						</div>
						<div class='control-group'>
						<div class='controls'>
							<button type='submit' class='btn'>Sign in</button> OR <a href='register' class='btn'>Register Now!</a>
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
			</table>";	
	} else {

	}
	// echo "<pre>";
	// var_dump(get_class_methods($_SESSION['Cart']));
	// echo "</pre>";
	

	if(isset($_SESSION['Cart'])){
		var_dump($_SESSION['Cart']->showCart());
	}


?>
	
	<table class="table table-bordered">
                            <thead>
                                <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Quantity/Update</th>
                                <th>Price</th>

                                <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td> <img width="60" src="./themes/images/products/upload/a7-front.jpeg" alt=""/></td>
                                <td>MASSA AST<br/>Color : black, Material : metal</td>
                                <td>
                                    <div class="input-append"><input class="span1" style="max-width:34px" placeholder="1"  size="16" type="text"><button class="btn" type="button"><i class="icon-minus"></i></button><button class="btn" type="button"><i class="icon-plus"></i></button><button class="btn btn-danger" type="button"><i class="icon-remove icon-white"></i></button>				</div>
                                </td>
                                <td>$120.00</td>

                                <td>$110.00</td>
                                </tr>
                                
                                <!-- total -->
                                
                                <td colspan="4" style="text-align:right"><strong>TOTAL PRICE =</strong></td>
                                <td class="label label-important" style="display:block"> <strong> $228.00 </strong></td>
                                </tr>
                                </tbody>
</table>
		
		
            <!-- <table class="table table-bordered">
			<tbody>
				 <tr>
                  <td> 
				<form class="form-horizontal">
				<div class="control-group">
				<label class="control-label"><strong> VOUCHERS CODE: </strong> </label>
				<div class="controls">
				<input type="text" class="input-medium" placeholder="CODE">
				<button type="submit" class="btn"> ADD </button>
				</div>
				</div>
				</form>
				</td>
                </tr>
				
			</tbody>
			</table> -->
			
			
	<a href="products" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
	<a href="login" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>
	
</div>
</div></div>
</div>
<!-- MainBody End ============================= -->
<?php
	include "./components/footer.php";
?>