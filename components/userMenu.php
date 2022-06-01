
<!-- userMenu ================================================== -->

<div id="sidebar" class="span3">
<div class="well well-small"><a id="myCart" href="<?php echo $point ?>/product_summary"><img src="<?php echo $point ?>/themes/images/ico-cart.png" alt="cart"><?php if(isset($_SESSION['cartArray'])){echo $_SESSION['cartArray']['products'];}else{echo 0;}  ?> Items in your cart  <span class="badge badge-warning pull-right">$<?php if(isset($_SESSION['cartArray'])){echo $_SESSION['cartArray']['total'];}else{echo 0;}  ?></span></a></div>
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
        <li class="subMenu open" ><a> User options</a>
            <ul>
              <li><a href='panel?action=userDetails'><i class='icon-chevron-right'></i>User details</a></li>
              <li><a href='panel?action=orderList'><i class='icon-chevron-right'></i>Order list</a></li>
              <li><a href='panel?action=passwordChange'><i class='icon-chevron-right'></i>Password change</a></li>
              <li><a href='panel?action=accountDelete' style="color:red;"><i class='icon-chevron-right'></i>Account delete</a></li>
            </ul>
        </li>
    </ul>

 
</div>

<!-- userMenu=============================================== -->

