
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
    
</div>
<!-- Sidebar end=============================================== -->

