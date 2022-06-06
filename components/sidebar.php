
<!-- Sidebar ================================================== -->

<div id="sidebar" class="span3" style="padding-bottom: 21px;">
    <div class="well well-small"><a id="myCart" href="<?php echo $point ?>/product_summary"><img src="<?php echo $point ?>/themes/images/ico-cart.png" alt="cart"><?php if(isset($_SESSION['cartArray'])){echo $_SESSION['cartArray']['products'];}else{echo 0;}  ?> Items in your cart  <span class="badge badge-warning pull-right">$<?php if(isset($_SESSION['cartArray'])){echo $_SESSION['cartArray']['total'];}else{echo 0;}  ?></span></a></div>
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
        <li class="subMenu"><a> Chooise a category</a>
            <ul style="display:none;">
            <?php 
            try {
                $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
                $conect = $conect->conect();
                $query = "SELECT *  FROM categories";
                $categories = $conect->prepare($query);
                $categories->execute();
                foreach ($categories->fetchAll(PDO::FETCH_ASSOC) as $category){
                    echo "<li><a href='products?category=".$category['categoryId']."'><i class='icon-chevron-right'></i>".$category['name']."</a></li>";
                }
            }catch(Exception $e){
              echo "<p>".$e->getMessage()."</p>";
            }

            ?>
            </ul>
        </li>
    </ul>

    
    
    <?php if(isset($isProducts)){ ?>
        <form action='' method='GET' style='margin-top:30px;'>
                <input style='width:30%;' class='form-control form-control-sm' type='text' aria-label='.form-control-sm example' name='min' placeholder='price min'>
                <input style='width:30%;' class='form-control form-control-sm' type='text' aria-label='.form-control-sm example' name='max' placeholder='price max'>";
        <?php if($categ!=''){
                        echo "<input type='hidden' name='category' value='$categ'>";
                    }
                    if($sort!=NULL){
                        echo "<input type='hidden' name='sort' value='$sort'>";
                    } ?>
                  <br><button type='submit' class='btn btn-dark'>Price filter</button>
                </form>
        <form action='' method='GET' style='margin-top:30px;'>
            <select class='form-select' style='width: 70%;' aria-label='Default select example' name='sort'>
                <option value='asc' $asc>Price min</option>
                <option value='desc' $desc>Price max</option>
            </select>
        <?php if($categ!=''){
                echo "<input type='hidden' name='category' value='$categ'>";
            }
            if($min!=NULL){
                echo "<input type='hidden' name='category' value='$categ'>";
            }
            if($max!=NULL){
                echo "<input type='hidden' name='category' value='$categ'>";
            } ?>           
            <br><button type='submit' class='btn btn-dark'>Sort</button>
        </form> <?php
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
        } ?>  


      <form action='' method='GET' style='margin-top:30px;'>
                <br><button type='submit' class='btn btn-danger'>delete filter</button>
            </form>
    <?php }
    } ?>

</div>

<!-- Sidebar end=============================================== -->

