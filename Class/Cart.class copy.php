<?php

	class Cart
	{
		private $productList = [];
		private $total = 0;
		private $qty = 0;

		public function addItem($product){
			if(!in_array($product,$this->productList)){
				array_push($this->productList,$product);
			} else {
				if (($key = array_search($product, $this->productList)) !== false) {
					$arr[$key]->setQty(1);
				}
			}
		}

		public function getProductList(){
			return $this->productList;
		}

		public function getQty(){
			$this->qty = count($this->productList);
			return $this->qty;
		}

		public function removeItem($product){
			array_push($this->productList,$product);
		}


		private function remover_simple ($value,$arr){
			if (($key = array_search($value, $arr)) !== false) {
				unset($arr[$key]);
			}
			return $arr;
		}

	}
?>