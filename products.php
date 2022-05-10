<?php
	include "./components/header.php";
	include "./Class/Product.class.php";
	include "./admin/functions.php";
	
	//verify query of url, if exist...
	$categ = isset($_GET['category']) ? $_GET['category'] : "";	
	$page = isset($_GET['page']) ? $_GET['page'] : 0;	
	$min = isset($_GET['min']) ? $_GET['min'] : NULL;	
	$max = isset($_GET['max']) ? $_GET['max'] : NULL;	
	$sort = isset($_GET['sort']) ? $_GET['sort'] : NULL;	
	$isProducts=TRUE;
	$asc = $sort==='asc'?'selected':'';
	$desc = $sort==='desc'?'selected':'';


	//build url pagination
	$q = filterUrl($categ,$min,$max,$sort);

//if exist category param
	if($categ!=""){
		$query = filterQuery($page,TRUE,$min,$max,$sort,TRUE);
		$total = filterQuery($page,TRUE,$min,$max,$sort,FALSE);
	} else {
		$query = filterQuery($page,FALSE,$min,$max,$sort,TRUE);
		$total = filterQuery($page,FALSE,$min,$max,$sort,FALSE);
	}


	try{ 
		$conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
		$conect = $conect->conect();
	}catch(Exception $e){
		echo "<p>".$e->getMessage()."</p>";
	}
	
	try{
		$products = $conect->prepare($query);
		$count = $conect->prepare($total);
		$products->bindParam(':category',$categ, PDO::PARAM_INT);
		$count->bindParam(':category',$categ, PDO::PARAM_INT);
		$products->execute();
		$count->execute();
		$count = $count->rowcount();
		$array = array();
		foreach($products->fetchAll(PDO::FETCH_ASSOC) as $product){
			array_push($array,new Product($product['productId'],$product['name'],$product['price'],$product['brand'],$product['category'],$product['stock'],$product['short_description'],$product['description'],$product['image1'],$product['image2'],$product['image3'],$product['new']));
		}
	}catch(Exception $e){
		echo "<p>".$e->getMessage()."</p>";
	}

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
<!-- modificar el paginador para que arrastre la categoria y los filtros asociados -->
	<div class="pagination">
			<ul>
			<?php echo "<li><a href='".$q."&page=0'>1</a></li>"; ?>
		<?php
			$qty = roundDown($count,8);
			if(($count/8)>1){
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