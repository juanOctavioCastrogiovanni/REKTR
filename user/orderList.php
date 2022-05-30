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
                            <tr>
                                <th>Order</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>State</th>
                                <th>Cancel</th>
                                <th>Order</th>
                            </tr>
                            </thead>
                            <tbody>
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
                                    foreach($stmt->fetchAll() as $cart){
                                        echo "<tr>";
                                        echo "<td>".$cart['cartId']."</td>";
                                        echo "<td>".$cart['date']."</td>";
                                        echo "<td>".$cart['total']."</td>";
                                        echo "<td>";  
                                            if (!$cart['cancel']){
                                                echo $cart['pickup']&&$cart['pay']?"<p style='color:darkgreen;'>Finished</p>":"<p style='color:#F59E00;'>Process</p>";
                                            } else {
                                                echo "<p style='color:red;'>Canceled</p>";
                                            }
                                        echo"</td>";
                                        echo "<td>"; echo !$cart['cancel']? "<a href='./process.php?action=cancel&id=".$cart['cartId']."' class='btn btn-danger'>Cancel order</a>":""; echo"</td>";
                                        echo "<td><a href='".FRONT_END_URL."/user/panel?action=orderDetail&id=".$cart['cartId']."' class='btn btn-info'>></a></td>";
                                        echo "</tr>";
                                    } 
                                } else if($stmt->rowCount()==0){
                                    echo "<td colspan='6' style=''><div style='background:#e9e9e9; height:100px; color:#949494;font-size:24px; display:flex; justify-content:center; padding-top:80px;'><strong><i>EMPTY</i></strong></div></td>";
                                    echo "<td colspan='6' style=''><div style='background:#e9e9e9; height:100px; color:#949494;font-size:24px; display:flex; justify-content:center; padding-top:80px;'><strong><i>EMPTY </i></strong></div></td>";
                                    echo "<td colspan='6' style=''><div style='background:#e9e9e9; height:100px; color:#949494;font-size:24px; display:flex; justify-content:center; padding-top:80px;'><strong><i>EMPTY</i></strong></div></td>";
                                    echo "<td colspan='6' style=''><div style='background:#e9e9e9; height:100px; color:#949494;font-size:24px; display:flex; justify-content:center; padding-top:80px;'><strong><i>EMPTY</i></strong></div></td>";
                                    echo "<td colspan='6' style=''><div style='background:#e9e9e9; height:100px; color:#949494;font-size:24px; display:flex; justify-content:center; padding-top:80px;'><strong><i>EMPTY</i></strong></div></td>";
                                    echo "<td colspan='6' style=''><div style='background:#e9e9e9; height:100px; color:#949494;font-size:24px; display:flex; justify-content:center; padding-top:80px;'><strong><i>EMPTY</i></strong></div></td>";
                                }
                            } 
                        ?>    
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>

                           