<?php
	include "./components/header.php";
	include "./Class/Product.class.php";
	include "./admin/functions.php";

	$categ = isset($_GET['category']) ? $_GET['category'] : "";

	isset($_GET['page'])?
	

	
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
		<li class="active">Products</li>
    </ul>
	<h3> Products <small class="pull-right"> <?php echo $count ?> products are available </small></h3>	
	<hr class="soft"/>
	<p>
	Browse our shop and filter by category to see the variety of our products.	</p>
	<hr class="soft"/>
	
	  
<div id="myTab" class="pull-right">
 <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
 <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
</div>
<br class="clr"/>
<div class="tab-content">
	<div class="tab-pane" id="listView">
	<?php
		try{
			foreach($array as $element){
				$element -> showProductList();
			}
		}catch(Exception $e){
			echo "<p>".$e->getMessage()."</p>";
		}
		?>
	</div>

	<div class="tab-pane active" id="blockView" >
		<ul class="thumbnails">
			<?php
					try{
						foreach($array as $element){
							$element -> showProduct();
						}
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
			?>
		</ul>
	<hr class="soft"/>
	</div>
</div>

	<div class="pagination">
			<ul>
			<?php echo "<li><a href='".$q."&page=0'>1</a></li>"; ?>
		<?php
			$qty = roundDown($count,6);
			if(($count/6)>=1){
				for ($i = 0; $i<=$qty; $i++){
					echo "<li><a href='".$q."&page=".($i+1)."'>".($i+2)."</a></li>";
				}
			}
		?>
			</ul>
			</div>
			<br class="clr"/>
</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->
<?php
	include "./components/footer.php";
?>