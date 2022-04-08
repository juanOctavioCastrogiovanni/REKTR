<?php
	include "./components/header.php";
	include "./Class/Product.class.php";

	$categ = isset($_GET['category']) ? $_GET['category'] : "";

	if(isset($_GET['category'])){
		$query = "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory WHERE categories.idCategory=:category";
	} else {
		$query = "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory";
	}

	try{
		$conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
		$conect = $conect->conect();
	}catch(Exception $e){
		echo "<p>".$e->getMessage()."</p>";
	}
	
	try{
		$products = $conect->prepare($query);
		$products->bindValue(':category',$categ);
		$products->execute();
		$count = $products->rowcount();
		$array = array();
		foreach($products->fetchAll(PDO::FETCH_ASSOC) as $product){
			array_push($array,new Product($product['idProduct'],$product['name'],$product['price'],$product['brand'],$product['category'],$product['stock'],$product['short_description'],$product['description'],$product['image1'],$product['image2'],$product['image3'],$product['new']));
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

	<div class="pagination">
			<ul>
			<li><a href="#">&lsaquo;</a></li>
			<li><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">...</a></li>
			<li><a href="#">&rsaquo;</a></li>
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