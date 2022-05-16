<?php
	class Cart 
	{
		private $productList = [];
		private $productListArray = [];
		private $listId = [];
		private $total = 0;
		private $products = 0;
		private $sale = 0;
		
		public function cartDelete(){
			$this->productList = [];
			$this->productListArray = [];
			$this->listId = [];
			if(isset($_SESSION['user'])&&isset($_SESSION['ids'])){
				try{ 
					$conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
					$conect = $conect->conect();
				}catch(Exception $e){
					echo "<p>".$e->getMessage()."</p>";
				}

				$newCart = $this->createCartDB($conect, $_SESSION['ids']['userId']);
				if($newCart->execute()){
					$_SESSION['ids']['cartId'] = $_SESSION['ids']['cartId'] + 1;
				}
			}
		}

		public function removeItem($id){
			$key = array_search($id, $this->listId);
			unset($this->productList[$key]);
			unset($this->productListArray[$key]);
			unset($this->listId[$key]);
			if(isset($_SESSION['user'])&&isset($_SESSION['ids'])){
				try{ 
					$conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
					$conect = $conect->conect();
				}catch(Exception $e){
					echo "<p>".$e->getMessage()."</p>";
				}

				$sql = sprintf("DELETE FROM productscarts WHERE productId = %d AND cartId = %d", $id, $_SESSION['ids']['cartId']);
				$stmt = $conect->prepare($sql);
				$stmt->execute();
			}
		}
		
		public function updateCart($id){
			try{ 
                $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
                $conect = $conect->conect();
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }

			$sql = sprintf("UPDATE carts SET products = %d,total = %g WHERE cartId = %d", $this->products, $this->total, $id);
			$stmt = $conect->prepare($sql);
			$stmt->execute();
		}
		
			
		public function addItem($product,$qty,$productArray){
			if(!in_array($product->getId(),$this->listId)){
				$product->setQty($qty);
				$product->setSubTotal($qty);
				$productArray["qty"] = $product->getQty();
				$productArray["subTotal"] = $product->getSubTotal();
				$this->setProductListArray($productArray);
				array_push($this->productList,$product);
				array_push($this->listId,$product->getId());
				if(isset($_SESSION['user'])&&isset($_SESSION['ids'])){
					$product->saveProduct($_SESSION['ids']['cartId']);	
				}
			} else {
				$this->qtyModify($product,$qty);
			}	
		}
		
		public function updateItem($id, $qty){
			$key = array_search($id, $this->listId);
			$this->productList[$key]->setQty($qty);
			$this->productList[$key]->setSubTotal();
			$this->setTotal();
			$this->setProducts();
			$this->productListArray[$key]['qty'] = $this->productList[$key]->getQty();
			$this->productListArray[$key]['subTotal'] = $this->productList[$key]->getSubTotal();
			if(isset($_SESSION['user'])&&isset($_SESSION['ids'])){
				$this->productList[$key]->updateProduct();	
			}
			
		}
		
		private function qtyModify ($product,$qty){
			$key = array_search($product->getId(), $this->listId);
			if($this->productList[$key]->addQty($qty)<1){
				unset($this->productList[$key]);
				unset($this->productListArray[$key]);
			}
			
			$this->productListArray[$key]['qty'] = $this->productList[$key]->getQty();
			$this->productListArray[$key]['subTotal'] = $this->productList[$key]->getSubTotal();
			if(isset($_SESSION['user'])&&isset($_SESSION['ids'])){
				$this->productList[$key]->updateProduct();	
			}
		}
		
		public function setTotal(){
			$totalPrice = 0;
			foreach($this->productList as $product){
				$totalPrice+=$product->getSubTotal();
			}
			$this->total = $totalPrice;
		}

		public function getTotal(){return $this->total;}
		public function getProducts(){return $this->products;}

		public function getProductList(){return $this->productList;}
		public function setProductListArray($product){array_push($this->productListArray,$product);}
		public function getProductListArray(){return $this->productListArray;}
		
		public function setProducts(){
			$productsQty = 0;
			foreach($this->productList as $product){
				$productsQty+=$product->getQty();
			}
			$this->products = $productsQty;
		}

		
		
		public function createCartDB($con, $id){
			$sql = sprintf( "INSERT INTO carts( userId, sale, products, total) VALUES ( %d, 0, 0, 0)",$id );
			$newCart = $con->prepare($sql);
			return $newCart;
		}
		
		public function lastId($con){
				$sql = "SELECT MAX(cartId) AS cartId, userId FROM carts WHERE sale = 0";
				$lastId = $con->prepare($sql);
				return $lastId;
		}

		public function getProductsDB($con,$userId,$id){
			$sql = sprintf( "SELECT products.productId, products.name,products.price, products.image1, carts.cartId, productscarts.qty, productscarts.subtotal, carts.products,carts.total FROM productsCarts INNER JOIN carts INNER JOIN products ON productscarts.cartId=carts.cartId AND products.productId=productscarts.productId AND productscarts.cartId = %d AND carts.userId=%d;",$id,$userId);
				$getProducts = $con->prepare($sql);
				return $getProducts;
		}

		public function saveCart($id){
			try{ 
                $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
                $conect = $conect->conect();
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }

			$sql = sprintf("INSERT INTO carts (userId, products,total) VALUES (%d,%d,%g)", $id, $this->products, $this->total);
			$stmt = $conect->prepare($sql);
			if($stmt->execute()){
				$cartId = $conect->lastInsertId();
				foreach($this->productList as $product){
					$product->saveProduct($cartId);
				}
			}
		}

		public function showCart(){
			echo "<table class='table table-bordered'>
						<thead>
							<tr>
							<th>Image</th>
							<th>Product</th>
							<th>Quantity/Update</th>
							<th>Price</th>

							<th>Total</th>
							</tr>
						</thead>
						<tbody>";
						
						foreach($this->getProductListArray() as $product){
							echo "<tr>
								<td> <img width='60' src='./themes/images/products/upload/".$product['image1']."' alt=''/></td>
								<td>".$product['name']."</td>
								<td>
								<div class='input-append'>
									<form method='POST' action='./cart?option=qtymodify&id=".$product['productId']."'>
										<input class='span1' style='max-width:34px' name='qty' placeholder='".$product['qty']."' value='".$product['qty']."'  size='16' type='number' min='0'>
										<button class='btn' type='submit'>
											<i class='icon-refresh'></i>
										</button>
										<a href='./cart?option=remove&id=".$product['productId']."' class='btn btn-danger'>
										<i class='icon-remove icon-white'></i>
										</a>
									</form>
								</div>
								</td>
								<td>".$product['price']."</td>
			
								<td>".$product['subTotal']."</td>
							</tr>";
						}

						echo "
							<td colspan='2' style='text-align:right'><a href='./cart.php?option=cartDelete'><strong>Cart delete</strong></a></td>
							<td colspan='2' style='text-align:right'><strong>TOTAL PRICE =</strong></td>
							<td class='label label-important' style='display:block'> <strong> $".$this->total." </strong></td>
							</tr>
						</tbody>
			</table>";
		}
				
	}
	?>