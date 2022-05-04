<?php
	include "./components/header.php";
	include "./Class/Product.class.php";

	$id = isset($_GET['id'])?(int)$_GET['id']:'error';
	try{ 
		$conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
		$conect = $conect->conect();
	}catch(Exception $e){
		echo "<p>".$e->getMessage()."</p>";
	}
	
	$query= "SELECT productId,products.name,price,categories.categoryId,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.brandId INNER JOIN categories ON products.category=categories.categoryId WHERE products.productId=:id";
	$product = $conect->prepare($query);
	$product->bindParam(':id',$id, PDO::PARAM_INT);
	$product->execute();
	$product=$product->fetch(PDO::FETCH_ASSOC);
	$query2= "SELECT productId,products.name,price,categories.categoryId,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.brandId INNER JOIN categories ON products.category=categories.categoryId WHERE products.category=:categoryId AND NOT products.productId=:id";
	$products = $conect->prepare($query2);
	$products->bindParam(':categoryId',$product['categoryId'], PDO::PARAM_INT);
	$products->bindParam(':id',$id, PDO::PARAM_INT);
	$products->execute();
	$products=$products->fetchAll(PDO::FETCH_ASSOC);

	// var_dump($product['image1'],$product['image2'],$product['image3']);

	try{
		$product_detail=new Product($product['productId'],$product['name'],$product['price'],$product['brand'],$product['category'],$product['stock'],$product['short_description'],$product['description'],$product['image1'],$product['image2'],$product['image3'],$product['new']);
	}catch(Exception $e){
		echo "<p>".$e->getMessage()."</p>";
	}
	$productsObjects= array();

	foreach($products as $produ){
		try{
			array_push($productsObjects,new Product($produ['productId'],$produ['name'],$produ['price'],$produ['brand'],$produ['category'],$produ['stock'],$produ['short_description'],$produ['description'],$produ['image1'],$produ['image2'],$produ['image3'],$produ['new']));
		}catch(Exception $e){
			echo "<p>".$e->getMessage()."</p>";
		}
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
					<li><a href="products">Products</a> <span class="divider">/</span></li>
					<li class="active"><?php echo $product['name']?></li>
				</ul>
				<?php
					$product_detail->showProductDetails();
				?>
				<div class='tab-pane fade' id='profile'>
                          <div id='myTab' class='pull-right'>
                            <a href='#listView' data-toggle='tab'><span class='btn btn-large'><i
                                  class='icon-list'></i></span></a>
                            <a href='#blockView' data-toggle='tab'><span class='btn btn-large btn-primary'><i
                                  class='icon-th-large'></i></span></a>
                          </div>
                          <br class='clr' />
                          <hr class='soft' />
                          <div class='tab-content'>
                            <div class='tab-pane' id='listView'>
                            <?php
							foreach($productsObjects as $produ){
								$produ->showRelatedProduct();
							}							
							?>
							</div>
                            <div class='tab-pane active' id='blockView'>
                              <ul class='thumbnails'>
								<?php
								foreach($productsObjects as $produ){
									$produ->showRelatedProductList();
								}
								?>
							  </ul>
                              <hr class='soft' />
                            </div>
                          </div>
                          <br class='clr'>
                        </div>
                      </div>
                    </div>

            </div>
			</div>

		</div>
		</div>
		<!-- MainBody End ============================= -->
		<?php
	include "./components/footer.php";
?>