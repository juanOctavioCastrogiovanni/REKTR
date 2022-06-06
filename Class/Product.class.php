
<?php
    class Product {
      public $productId = NULL;
      public $name = NULL;
      public $qty = 0;
      public $subTotal = 0;
      public $price = 0;
      public $brand = NULL;
      public $category = NULL;
      public $stock = NULL;
      public $short_description = NULL;
      public $description = NULL;
      public $image1 = NULL;
      public $image2 = NULL;
      public $image3 = NULL;
      public $new = 0;
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

        public function convertToArray(){
          $productArray = array(
            "productId"=>$this->productId,
            "name"=>$this->name,
            "price"=>$this->price,
            "image1"=>$this->image1,
            "qty"=>$this->qty,
            "subTotal"=>$this->subTotal
        );
          return $productArray;
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

        // GUARDA LA ASOCICIACION EN LA TABLA PIBOT DE PRODUCTO Y CARRITO.
        // save a new asociation between products and carts. 
        public function saveProduct($id){
                try{ 
                    $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
                    $conect = $conect->conect();
                    $sql = sprintf("INSERT INTO productsCarts (productId, cartId, qty, subtotal) VALUES (%d,%d,%d,%g)", $this->productId, $id, $this->qty, $this->subTotal);
                    $stmt = $conect->prepare($sql);
                    $stmt->execute();
                }catch(Exception $e){
                    echo "<p><?php echo $e->getMessage() ?></p>";
                }
       }

        // PARA HACER LA ACTUALIZACION DEL PRODUCTO, UTILIZA LOS ATRIBUTOS INTERNOS.
        // uses internal attributes of the object itself to update.     
        public function updateProduct(){
                try{ 
                    $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
                    $conect = $conect->conect();
                    $sql = sprintf("UPDATE productsCarts SET qty = %d,subtotal = %g WHERE productId = %d AND cartId = %d", $this->qty, $this->subTotal, $this->productId,$_SESSION['ids']['cartId']);
                    $stmt = $conect->prepare($sql);
                    $stmt->execute();
                }catch(Exception $e){
                    echo "<p><?php echo $e->getMessage() ?></p>";
                }
              
       }

      //  ESTAS FUNCIONES SE UTILIZAN EN LA PAGINA PRINCIPAL PARA MOSTRAR TODOS LOS PRODUCTOS
      // this functions use to main page for show all products.
       public function showProductsCart(){
        ?>
              <tr>
                  <td> <img width='60' src='./themes/images/products/upload/<?php echo $this->image1 ?>' alt=''/></td>
                  <td><?php echo $this->name ?><br/>brand : <?php echo $this->brand ?></td>
                  <td>
                    <div class='input-append'><input class='span1' style='max-width:34px' placeholder='1'  size='16' type='text'><button class='btn' type='button'><i class='icon-minus'></i></button><button class='btn' type='button'><i class='icon-plus'></i></button><button class='btn btn-danger' type='button'><i class='icon-remove icon-white'></i></button>				</div>
                  </td>
                  <td><?php echo $this->price?></td>

                  <td><?php echo $this->subotal?></td>
                </tr>
              
      <?php }

        public function showCard(){
          ?>
           <li class='span2 heightCard span-sm-card1'>
                    <div class='thumbnail'>
                        <a  href='product_details?id=<?php echo $this->productId ?>'><img src='themes/images/products/upload/<?php echo $this->image1 ?>' width='200px' height='200px' alt=''/></a>
                        <div class='caption'>
                        <?php if($this->new){
                           echo "<i class='tag'></i>";
                        }?>
                      <h5><?php echo $this->name ?> &nbsp
                          <?php echo $this->brand ?></h5>
                        <h4 style='text-align:center'>
                        <form method='POST' action='cart.php' style='display: inline;'>
                          <input type='hidden' name='productId' value='<?php echo $this->productId ?>'>
                          <input type='hidden' name='name' value='<?php echo $this->name ?>'>
                          <input type='hidden' name='price' value='<?php echo $this->price ?>'>
                          <input type='hidden' name='image1' value='<?php echo $this->image1 ?>'>
                          <input type='hidden' name='qty' value='1'>
                          <button class='btn' type='submit'><i class='icon-shopping-cart'></i></button>
                        </form>
                        <a class='btn btn-primary'>$ <?php echo $this->price ?></a></h4>
                        </div>
                    </div>
                 </li>
          <?php
        }

        public function showCardCarrousel(){
        ?>
           <li class='span6 span-sm-card'>
                <div class='thumbnail heightCard1'>
                  <a href='product_details?id=<?php echo $this->productId ?>'><img src='themes/images/products/upload/<?php echo $this->image1 ?>' alt=''></a>
                  <div class='caption'>
                  <?php if($this->new){
                    echo "<i class='tag'></i>";
                 } ?>
                  <h5><?php echo $this->name ?></h5>
                    <h4><a class='btn' href='product_details?id=<?php $this->productId ?>'>VIEW</a> <span class='pull-right'>$<?php echo $this->price ?></span></h4>
                  </div>
                </div>
              </li>
        <?php } 

        public function showProductList(){
        ?>
            <div class='row'>	  
              <div class='span2'>
                <img  style='width: 72%;margin-left: 16%;' src='themes/images/products/upload/<?php echo $this->image1 ?>' alt=''/>
              </div>
              <div class='span4'>
                <h3><?php echo $this->name ?></h3>				
                <hr class='soft'/>
                <h5><?php echo $this->brand ?></h5>
                <p>
                  <?php echo $this->short_description ?>
                </p>
                <a class='btn btn-small pull-right' href='product_details?id=<?php echo $this->productId ?>'>View Details</a>
                <br class='clr'/>
              </div>
              <div class='span3 alignR'>

                  <h3>$<?php echo $this->price ?>"</h3>
             
              <form method='POST' action='cart.php' style='display: inline;'>
                <input type='hidden' name='productId' value='<?php echo $this->productId ?>'>
                <input type='hidden' name='name' value='<?php echo $this->name ?>'>
                <input type='hidden' name='price' value='<?php echo $this->price ?>'>
                <input type='hidden' name='image1' value='<?php echo $this->image1 ?>'>
                <input type='hidden' name='qty' value='1'>
                <button class='btn btn-large btn-primary' type='submit'>Add to <i class='icon-shopping-cart'></i></button>
              </form>
                <a href='product_details?id=<?php echo $this->productId ?>' class='btn btn-large'><i class='icon-zoom-in'></i></a>
             </div>
         </div>
        <hr class='soft'/>
        <?php } 

        public function showProduct(){
        ?>
          <li class='span2 span-sm-card1 cart-height'>
            <div class='thumbnail'>
              <a href='product_details?id=<?php echo $this->productId ?>'><img src='themes/images/products/upload/<?php echo $this->image1 ?>' alt=''/></a>
              <div class='caption'>
                <h5><?php echo $this->name; ?> &nbsp
                         <?php echo $this->brand ?></h5>
                <h4 style='text-align:center'>
                <form method='POST' action='cart.php' style='display: inline;'>
                  <input type='hidden' name='productId' value='<?php echo $this->productId ?>'>
                  <input type='hidden' name='name' value='<?php echo $this->name ?>'>
                  <input type='hidden' name='price' value='<?php echo $this->price ?>'>
                  <input type='hidden' name='image1' value='<?php echo $this->image1 ?>'>
                  <input type='hidden' name='qty' value='1'>
                <button class='btn' type='submit'><i class='icon-shopping-cart'></i></button>
              </form> <a class='btn btn-primary' href='#'>$<?php echo $this->price ?></a></h4>
              </div>
            </div>
			    </li>
        <?php }

        public function showProductDetails(){ ?>
            <div class='row'>
                    <div id='gallery' class='span3 picture'>
                      <a href='themes/images/products/upload/<?php echo $this->image1 ?>' title='<?php echo $this->image1 ?>'>
                        <img src='themes/images/products/upload/<?php echo $this->image1 ?>' style='width:100%'
                          alt='<?php echo $this->image1 ?>' />
                      </a>
                      <div id='differentview' class='moreOptopm carousel slide picture'>
                        <div class='carousel-inner'>
                          <div class='item active'>
                            <a href='themes/images/products/upload/<?php echo $this->image1 ?>'> <img style='width:29%'
                                src='themes/images/products/upload/<?php echo $this->image1 ?>' alt='' /></a>
                            <?php if($this->image2){
                             echo "<a href='themes/images/products/upload/<?php echo $this->image2 ?>'> <img style='width:29%'
                                  src='themes/images/products/upload/<?php echo $this->image2 ?>' alt='' /></a>";
                            }
                            if($this->image3){
                             echo "<a href='themes/images/products/upload/<?php echo $this->image3 ?>'> <img style='width:29%'
                                  src='themes/images/products/upload/<?php echo $this->image3 ?>' alt='' /></a>";
                            } ?>
                         </div>
                          <div class='item'>
                          <?php if($this->image3){
                            echo "<a href='themes/images/products/upload/<?php echo $this->image3 ?>'> <img style='width:29%'
                                 src='themes/images/products/upload/<?php echo $this->image3 ?>' alt='' /></a>";
                           }
                            echo "<a href='themes/images/products/upload/<?php echo $this->image1 ?>'> <img style='width:29%'
                                src='themes/images/products/upload/<?php echo $this->image1 ?>' alt='' /></a>";
                          
                          if($this->image2){
                            echo "<a href='themes/images/products/upload/<?php echo $this->image2 ?>'> <img style='width:29%'
                            src='themes/images/products/upload/<?php echo $this->image2 ?>' alt='' /></a>";
                          }?>
                            
                          </div>
                        </div>
                        
                      </div>


                    </div>
                    <div class='span6'>
                      <h3><?php echo $this->name ?> </h3>
                      <hr class='soft' />
                      <form class='form-horizontal qtyFrm' method='POST' action='cart.php'>
                      <input type='hidden' name='productId' value='<?php echo $this->productId ?>'>
                      <input type='hidden' name='name' value='<?php echo $this->name ?>'>
                      <input type='hidden' name='price' value='<?php echo $this->price ?>'>
                      <input type='hidden' name='image1' value='<?php echo $this->image1 ?>'>
                        <div class='control-group'>
                          <label class='control-label'><span><?php echo $this->price ?></span></label>
                          <div class='controls'>
                            <input type='number' name='qty' class='span1' placeholder='Qty.' value='1' min='1'/>
                            <button type='submit' class='btn btn-large btn-primary pull-right margin16'> Add to cart <i
                                class=' icon-shopping-cart'></i></button>
                          </div>
                        </div>
                      </form>

                      <hr class='soft' />
                      <h4>Available stock today <br> Stock: <?php echo $this->stock ?></h4>
                      <hr class='soft clr' />
                      <p>
                        <?php echo $this->short_description?>
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
                                <td class='techSpecTD2'><?php echo $this->brand ?></td>
                              </tr>
                              <tr class='techSpecRow'>
                                <td class='techSpecTD1'>Model:</td>
                                <td class='techSpecTD2'><?php echo $this->name ?></td>
                              </tr>
                              </tbody>
                          </table>

                          <h5>Features</h5>
                         
                          <h4><?php echo $this->name ?></h4>
                          <h5>Manufacturer's Description </h5>
                          <p>
                          <?php echo $this->description ?>
                          </p>
                        </div>
                        
        <?php }

        public function showRelatedProduct(){ ?>
                             <div class='row'>
                                <div class='span2 span-sm-card1'>
                                  <img src='themes/images/products/upload/<?php echo $this->image1 ?>' alt='' />
                                </div>
                                <div class='span4'>
                                  <h3><?php echo $this->name ?></h3>
                                  <hr class='soft' />
                                  <h5><?php echo $this->brand ?></h5>
                                  <p>
                                    <?php echo $this->short_description ?>
                                  </p>
                                  <a class='btn btn-small pull-right' href='product_details?id=<?php echo $this->productId ?>'>View
                                    Details</a>
                                  <br class='clr' />
                                </div>
                                <div class='span3 alignR'>
                                  <form class='form-horizontal qtyFrm'>
                                    <h3>$<?php echo  $this->price ?></h3>
                                    <br />
                                    <div class='btn-group'>
                                      <a href='product_details?id=<?php echo $this->productId ?>' class='btn btn-large btn-primary'> Add
                                        to <i class=' icon-shopping-cart'></i></a>
                                      <a href='product_details?id=<?php echo $this->productId ?>' class='btn btn-large'><i
                                          class='icon-zoom-in'></i></a>
                                    </div>
                                  </form>
                                </div>
                              </div>
                              <hr class='soft' />
        <?php }

        public function showRelatedProductList(){ ?>
            <li class='span3 span-sm-card1 show-card'>
                  <div class='thumbnail'>
                    <a href='product_details?id=<?php echo $this->productId ?>'><img src='themes/images/products/upload/<?php echo $this->image1 ?>'
                        alt='' /></a>
                    <div class='caption'>
                      <h5><?php echo $this->name;
                                echo $this->brand ?></h5>
                      <h4 style='text-align:center'><a class='btn'
                          href='product_details?id=<?php echo $this->productId ?>'> <i class='icon-zoom-in'></i></a>
                        <a class='btn' href='#'>Add to <i
                            class='icon-shopping-cart'></i></a> <a
                          class='btn btn-primary' href='#'>$<?php echo $this->price ?></a></h4>
                    </div>
                  </div>
                </li> <?php
        }

        
    }

?>

