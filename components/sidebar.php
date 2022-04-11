
<!-- Sidebar ================================================== -->

<div id="sidebar" class="span3">
    <div class="well well-small"><a id="myCart" href="product_summary"><img src="themes/images/ico-cart.png" alt="cart">3 Items in your cart  <span class="badge badge-warning pull-right">$155.00</span></a></div>
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
        <li class="subMenu open"><a> ELECTRONICS</a>
            <ul>
            <?php 
            try {
                $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
                $conect = $conect->conect();
                $query = "SELECT *  FROM categories";
                $categories = $conect->prepare($query);
                $categories->execute();
                foreach ($categories->fetchAll(PDO::FETCH_ASSOC) as $category){
                    echo "<li><a href='products?category=".$category['idCategory']."'><i class='icon-chevron-right'></i>".$category['name']."</a></li>";
                }
            }catch(Exception $e){
              echo "<p>".$e->getMessage()."</p>";
            }

            ?>
            </ul>
        </li>
    </ul>

    
    
    <?php if(isset($isProducts)){
       echo "
                <form action='' method='GET' style='margin-top:30px;'>
                <input style='width:30%;' class='form-control form-control-sm' type='text' aria-label='.form-control-sm example' name='min' placeholder='price min'>
                <input style='width:30%;' class='form-control form-control-sm' type='text' aria-label='.form-control-sm example' name='max' placeholder='price max'>";
                    if($categ!=''){
                        echo "<input type='hidden' name='category' value='$categ'>";
                    }
                    if($sort!=NULL){
                        echo "<input type='hidden' name='sort' value='$sort'>";
                    }
               echo "<br><button type='submit' class='btn btn-dark'>Price filter</button>
                </form>";

        echo "
        <form action='' method='GET' style='margin-top:30px;'>
            <select class='form-select' aria-label='Default select example' name='sort'>
                <option value='asc' selected>Price min</option>
                <option value='desc'>Price max</option>
            </select>";
            if($categ!=''){
                echo "<input type='hidden' name='category' value='$categ'>";
            }
            if($min!=NULL){
                echo "<input type='hidden' name='category' value='$categ'>";
            }
            if($max!=NULL){
                echo "<input type='hidden' name='category' value='$categ'>";
            }

          echo "<br><button type='submit' class='btn btn-dark'>Sort</button>
        </form>";

      if($categ!=''||$max!=NULL||$min!=NULL||$sort!=NULL){  
        if($min==NULL||$max==NULL){
            if($min!=NULL){
                echo "<div class='alert alert-dark' role='alert'>
                         Min: $min
                     </div>";
            }
            if($max!=NULL){
                echo "<div class='alert alert-dark' role='alert'>
                         Max: $max
                     </div>";
            }
        } else if($min!=NULL&&$max!=NULL){
            echo "<div class='alert alert-dark' role='alert'>
                Min: $min and Max:$max
            </div>";
        }



        echo "<form action='' method='GET' style='margin-top:30px;'>
                <br><button type='submit' class='btn btn-danger'>delete filter</button>
            </form>";
      }
    }
    ?>

<!-- 
  <div class="row" style="margin-top:30px">
    <div class="col-sm-12">
      <div id="slider-range"></div>
    </div>
  </div>
  <div class="row slider-labels">
    <div class="col-xs-6 caption">
      <strong>Min:</strong> <span id="slider-range-value1"></span>
    </div>
    <div class="col-xs-6 text-right caption">
      <strong>Max:</strong> <span id="slider-range-value2"></span>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form>
        <input type="hidden" name="min" value="">
        <input type="hidden" name="max" value="">
      </form>
    </div>
  </div> -->



</div>

<!-- Sidebar end=============================================== -->

