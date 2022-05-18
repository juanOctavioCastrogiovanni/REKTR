<?php
	include "./components/header.php";
	

	
?>
<div id="mainBody">
	<div class="container">
	<div class="row">
<?php
	include "./components/sidebar.php";
    if(isset($_SESSION['Cart'])&&$_SESSION['Cart']->getTotal()>0&&isset($_SESSION['Cart'])&&isset($_SESSION['ids'])){
        try{ 
            $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
            $conect = $conect->conect();
        }catch(Exception $e){
            echo "<p>".$e->getMessage()."</p>";
        }
        $cartId = $_SESSION['ids']['cartId'];
        $sale = $_SESSION['Cart']->sale($conect, $_SESSION['ids']['cartId']);
        if($sale->execute()){         
                $_SESSION['Cart']->cartDelete();
                $_SESSION['Cart']->setTotal();
                $_SESSION['Cart']->setProducts(); 
        }      
    }?>


<div class="container1">
  <div class="tab"></div>
  <div class="paid receipt">
      <h6 style="display: inline-block; margin-left: -80px;">Order: <?php echo $cartId?></h6>
      <h6 style="display: inline-block;float: right; margin-right: 13px;">Date: <?php echo date("j/n/Y"); ?></h6>
      <h3><strong>Congratulation!</strong></h3>
      <h5><strong> Order received successfully.</strong></h5> 
      <p style="margin: 14px; color:black !important">You must pay at our location and  look for your order thanks.</p>
      <a href="./user/panel?action=orderDetail&id=<?php echo ($_SESSION['ids']['cartId']-1)?>" class="btn btn-success">Orders</a></div>
  <div class="receipt">
  <div class="paper">
    <div class="title">Receipt</div>
    <div class="date">Date: <?php echo date("j/n/Y"); ?></div>    
    <table class="table1">
      <tbody>
         <tr><td colspan="2" class="center"><a href="#" class="btn-pay" style="margin-top:20px;" type="button">PROCESS</a></td></tr>
    </tbody>
    </table>
    <div class="sign center">
      <div class="barcode"></div>
      <br/>
      <?php
      if(isset($_SESSION['Cart'])&&$_SESSION['Cart']->getTotal()>0){
        echo "Order ID:".$_SESSION['ids']['cartId'];
        }?>
      <br>
      <div class="thankyou">
      Copyright © <a href="https://codepen.io/MariamMassadeh/pen/AVzGPX">Mariam Massadeh </a>, Thank you for letting me use your design in my project, Juan Octavio Castrogiovanni
      </div>
    </div>
  </div>
	
</div>
</div></div>
</div>
<!-- MainBody End ============================= -->
<?php
	include "./components/footer.php";
?>