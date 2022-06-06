<?php
	include "./components/header.php";
	include "./Class/Product.class.php";
	include "./admin/functions.php";

    $array = array();
    if(isset($_GET['search'])){
        $search = $_GET['search'];
        try{ 
            $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
            $conect = $conect->conect();
            $sql = "SELECT products.productId, products.name,products.price,brands.name as brand,categories.name 
            as category, products.stock, products.short_description, products.description, products.image1,products.image2,products.image3, 
            products.new FROM products INNER JOIN brands INNER JOIN categories ON products.category = categories.categoryId AND products.brand = brands.brandId WHERE CONCAT(products.productId,products.name,products.price,brands.name,categories.name) LIKE '%".$search."%'";
            $stmt = $conect->prepare($sql);
            if($stmt->execute()){
                $count = $stmt->rowCount();
                foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $product){
                try{ 
                    array_push($array,new Product($product['productId'],$product['name'],$product['price'],$product['brand'],$product['category'],$product['stock'],$product['short_description'],$product['description'],$product['image1'],$product['image2'],$product['image3'],$product['new']));                   
                }catch(Exception $e){
                    echo "<p>".$e->getMessage()."</p>";
                }
    
            }
        }
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
		<li class="active">Products</li>
    </ul>
	<h3 >The results for your search: <strong><?php echo count($array)?></strong></h3>
    <div style="width: 80%;max-width:700px; height: 0.5px; background: gray;margin:50px 0"></div>

    <?php
        if(count($array)>0){
            foreach($array as $element){
				$element -> showProductList();
			}
        }
    ?>

</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->
<?php
	include "./components/footer.php";
?>
