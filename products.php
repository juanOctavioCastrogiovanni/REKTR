<?php
	include "./components/header.php";
	include "./Class/Product.class.php";
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
		<li class="active">Products Name</li>
    </ul>
	<h3> Products Name <small class="pull-right"> 40 products are available </small></h3>	
	<hr class="soft"/>
	<p>
	Browse our shop and filter by category to see the variety of our products.	</p>
	<hr class="soft"/>
	<form class="form-horizontal span6">
		<div class="control-group">
		  <label class="control-label alignL">Sort By </label>
			<select>
              <option>Priduct name A - Z</option>
              <option>Priduct name Z - A</option>
              <option>Priduct Stoke</option>
              <option>Price Lowest first</option>
            </select>
		</div>
	  </form>
	  
<div id="myTab" class="pull-right">
 <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
 <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
</div>
<br class="clr"/>
<div class="tab-content">
	<div class="tab-pane" id="listView">
	<?php
				try{
					$conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
					$conect = $conect->conect();
					$query = "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory WHERE new=1";
					$products = $conect->prepare($query);
					$products->execute();
					foreach($products->fetchAll(PDO::FETCH_ASSOC) as $product){
						$element = new Product($product['idProduct'],$product['name'],$product['price'],$product['brand'],$product['category'],$product['stock'],$product['short_description'],$product['description'],$product['image1'],$product['image2'],$product['image3'],$product['new']);
						$element->showProductList();
					}
				}catch(Exception $e){
					echo "<p>".$e->getMessage()."</p>";
				}
				?>
	</div>

	<div class="tab-pane  active" id="blockView">
		<ul class="thumbnails">
		<?php
				try{
					$conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
					$conect = $conect->conect();
					$query = "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory WHERE new=1";
					$products = $conect->prepare($query);
					$products->execute();
					foreach($products->fetchAll(PDO::FETCH_ASSOC) as $product){
						$element = new Product($product['idProduct'],$product['name'],$product['price'],$product['brand'],$product['category'],$product['stock'],$product['short_description'],$product['description'],$product['image1'],$product['image2'],$product['image3'],$product['new']);
						$element->showProduct();
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