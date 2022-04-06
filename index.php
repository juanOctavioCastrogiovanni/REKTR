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
			  <div class="item active">
			  <ul class="thumbnails">
				<li class="span3">
				  <div class="thumbnail">
				  <i class="tag"></i>
					<a href="product_details"><img src="themes/images/products/b1.jpg" alt=""></a>
					<div class="caption">
					  <h5>Product name</h5>
					  <h4><a class="btn" href="product_details">VIEW</a> <span class="pull-right">$222.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
				  <i class="tag"></i>
					<a href="product_details"><img src="themes/images/products/b2.jpg" alt=""></a>
					<div class="caption">
					  <h5>Product name</h5>
					  <h4><a class="btn" href="product_details">VIEW</a> <span class="pull-right">$222.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
				  <i class="tag"></i>
					<a href="product_details"><img src="themes/images/products/b3.jpg" alt=""></a>
					<div class="caption">
					  <h5>Product name</h5>
					   <h4><a class="btn" href="product_details">VIEW</a> <span class="pull-right">$222.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
				  <i class="tag"></i>
					<a href="product_details"><img src="themes/images/products/b4.jpg" alt=""></a>
					<div class="caption">
					  <h5>Product name</h5>
					   <h4><a class="btn" href="product_details">VIEW</a> <span class="pull-right">$222.00</span></h4>
					</div>
				  </div>
				</li>
			  </ul>
			  </div>
			   <div class="item">
			  <ul class="thumbnails">
				<li class="span3">
				  <div class="thumbnail">
				  <i class="tag"></i>
					<a href="product_details"><img src="themes/images/products/5.jpg" alt=""></a>
					<div class="caption">
					  <h5>Product name</h5>
					  <h4><a class="btn" href="product_details">VIEW</a> <span class="pull-right">$222.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
				  <i class="tag"></i>
					<a href="product_details"><img src="themes/images/products/6.jpg" alt=""></a>
					<div class="caption">
					  <h5>Product name</h5>
					  <h4><a class="btn" href="product_details">VIEW</a> <span class="pull-right">$222.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a href="product_details"><img src="themes/images/products/7.jpg" alt=""></a>
					<div class="caption">
					  <h5>Product name</h5>
					   <h4><a class="btn" href="product_details">VIEW</a> <span class="pull-right">$222.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a href="product_details"><img src="themes/images/products/8.jpg" alt=""></a>
					<div class="caption">
					  <h5>Product name</h5>
					   <h4><a class="btn" href="product_details">VIEW</a> <span class="pull-right">$222.00</span></h4>
					</div>
				  </div>
				</li>
			  </ul>
			  </div>
			   <div class="item">
			  <ul class="thumbnails">
				<li class="span3">
				  <div class="thumbnail">
					<a href="product_details"><img src="themes/images/products/9.jpg" alt=""></a>
					<div class="caption">
					  <h5>Product name</h5>
					  <h4><a class="btn" href="product_details">VIEW</a> <span class="pull-right">$222.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a href="product_details"><img src="themes/images/products/10.jpg" alt=""></a>
					<div class="caption">
					  <h5>Product name</h5>
					  <h4><a class="btn" href="product_details">VIEW</a> <span class="pull-right">$222.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a href="product_details"><img src="themes/images/products/11.jpg" alt=""></a>
					<div class="caption">
					  <h5>Product name</h5>
					   <h4><a class="btn" href="product_details">VIEW</a> <span class="pull-right">$222.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a href="product_details"><img src="themes/images/products/1.jpg" alt=""></a>
					<div class="caption">
					  <h5>Product name</h5>
					   <h4><a class="btn" href="product_details">VIEW</a> <span class="pull-right">$222.00</span></h4>
					</div>
				  </div>
				</li>
			  </ul>
			  </div>
			   <div class="item">
			  <ul class="thumbnails">
				<li class="span3">
				  <div class="thumbnail">
					<a href="product_details"><img src="themes/images/products/2.jpg" alt=""></a>
					<div class="caption">
					  <h5>Product name</h5>
					  <h4><a class="btn" href="product_details">VIEW</a> <span class="pull-right">$222.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a href="product_details"><img src="themes/images/products/3.jpg" alt=""></a>
					<div class="caption">
					  <h5>Product name</h5>
					  <h4><a class="btn" href="product_details">VIEW</a> <span class="pull-right">$222.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a href="product_details"><img src="themes/images/products/4.jpg" alt=""></a>
					<div class="caption">
					  <h5>Product name</h5>
					   <h4><a class="btn" href="product_details">VIEW</a> <span class="pull-right">$222.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a href="product_details"><img src="themes/images/products/5.jpg" alt=""></a>
					<div class="caption">
					  <h5>Product name</h5>
					   <h4><a class="btn" href="product_details">VIEW</a> <span class="pull-right">$222.00</span></h4>
					</div>
				  </div>
				</li>
			  </ul>
			  </div>
			  </div>
			  <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
			  <a class="right carousel-control" href="#featured" data-slide="next">›</a>
			  </div>
			  </div>
		</div>
		<h4>Latest Products </h4>
			  <ul class="thumbnails">
				<?php
					$conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
					$conect = $conect->conect();
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