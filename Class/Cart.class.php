<?php

	class Cart
	{
		private $productList = [];
		private $idList = [];
		private $total = 0;
		private $products = 0;
		private $sale = 0;

		public function cartDelete(){$this->productList = [];}

		public function addItem($product,$qty){
			//Este if no funciona, nunca encuentra el producto que ya existe dentro del carrito, por ende agrega el mismo muchas veces.
			if(!in_array($product->getId(),$this->idList)){
				$product->setQty($qty);
				$product->setSubTotal($qty);
				array_push($this->productList,$product);
				array_push($this->idList,$product->getId());
			} else {
				$this->qtyModify($product,$qty);
			}	
		}
		
		private function qtyModify ($product,$qty){
			$key = array_search($product->getId(), $this->idList);
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

	}
	?>
	<!-- INSERT INTO carts( userId, sale, products, total) VALUES ( ':userId', 1, 0, 0); -->