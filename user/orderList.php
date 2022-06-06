<div class="span9">
                <h3> ORDEN LIST</h3>
                <hr class="soft" />
                
                <div class="row">
                    <!-- <div class="span9" style="min-height:900px"> -->
                    <div class="well" style="margin-left: 25px !important;">
                        <h5>You can view all orders here.</h5><br />
                        <!-- orders list -->
                        <table class="fixed_headers">
                            <thead>
                            
                            </thead>
                            <tbody>
                            <tr class="tableHeader">
                                <td>Order</td>
                                <td>Date</td>
                                <td>Total</td>
                                <td>State</td>
                                <td>Cancel</td>
                                <td>Order</td>
                            </tr>

                        <?php
                            try{ 
                                $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
                                $conect = $conect->conect();
                            }catch(Exception $e){
                                echo "<p>".$e->getMessage()."</p>";
                            }

                            $sql = sprintf("SELECT * FROM carts WHERE userId = %d AND sale = 1", $_SESSION['ids']['userId']);
                            $stmt = $conect->prepare($sql);
                            if($stmt->execute()){
                                if($stmt->rowCount()>0){
                                    foreach($stmt->fetchAll() as $cart){ ?>
                                        <tr>
                                        <td><?php echo $cart['cartId']; ?></td>
                                        <td><?php echo $cart['date']; ?></td>
                                        <td><?php echo $cart['total']; ?></td>
                                        <td>  
                                        <?php
                                            if (!$cart['cancel']){
                                                echo $cart['pickup']&&$cart['pay']?"<p style='color:darkgreen;'>Finished</p>":"<p style='color:#F59E00;'>Process</p>";
                                            } else {
                                                echo "<p style='color:red;'>Canceled</p>";
                                            }
                                        ?>
                                        </td>
                                        <td>
                                        <?php
                                            if(!$cart['pickup']){
                                                echo !$cart['cancel']? "<a href='./process.php?action=cancel&id=".$cart['cartId']."' class='btn btn-danger'>Cancel order</a>":"<botton class='btn btn-danger btn-disabled' disabled>Cancel order</botton>"; 
                                            } else {
                                                echo "<botton class='btn btn-danger btn-disabled' disabled>Cancel order</botton>";                                                 
                                            }
                                        ?>
                                        </td>

                                        <td><a href='<?php echo FRONT_END_URL?>/user/panel?action=orderDetail&id=<?php echo $cart["cartId"] ?>' class='btn btn-info'>></a></td>
                                        </tr>
                                   <?php } 
                                } else if($stmt->rowCount()==0){
                                    ?>
                                    <td colspan='6' style=''><div style='background:#e9e9e9; height:100px; color:#949494;font-size:24px; display:flex; justify-content:center; padding-top:80px;'><strong><i>EMPTY</i></strong></div></td>
                                    <td colspan='6' style=''><div style='background:#e9e9e9; height:100px; color:#949494;font-size:24px; display:flex; justify-content:center; padding-top:80px;'><strong><i>EMPTY </i></strong></div></td>
                                    <td colspan='6' style=''><div style='background:#e9e9e9; height:100px; color:#949494;font-size:24px; display:flex; justify-content:center; padding-top:80px;'><strong><i>EMPTY</i></strong></div></td>
                                    <td colspan='6' style=''><div style='background:#e9e9e9; height:100px; color:#949494;font-size:24px; display:flex; justify-content:center; padding-top:80px;'><strong><i>EMPTY</i></strong></div></td>
                                    <td colspan='6' style=''><div style='background:#e9e9e9; height:100px; color:#949494;font-size:24px; display:flex; justify-content:center; padding-top:80px;'><strong><i>EMPTY</i></strong></div></td>
                                    <td colspan='6' style=''><div style='background:#e9e9e9; height:100px; color:#949494;font-size:24px; display:flex; justify-content:center; padding-top:80px;'><strong><i>EMPTY</i></strong></div></td>
                               <?php } 
                            } 
                        ?>    
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>

                           