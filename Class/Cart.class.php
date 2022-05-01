<?php

	class Cart
	{
		private $productList = [];
		private $total = 0;
		private $products = 0;

		public function cartDelete(){$this->productList = [];}

		public function addItem($product,$qty){
			//Este if no funciona, nunca encuentra el producto que ya existe dentro del carrito, por ende agrega el mismo muchas veces.
			if(!in_array($product,$this->productList)){
				$product->setQty($qty);
				$product->setSubTotal($qty);
				array_push($this->productList,$product);
			} else {
				$this->qtyModify($product,$qty);
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

		public function getProductList(){
			return $this->productList;
		}

		public function setProducts(){
			$productsQty = 0;
			foreach($this->productList as $product){
				$productsQty+=$product->getQty();
			}
			$this->products = $productsQty;
		}

		public function removeItem($product){
			array_push($this->productList,$product);
		}


		private function qtyModify ($product,$qty){
			$key = array_search($product, $this->productList);
			if($this->getProductList[$key]->addQty($qty)<1){
				unset($this->getProductList[$key]);
			}
		}

	}
?>