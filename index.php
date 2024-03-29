﻿<?php
include "./components/header.php";
include "./Class/Product.class.php";

	try{
		$conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
		$conect = $conect->conect();
	}catch(Exception $e){
		echo "<p>".$e->getMessage()."</p>";
	}
	try{
		$query = "SELECT productId,name,price,image1 as image, new FROM products";
		$products = $conect->prepare($query);
		$products->execute();
		$count = $products->rowcount();
		$products = $products->fetchAll(PDO::FETCH_ASSOC);
	}catch(Exception $e){
		echo "<p>".$e->getMessage()."</p>";
	}

	// echo "<pre>";
	// var_dump($_SESSION);
	// echo "</pre>";

?>

<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
		  <div class="item active">
		  <div class="container">
			<a href="./product_details?id=1"><img style="width:100%" src="themes/images/carousel1/carousel-1.png" alt="special offers"/></a>			
		  </div>
		  </div>
		  <div class="item">
		  <div class="container">
			<a href="./product_details?id=3"><img style="width:100%" src="themes/images/carousel1/carousel-2.png" alt=""/></a>
		  </div>
		  </div>
		  <div class="item">
		  <div class="container">
			<a href="./product_details?id=9"><img src="themes/images/carousel1/carousel-3.png" alt=""/></a>
		  </div>
		  </div>
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	  </div> 
</div>
<div id="mainBody">
	<div class="container">
	<div class="row">

<?php
	include "./components/sidebar.php";
?>

		<div class="span9">		
			<div class="well well-small">
			<h4>Featured Products </h4>
			<div class="row-fluid">
			<div id="featured" class="carousel slide">
				<div class="carousel-inner">
			  		<?php
					  try {
						for ($i = 0;$i<$count;$i++){
							if($i==0){
								echo "<div class='item active'>";
								echo "<ul class='thumbnails'>";
							} else if($i%2==0){
								echo "<div class='item'>
								<ul class='thumbnails'>";
							}
							
							$element = new Product($products[$i]['productId'],$products[$i]['name'],$products[$i]['price'],NULL,NULL,NULL,NULL,NULL,$products[$i]['image'],NULL,NULL,$products[$i]['new']);						
							$element->showCardCarrousel();
							
							//every three iteratios and is not the first time
								if(($i+1)%2==0&&$i!=0){
									echo "</ul'>
									</div>";
								}
							}
						}catch(Exception $e){
							echo "<p>".$e->getMessage()."</p>";
						}
					?>
			  	</div>
			
			</div>
			<a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
			<a class="right carousel-control" href="#featured" data-slide="next">›</a>
			
			</div>
		</div>
		
		<h4>Latest Products </h4>
			  <ul class="thumbnails">
				<?php
				try{
					$query = "SELECT productId,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.brandId INNER JOIN categories ON products.category=categories.categoryId WHERE new=1";
					$products_list = $conect->prepare($query);
					$products_list->execute();
					foreach($products_list->fetchAll(PDO::FETCH_ASSOC) as $product){
						$element = new Product($product['productId'],$product['name'],$product['price'],$product['brand'],$product['category'],$product['stock'],$product['short_description'],$product['description'],$product['image1'],$product['image2'],$product['image3'],$product['new']);
						$element->showCard();
					}
				}catch(Exception $e){
					echo "<p>".$e->getMessage()."</p>";
				}
				?>
			  </ul>	

		</div>
		</div>
	</div>
</div>
<?php
include "./components/footer.php";
?>