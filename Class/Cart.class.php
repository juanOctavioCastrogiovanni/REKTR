<?php
	class Cart 
	{
		private $productList = [];
		// private $productListArray = [];
		private $listId = [];
		private $total = 0;
		private $products = 0;
		private $sale = 0;

		public function getListId(){return $this->listId;}

		//ESTA FUNCION NO ELIMINA EL CARRITO, CREA UN NUEVO CARRITO ACTUALIZANDO EL ID CARRITO.
		//this function does not remove cart, create new cart and cartId update.
		public function cartDelete(){
			$this->productList = [];
			// $this->productListArray = [];
			$this->listId = [];
			if(isset($_SESSION['user'])&&isset($_SESSION['ids'])){
				try{ 
					$conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
					$conect = $conect->conect();
					$newCart = $this->createCartDB($conect, $_SESSION['ids']['userId']);
					if($newCart->execute()){
						$_SESSION['ids']['cartId'] = $_SESSION['ids']['cartId'] + 1;
					}
				}catch(Exception $e){
					echo "<p>".$e->getMessage()."</p>";
				}
			}
		}

		//ESTA FUNCION REMUEVE UN PRODUCTO DE LAS LISTA DE IDS, DEL ARRAY PRODUCTLISTARRAY Y DE LA LISTA DE OBJETOS DE PRODUCTOS.
		//this function does remove product.
		public function removeItem($id){
			$key = array_search($id, $this->listId);
			unset($this->productList[$key]);
			// unset($this->productListArray[$key]);
			unset($this->listId[$key]);
			if(isset($_SESSION['user'])&&isset($_SESSION['ids'])){
				try{ 
					$conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
					$conect = $conect->conect();
					$sql = sprintf("DELETE FROM productscarts WHERE productId = %d AND cartId = %d", $id, $_SESSION['ids']['cartId']);
					$stmt = $conect->prepare($sql);
					$stmt->execute();
				}catch(Exception $e){
					echo "<p>".$e->getMessage()."</p>";
				}

			}
		}
		
		
		//FUNCION CLAVE PARA AGREGAR UN NUEVO ITEM AL CARRITO. SI ESE PRODUCTO NO ESTA EN EL CARRITO, LO AGREGA, SI ESTA MODIFICA SU CANTIDAD.
		// add a new item to the cart, if the product is not there, add it if not modify its quantity.
		public function addItem($product,$qty,$write){
			if(!in_array($product->getId(),$this->listId)){
				$product->setQty($qty);
				$product->setSubTotal($qty);
				// $productArray["qty"] = $product->getQty();
				// $productArray["subTotal"] = $product->getSubTotal();
				// $this->setProductListArray($productArray);
				array_push($this->productList,$product);
				array_push($this->listId,$product->getId());
				if(isset($_SESSION['user'])&&isset($_SESSION['ids'])&&$write){
					$product->saveProduct($_SESSION['ids']['cartId']);	
				}
			} else {
				$this->qtyModify($product,$qty,$write);
			}	
		}

		//ENCUENTRA EL PRODUCTO, SETEA SU CANTIDAD, ESTABLECE EL SUBTOTAL, AL IGUAL QUE EL TOTAL Y LA CANTIDAD DE PRODUCTOS, TAMBIEN MODIFICA LA BASE DE DATOS.
		// find the product and set the quantity, set the subtotal and set the total. It also modifies the database.
		public function updateItem($id, $qty){
			$key = array_search($id, $this->listId);
			$this->productList[$key]->setQty($qty);
			$this->productList[$key]->setSubTotal();
			$this->setTotal();
			$this->setProducts();
			// $this->productListArray[$key]['qty'] = $this->productList[$key]->getQty();
			// $this->productListArray[$key]['subTotal'] = $this->productList[$key]->getSubTotal();
			if(isset($_SESSION['user'])&&isset($_SESSION['ids'])){
				$this->productList[$key]->updateProduct();	
			}
			
		}
		
		//LLAMA AL METODO DENTRO DEL OBJETO PRODUCTO PARA SUMAR O RESTAR LAS CANTIDADES DEPENDIENDO DEL VALOR DE LA CANTIDAD, DEBE ENCONTRAR EL OBJETO ANTES DE MODIFICARLO. 
		// calls the addQty object method to add or remove quantity.

		private function qtyModify ($product,$qty,$write){
			$key = array_search($product->getId(), $this->listId);
			if($this->productList[$key]->addQty($qty)<1){
				unset($this->productList[$key]);
				// unset($this->productListArray[$key]);
			}
			
			// $this->productListArray[$key]['qty'] = $this->productList[$key]->getQty();
			// $this->productListArray[$key]['subTotal'] = $this->productList[$key]->getSubTotal();
			if(isset($_SESSION['user'])&&isset($_SESSION['ids'])&&$write){
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
		// public function setProductListArray($product){array_push($this->productListArray,$product);}
		// public function getProductListArray(){return $this->productListArray;}
		public function getProductListArray(){
			$array = Array();
			foreach($this->productList as $productObject){
				$position = $productObject->convertToArray();
				array_push($array, $position);
			}
			return $array;
		}
		
		public function setProducts(){
			$productsQty = 0;
			foreach($this->productList as $product){
				$productsQty+=$product->getQty();
			}
			$this->products = $productsQty;
		}

		
		//ESTA FUNCION ACTUALIZA EL LA CANTIDAD DE PRODUCTOS Y EL TOTAL DE UN CARRITO QUE LE PASA POR ID.
		// update the quantity of products and the total of a cart.
		public function updateCart($id){
			try{ 
				$conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
				$conect = $conect->conect();
				$sql = sprintf("UPDATE carts SET products = %d,total = %g WHERE cartId = %d", $this->products, $this->total, $id);
				$stmt = $conect->prepare($sql);
				$stmt->execute();
			}catch(Exception $e){
				echo "<p>".$e->getMessage()."</p>";
			}

		}
		
		public function createCartDB($con, $id){
			$sql = sprintf( "INSERT INTO carts( userId, sale, products, total) VALUES ( %d, 0, 0, 0)",$id );
			$newCart = $con->prepare($sql);
			return $newCart;
		}
		
		public function sale($con, $id){
			$sql = sprintf( "UPDATE carts SET sale = 1 WHERE cartId = %d",$id);
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
				$sql = sprintf("INSERT INTO carts (userId, products,total) VALUES (%d,%d,%g)", $id, $this->products, $this->total);
				$stmt = $conect->prepare($sql);
				if($stmt->execute()){
					$cartId = $conect->lastInsertId();
					foreach($this->productList as $product){
						$product->saveProduct($cartId);
					}
				}
            }catch(Exception $e){
                echo "<p>".$e->getMessage()."</p>";
            }
		}

		public function showCart(){			
						foreach($this->getProductListArray() as $product){ ?>
							<tr>
								<td> <img width='60' src='./themes/images/products/upload/<?php echo $product['image1'] ?>' alt=''/></td>
								<td><?php echo $product['name'] ?></td>
								<td>
								<div class='input-append'>
									<form method='POST' action='./cart?option=qtymodify&id=<?php echo $product['productId'] ?>'>
										<input class='span1' style='max-width:34px' name='qty' placeholder='<?php echo $product['qty'] ?>' value='<?php echo $product['qty']?>'  size='16' type='number' min='0'>
										<button class='btn' type='submit'>
											<i class='icon-refresh'></i>
										</button>
										<a href='./cart?option=remove&id=<?php echo $product['productId'] ?>' class='btn btn-danger'>
										<i class='icon-remove icon-white'></i>
										</a>
									</form>
								</div>
								</td>
								<td><?php echo $product['price'] ?></td>
			
								<td><?php echo $product['subTotal'] ?></td>
							</tr>
						<?php } ?>
							<td colspan='2' style='text-align:right'><a href='./cart.php?option=cartDelete'><strong>Cart delete</strong></a></td>
							<td colspan='2' style='text-align:right'><strong>TOTAL PRICE =</strong></td>
							<td class='label label-important' style='display:block'> <strong> $<?php echo $this->total ?> </strong></td>
							</tr>
						</tbody>
			</table>
		<?php } 

		public function showReceipt(){
			foreach($this->getProductListArray() as $product){
				echo "<tr><td>".$product['qty']." x ".$product['name']."</td><td class='right'>$".$product['subTotal']."</td></tr>";
			}
			echo "<tr><td><strong  style='font-size:16px'>Total cart</strong></td><td class='right'><strong  style='font-size:16px'>$".$this->total."</strong></td></tr>";

		}

		public function cartMail($email){
			$body = "<div style='background-color: rgba(0,0,0,.8); width: 100%;'>
					<div style='background: grey; width: 100%; display: flex; justify-content: center;'>
						<img src='./themes/images/logo-250.png' style='width: 100%; max-width: 250px; width: 100%;' >
					</div>    
					<div style=' color: whitesmoke; text-align: center; padding-top: 30px;'>
						<div style='margin-bottom: -25px;'><h2>New order</h2></div>
						<div style='background-color: rgb(255, 136, 0); height: 0.5px;max-width: 250px; width: 100%; text-align: center; display: inline-block;'></div>
					</div>    
					<div style='text-align: center;'>
						<p style='max-width: 500px; width: 100%; color: whitesmoke; text-align: center; display: inline-block;'>
						You will find below details of your new order. You must pay at our location and  look for your order. Thanks!
							</p>
					</div>
					<div style='margin-top: 10px;'>
					<table style='margin: auto;margin: auto; border-spacing: 0px;'>
						<thead>
							<tr>
							<th style='color: whitesmoke; border: 0.2px solid;'>Product id</th>
							<!--<th style='color: whitesmoke; border: 0.2px solid;'>Image</th>-->
							<th style='color: whitesmoke; border: 0.2px solid;'>Product</th>
							<th style='color: whitesmoke; border: 0.2px solid;'>Quantity</th>
							<th style='color: whitesmoke; border: 0.2px solid;'>Price</th>
				
							<th style='color: whitesmoke; border: 0.2px solid;'>Total</th>
							</tr>
						</thead>
						<tbody>";

						foreach($this->getProductListArray() as $product){
							$body .= "<tr>
									<td style='color: whitesmoke; border-left: 0.2px solid; border-bottom: 0.2px solid;'>".$product['productId']."</td>
									<!--<td style='color: whitesmoke; border-left: 0.2px solid; border-bottom: 0.2px solid;'> <img width='60' src='./themes/images/products/".$product['image1']."' alt=''/></td>-->
									<td style='color: whitesmoke; border-left: 0.2px solid; border-bottom: 0.2px solid;'>".$product['name']."</td>
									<td style='color: whitesmoke; border-left: 0.2px solid; border-bottom: 0.2px solid;'>".$product['qty']."</td>
									<td style='color: whitesmoke; border-left: 0.2px solid; border-bottom: 0.2px solid;'>$".$product['price']."</td>
									<td style='width: 94px; color: whitesmoke; border-right: 0.2px solid;border-left: 0.2px solid;border-bottom: 0.2px solid;'>$".$product['subTotal']."</td>
								</tr>";
						}
						$body .=	"<tr>
										<td colspan='4' style='text-align:right; color: whitesmoke; border-left: 0.2px solid;'><strong>Order date&nbsp&nbsp</strong></td>
										<td style='color: whitesmoke; border-right: 0.2px solid;border-left: 0.2px solid;'><strong>".date("j/n/Y")." </strong></td>
										</tr>
										<tr>
										<td colspan='4' style='text-align:right; color: whitesmoke; border: 0.2px solid;'><strong>TOTAL PRICE&nbsp&nbsp </strong></td>
										<td class='label label-important' style='display:block; color: whitesmoke; border: 0.2px solid;'> <strong> $".$this->total."</strong></td>
									</tr>
									</tbody>
						</table>
						</div>
				
				
					<div style='text-align: center; height: 70px; padding-top: 30px;'>
						
					</div>
				</div>
				<div style='background-color: grey; width: 100%; display: flex; justify-content: center; '>
					<p style='max-width: 500px; width: 100%; color: whitesmoke; text-align: center; display: inline-block;'>
						HTML and CSS design by Juan Octavio Castrogiovanni
						</p>
				</div>";

				$header = "From: no-reply@" . $_SERVER["SERVER_NAME"] . "\r\n";
                $header.= "MIME-Version: 1.0" . "\r\n";
                $header.= "Content-Type: text/html; charset=utf-8" . "\r\n";

				mail( $email, "New order", $body, $header);

		}
				
	}
	?>