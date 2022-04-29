
<!-- userMenu ================================================== -->

<div id="sidebar" class="span3">
    <div class="well well-small"><a id="myCart" href="product_summary"><img src="<?php echo $point ?>/themes/images/ico-cart.png" alt="cart">3 Items in your cart  <span class="badge badge-warning pull-right">$155.00</span></a></div>
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
        <li class="subMenu open" ><a> User options</a>
            <ul>
              <li><a href='panel?action=userDetails' <?php if($option==1){echo "class='btn bttn'";} ?>><i class='icon-chevron-right'></i>User details</a></li>
              <li><a href='panel?action=orderList' <?php if($option==2){echo "class='btn bttn'";} ?>><i class='icon-chevron-right'></i>Order list</a></li>
              <li><a href='panel?action=passwordChange' <?php if($option==3){echo "class='btn bttn'";} ?>><i class='icon-chevron-right'></i>Password change</a></li>
              <li><a href='panel?action=accountDelete' <?php if($option==4){echo "class='btn bttn'";} ?> style="color:red;"><i class='icon-chevron-right'></i>Account delete</a></li>
            </ul>
        </li>
    </ul>

 
</div>

<!-- userMenu=============================================== -->

