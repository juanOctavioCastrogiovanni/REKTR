<?php
    class Product {
      private $idProduct = NULL;
      private $name = NULL;
      private $price = NULL;
      private $brand = NULL;
      private $category = NULL;
      private $stock = NULL;
      private $short_description = NULL;
      private $description = NULL;
      private $image1 = NULL;
      private $image2 = NULL;
      private $image3 = NULL;
      private $new = 0;
      public $array = ['idProduct','name','price','brand','category','stock','short_description','description','image1','image2','image3','new'];

      public function __construct($id = NULL,$name = NULL,$price = NULL,$brand = NULL,$category = NULL,$stock = NULL,$short_description = NULL,$description = NULL,$image1 = NULL,$image2 = NULL,$image3 = NULL,$new = 0){
        $this->idProduct = $id;
        $this->name = $name;
        $this->price = $price;
        $this->brand = $brand;
        $this->category = $category;
        $this->stock = $stock;
        $this->short_description = $short_description;
        $this->description = $description;
        $this->image1 = $image1;
        $this->image2 = $image2;
        $this->image3 = $image3;
        $this->new = $new;
        }

        public function getter(){
            $array = Array();
            foreach ($this->array as $key) {
                $element = ["$key"=>$this->$key];
                array_push($array, $element);
            }

            return $array;
        }

        public function showCard(){
           echo "<li class='span2 height290'>
                    <div class='thumbnail'>
                        <a  href='product_details'><img src='themes/images/products/upload/{$this->image1}' width='200px' height='200px' alt=''/></a>
                        <div class='captqaion'>";
                        if($this->new){
                           echo "<i class='tag'></i>";
                        }
                        echo "
                        <h5>{$this->name} {$this->brand}</h5>
                        <h4 style='text-align:center'><a class='btn' href='product_details'> <i class='icon-zoom-in'></i></a> <a class='btn' href='#'>
                        Add to <i class='icon-shopping-cart'></i></a> <a class='btn btn-primary' href='#'>$".$this->price."</a></h4>
                        </div>
                    </div>
                 </li>";
        }

        public function showCardCarrousel(){
           echo "<li class='span3'>
                <div class='thumbnail'>
                  <a href='product_details'><img src='themes/images/products/upload/{$this->image1}' alt=''></a>
                  <div class='caption'>
                    <h5>{$this->name}</h5>
                    <h4><a class='btn' href='product_details'>VIEW</a> <span class='pull-right'>$".$this->price."</span></h4>
                  </div>
                </div>
              </li>";
        }

        public function showProductList(){
         echo "<div class='row'>	  
              <div class='span2'>
                <img src='themes/images/products/upload/{$this->image1}' alt=''/>
              </div>
              <div class='span4'>
                <h3>{$this->name}</h3>				
                <hr class='soft'/>
                <h5>{$this->name}</h5>
                <p>
                  {$this->short_description}
                </p>
                <a class='btn btn-small pull-right' href='product_details'>View Details</a>
                <br class='clr'/>
              </div>
              <div class='span3 alignR'>
                <form class='form-horizontal qtyFrm'>
                  <h3> {$this->price}</h3>
             
                <a href='product_details' class='btn btn-large btn-primary'> Add to <i class=' icon-shopping-cart'></i></a>
                <a href='product_details' class='btn btn-large'><i class='icon-zoom-in'></i></a>
              
                </form>
              </div>
         </div>
        <hr class='soft'/>";
        }

        public function showProduct(){
         echo "<li class='span3'>
            <div class='thumbnail'>
            <a href='product_details'><img src='themes/images/products/upload/{$this->image1}' alt=''/></a>
            <div class='caption'>
              <h5>{$this->name}</h5>
              <p> 
              Click here 
              </p>
              <h4 style='text-align:center'><a class='btn' href='product_details'> <i class='icon-zoom-in'></i></a> <a class='btn' href='#'>Add to <i class='icon-shopping-cart'></i></a> <a class='btn btn-primary' href='#'>$".$this->name."</a></h4>
            </div>
            </div>
			    </li>";
        }
    }

?>

