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
	
	$query= "SELECT idProduct,products.name,price,categories.idCategory,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory WHERE products.idProduct=:id";
	$product = $conect->prepare($query);
	$product->bindParam(':id',$id, PDO::PARAM_INT);
	$product->execute();
	$product=$product->fetch(PDO::FETCH_ASSOC);
	$query2= "SELECT idProduct,products.name,price,categories.idCategory,brands.name as brand,categories.name as category,stock,short_description,description,image1,image2,image3,new FROM products INNER JOIN brands ON products.brand=brands.idBrand INNER JOIN categories ON products.category=categories.idCategory WHERE products.category=:idCategory AND NOT products.idProduct=:id";
	$products = $conect->prepare($query2);
	$products->bindParam(':idCategory',$product['idCategory'], PDO::PARAM_INT);
	$products->bindParam(':id',$id, PDO::PARAM_INT);
	$products->execute();
	$products=$products->fetchAll(PDO::FETCH_ASSOC);

	// var_dump($product['image1'],$product['image2'],$product['image3']);

	try{
		$product_detail=new Product($product['idProduct'],$product['name'],$product['price'],$product['brand'],$product['category'],$product['stock'],$product['short_description'],$product['description'],$product['image1'],$product['image2'],$product['image3'],$product['new']);
	}catch(Exception $e){
		echo "<p>".$e->getMessage()."</p>";
	}
	$productsObjects= array();

	foreach($products as $produ){
		try{
			array_push($productsObjects,new Product($produ['idProduct'],$produ['name'],$produ['price'],$produ['brand'],$produ['category'],$produ['stock'],$produ['short_description'],$produ['description'],$produ['image1'],$produ['image2'],$produ['image3'],$produ['new']));
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