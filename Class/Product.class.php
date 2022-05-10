
<?php
    class Product {
      private $productId = NULL;
      private $name = NULL;
      private $qty = 0;
      private $subTotal = 0;
      private $price = 0;
      private $brand = NULL;
      private $category = NULL;
      private $stock = NULL;
      private $short_description = NULL;
      private $description = NULL;
      private $image1 = NULL;
      private $image2 = NULL;
      private $image3 = NULL;
      private $new = 0;
      public $array = ['productId','name','price','brand','category','stock','short_description','description','image1','image2','image3','new'];

      public function getPrice(){return $this->price;}
      public function getId(){return $this->productId;}

      public function __construct($id = NULL,$name = NULL,$price = 0,$brand = NULL,$category = NULL,$stock = 0,$short_description = NULL,$description = NULL,$image1 = NULL,$image2 = NULL,$image3 = NULL,$new = 0){
        $this->productId = $id;
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

        public function addQty($qty){
          $this->qty += $qty;
          if ($this->qty<0){
            $this->qty = 0;
          }
          $this->setSubTotal();
          return $this->qty;
        }

        public function setImage($image){
          $this->image1 = $image;
        }

        public function setQty($qty){
          $this->qty = $qty;
        }

        public function getQty(){
          return $this->qty;
        }

        public function setSubTotal(){
          $this->subTotal = $this->qty * $this->price; 
        }
        
        public function getSubTotal(){
          return $this->subTotal;
        }

        public function getter(){
            $array = Array();
            foreach ($this->array as $key) {
                $element = ["$key"=>$this->$key];
                array_push($array, $element);
            }

            return $array;
        }

        public function saveProduct($id){
                try{ 
                    $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
                    $conect = $conect->conect();
                }catch(Exception $e){
                    echo "<p>".$e->getMessage()."</p>";
                }
    
              $sql = sprintf("INSERT INTO productsCarts (productId, cartId, qty, subtotal) VALUES (%d,%d,%d,%g)", $this->productId, $id, $this->qty, $this->subTotal);
              $stmt = $conect->prepare($sql);
              $stmt->execute();
       }

        public function showCard(){
           echo "<li class='span2 height290'>
                    <div class='thumbnail'>
                        <a  href='product_details?id={$this->productId}'><img src='themes/images/products/upload/{$this->image1}' width='200px' height='200px' alt=''/></a>
                        <div class='caption'>";
                        if($this->new){
                           echo "<i class='tag'></i>";
                        }
                        echo "
                        <h5>{$this->name} {$this->brand}</h5>
                        <h4 style='text-align:center'><a class='btn' href='product_details'> <i class='icon-zoom-in'></i></a> 
                        <form method='POST' action='cart.php' style='display: inline;'>
                          <input type='hidden' name='productId' value='".$this->productId."'>
                          <input type='hidden' name='name' value='".$this->name."'>
                          <input type='hidden' name='price' value='".$this->price."'>
                          <input type='hidden' name='image1' value='".$this->image1."'>
                          <input type='hidden' name='qty' value='1'>
                          <button class='btn' type='submit'>Add to <i class='icon-shopping-cart'></i></button>
                        </form>
                        <a class='btn btn-primary'>$".$this->price."</a></h4>
                        </div>
                    </div>
                 </li>";
        }

        public function showCardCarrousel(){
           echo "<li class='span3'>
                <div class='thumbnail'>
                  <a href='product_details?id={$this->productId}'><img src='themes/images/products/upload/{$this->image1}' alt=''></a>
                  <div class='caption'>";
                  if($this->new){
                    echo "<i class='tag'></i>";
                 }
                  echo "<h5>{$this->name}</h5>
                    <h4><a class='btn' href='product_details?id={$this->productId}'>VIEW</a> <span class='pull-right'>$".$this->price."</span></h4>
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
                <h5>{$this->brand}</h5>
                <p>
                  {$this->short_description}
                </p>
                <a class='btn btn-small pull-right' href='product_details?id={$this->productId}'>View Details</a>
                <br class='clr'/>
              </div>
              <div class='span3 alignR'>

                  <h3>$".$this->price."</h3>
             
              <form method='POST' action='cart.php' style='display: inline;'>
                <input type='hidden' name='productId' value='".$this->productId."'>
                <input type='hidden' name='name' value='".$this->name."'>
                <input type='hidden' name='price' value='".$this->price."'>
                <input type='hidden' name='image1' value='".$this->image1."'>
                <input type='hidden' name='qty' value='1'>
                <button class='btn btn-large btn-primary' type='submit'>Add to <i class='icon-shopping-cart'></i></button>
              </form>
                <a href='product_details?id={$this->productId}' class='btn btn-large'><i class='icon-zoom-in'></i></a>
              
                
              </div>
         </div>
        <hr class='soft'/>";
        }

        public function showProduct(){
         echo "<li class='span2'>
            <div class='thumbnail'>
              <a href='product_details?id={$this->productId}'><img src='themes/images/products/upload/{$this->image1}' alt=''/></a>
              <div class='caption'>
                <h5>{$this->name} {$this->brand}</h5>
                <h4 style='text-align:center'><a class='btn' href='product_details?id={$this->productId}'> <i class='icon-zoom-in'></i></a>  <form method='POST' action='cart.php' style='display: inline;'>
                <input type='hidden' name='productId' value='".$this->productId."'>
                <input type='hidden' name='name' value='".$this->name."'>
                <input type='hidden' name='price' value='".$this->price."'>
                <input type='hidden' name='image1' value='".$this->image1."'>
                <input type='hidden' name='qty' value='1'>
                <button class='btn' type='submit'>Add to <i class='icon-shopping-cart'></i></button>
              </form> <a class='btn btn-primary' href='#'>$".$this->price."</a></h4>
              </div>
            </div>
			    </li>";
        }

        public function showProductDetails(){
            echo  "<div class='row'>
                    <div id='gallery' class='span3'>
                      <a href='themes/images/products/upload/{$this->image1}' title='{$this->image1}'>
                        <img src='themes/images/products/upload/{$this->image1}' style='width:100%'
                          alt='{$this->image1}' />
                      </a>
                      <div id='differentview' class='moreOptopm carousel slide'>
                        <div class='carousel-inner'>
                          <div class='item active'>
                            <a href='themes/images/products/upload/{$this->image1}'> <img style='width:29%'
                                src='themes/images/products/upload/{$this->image1}' alt='' /></a>";
                            if($this->image2){
                             echo "<a href='themes/images/products/upload/{$this->image2}'> <img style='width:29%'
                                  src='themes/images/products/upload/{$this->image2}' alt='' /></a>";
                            }
                            if($this->image3){
                             echo "<a href='themes/images/products/upload/{$this->image3}'> <img style='width:29%'
                                  src='themes/images/products/upload/{$this->image3}' alt='' /></a>";
                            }
                          echo "</div>
                          <div class='item'>";
                          if($this->image3){
                            echo "<a href='themes/images/products/upload/{$this->image3}'> <img style='width:29%'
                                 src='themes/images/products/upload/{$this->image3}' alt='' /></a>";
                           }
                            echo "<a href='themes/images/products/upload/{$this->image1}'> <img style='width:29%'
                                src='themes/images/products/upload/{$this->image1}' alt='' /></a>";
                          
                          if($this->image2){
                            echo "<a href='themes/images/products/upload/{$this->image2}'> <img style='width:29%'
                            src='themes/images/products/upload/{$this->image2}' alt='' /></a>";
                          }
                            
                          echo "</div>
                        </div>
                        <!--  
                       <a class='left carousel-control' href='#myCarousel' data-slide='prev'>‹</a>
                        <a class='right carousel-control' href='#myCarousel' data-slide='next'>›</a> 
                  -->
                      </div>


                    </div>
                    <div class='span6'>
                      <h3>{$this->name} </h3>
                      <hr class='soft' />
                      <a href='./cart.php?b=0'>BORRAR</a>
                      <form class='form-horizontal qtyFrm' method='POST' action='cart.php'>
                      <input type='hidden' name='productId' value='".$this->productId."'>
                      <input type='hidden' name='name' value='".$this->name."'>
                      <input type='hidden' name='price' value='".$this->price."'>
                      <input type='hidden' name='image1' value='".$this->image1."'>
                        <div class='control-group'>
                          <label class='control-label'><span>".$this->price."</span></label>
                          <div class='controls'>
                            <input type='number' name='qty' class='span1' placeholder='Qty.' value='1' min='1'/>
                            <button type='submit' class='btn btn-large btn-primary pull-right'> Add to cart <i
                                class=' icon-shopping-cart'></i></button>
                          </div>
                        </div>
                      </form>

                      <hr class='soft' />
                      <h4>Available stock today <br> Stock: {$this->stock}</h4>
                      <hr class='soft clr' />
                      <p>
                        {$this->short_description}
                      </p>
                      <a class='btn btn-small pull-right' href='#detail'>More Details</a>
                      <br class='clr' />
                      <a href='#' name='detail'></a>
                      <hr class='soft' />
                    </div>

                    <div class='span9'>
                      <ul id='productDetail' class='nav nav-tabs'>
                        <li class='active'><a href='#home' data-toggle='tab'>Product Details</a></li>
                        <li><a href='#profile' data-toggle='tab'>Related Products</a></li>
                      </ul>
                      <div id='myTabContent' class='tab-content'>
                        <div class='tab-pane fade active in' id='home'>
                          <h4>Product Information</h4>
                          <table class='table table-bordered'>
                            <tbody>
                              <tr class='techSpecRow'>
                                <th colspan='2'>Product Details</th>
                              </tr>
                              <tr class='techSpecRow'>
                                <td class='techSpecTD1'>Brand: </td>
                                <td class='techSpecTD2'>{$this->brand}</td>
                              </tr>
                              <tr class='techSpecRow'>
                                <td class='techSpecTD1'>Model:</td>
                                <td class='techSpecTD2'>{$this->name}</td>
                              </tr>
                              </tbody>
                          </table>

                          <h5>Features</h5>
                         
                          <h4>{$this->name}</h4>
                          <h5>Manufacturer's Description </h5>
                          <p>
                          {$this->description}
                          </p>
                        </div>";
                        
        }

        public function showRelatedProduct(){
                             echo "<div class='row'>
                                <div class='span2'>
                                  <img src='themes/images/products/upload/{$this->image1}' alt='' />
                                </div>
                                <div class='span4'>
                                  <h3>{$this->name}</h3>
                                  <hr class='soft' />
                                  <h5>{$this->brand} </h5>
                                  <p>
                                    {$this->short_description}
                                  </p>
                                  <a class='btn btn-small pull-right' href='product_details?id={$this->productId}'>View
                                    Details</a>
                                  <br class='clr' />
                                </div>
                                <div class='span3 alignR'>
                                  <form class='form-horizontal qtyFrm'>
                                    <h3>$". $this->price."</h3>
                                    <br />
                                    <div class='btn-group'>
                                      <a href='product_details?id={$this->productId}' class='btn btn-large btn-primary'> Add
                                        to <i class=' icon-shopping-cart'></i></a>
                                      <a href='product_details?id={$this->productId}' class='btn btn-large'><i
                                          class='icon-zoom-in'></i></a>
                                    </div>
                                  </form>
                                </div>
                              </div>
                              <hr class='soft' />";
        }

        public function showRelatedProductList(){
            echo "<li class='span3'>
                  <div class='thumbnail'>
                    <a href='product_details?id={$this->productId}'><img src='themes/images/products/upload/{$this->image1}'
                        alt='' /></a>
                    <div class='caption'>
                      <h5>{$this->name} {$this->brand}</h5>
                      <h4 style='text-align:center'><a class='btn'
                          href='product_details?id={$this->productId}'> <i class='icon-zoom-in'></i></a>
                        <a class='btn' href='#'>Add to <i
                            class='icon-shopping-cart'></i></a> <a
                          class='btn btn-primary' href='#'>$".$this->price."</a></h4>
                    </div>
                  </div>
                </li>";
        }

        
    }

?>

