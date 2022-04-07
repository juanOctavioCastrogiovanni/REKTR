<?php
include "./components/header.php";
include "./Class/Conect.class.php";
include "./Class/Product.class.php";
?>

<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
		  <div class="item active">
		  <div class="container">
			<a href="register"><img style="width:100%" src="themes/images/carousel/1.png" alt="special offers"/></a>
			<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</div>
		  </div>
		  </div>
		  <div class="item">
		  <div class="container">
			<a href="register"><img style="width:100%" src="themes/images/carousel/2.png" alt=""/></a>
				<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</div>
		  </div>
		  </div>
		  <div class="item">
		  <div class="container">
			<a href="register"><img src="themes/images/carousel/3.png" alt=""/></a>
			<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</div>
			
		  </div>
		  </div>
		   <div class="item">
		   <div class="container">
			<a href="register"><img src="themes/images/carousel/4.png" alt=""/></a>
			<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</div>
		   
		  </div>
		  </div>
		   <div class="item">
		   <div class="container">
			<a href="register"><img src="themes/images/carousel/5.png" alt=""/></a>
			<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
			</div>
		  </div>
		  </div>
		   <div class="item">
		   <div class="container">
			<a href="register"><img src="themes/images/carousel/6.png" alt=""/></a>
			<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</div>
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
			<h4>Featured Products <small class="pull-right">200+ featured products</small></h4>
			<div class="row-fluid">
			<div id="featured" class="carousel slide">
				<div class="carousel-inner">
			  		<?php
						$conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
						$conect = $conect->conect();
						$query = "SELECT name,price,image1 as image,new FROM products";
						$products = $conect->prepare($query);
						$products->execute();
						$count = $products->rowcount();
						$products = $products->fetchAll(PDO::FETCH_ASSOC);
						//I show in the carousel 4 products at a time
						for ($i = 0;$i<$count;$i++){
							//If is the first time
							if($i==0){
								echo "<div class='item active'>
								<ul class='thumbnails'>";
								//every four and is not the first time
							} else if($i%4==0){
								echo "<div class='item'>
								<ul class='thumbnails'>";
							}
							
							$element = new Product(NULL,$products[$i]['name'],$products[$i]['price'],NULL,NULL,NULL,NULL,NULL,$products[$i]['image'],NULL,NULL,$products[$i]['new']);						
							$element->showCardCarrousel();
							
							//every three iteratios and is not the first time
								if($i%3==0&&$i!=0){
									echo "</ul'>
									</div>";
								}
							}

							
							// foreach($products->fetchAll(PDO::FETCH_ASSOC) as $product){
							// 	$element = new Product(NULL,$product['name'],$product['price'],NULL,NULL,NULL,NULL,NULL,$product['image'],NULL,NULL,NULL);						
							// 	$element->showCardCarrousel();
							// }
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
					$query = "SELECT idProduct,products.name,price,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory WHERE new=1";
					$products = $conect->prepare($query);
					$products->execute();
					foreach($products->fetchAll(PDO::FETCH_ASSOC) as $product){
						$element = new Product($product['idProduct'],$product['name'],$product['price'],$product['brand'],$product['category'],$product['stock'],$product['short_description'],$product['description'],$product['image1'],$product['image2'],$product['image3'],$product['new']);
						$element->showCard();
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