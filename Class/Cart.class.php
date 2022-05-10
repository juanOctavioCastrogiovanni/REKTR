<?php
	class Cart
	{
		private $productList = [];
		private $listId = [];
		private $total = 0;
		private $products = 0;
		private $sale = 0;

		public function cartDelete(){$this->productList = [];}

		public function addItem($product,$qty){
			//Este if no funciona, nunca encuentra el producto que ya existe dentro del carrito, por ende agrega el mismo muchas veces.
			if(!in_array($product->getId(),$this->listId)){
				$product->setQty($qty);
				$product->setSubTotal($qty);
				array_push($this->productList,$product);
				array_push($this->listId,$product->getId());
			} else {
				$this->qtyModify($product,$qty);
			}	
		}
		
		private function qtyModify ($product,$qty){
			$key = array_search($product->getId(), $this->listId);
			if($this->productList[$key]->addQty($qty)<1){
				unset($this->productList[$key]);
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

		public function setProducts(){
			$productsQty = 0;
			foreach($this->productList as $product){
				$productsQty+=$product->getQty();
			}
			$this->products = $productsQty;
		}

		public function removeItem($product){array_push($this->productList,$product);}

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
			// falta hacer una consulta que traiga todos los productos asociados con el carrito que ya estaba creado en DB
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

	}
	?>
	<!-- INSERT INTO carts( userId, sale, products, total) VALUES ( ':userId', 1, 0, 0); -->