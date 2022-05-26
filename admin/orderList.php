
<div class="container">
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
                                <th>Paid</th>
                                <th>User</th>
                                <th>Pick up</th>
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

                            $sql = "SELECT * FROM carts WHERE sale = 1";
                            $stmt = $conect->prepare($sql);
                            if($stmt->execute()){
                                if($stmt->rowCount()>0){
                                    foreach($stmt->fetchAll() as $cart){
                                        echo "<tr>";
                                        echo "<td>".$cart['cartId']."</td>";
                                        echo "<td>".$cart['date']."</td>";
                                        echo "<td>".$cart['total']."</td>";
                                        echo "<td>"; 
                                        if($cart['pay']){
                                            echo "Yes";
                                        } else {
                                            echo "No";
                                        }
                                        echo"</td>";
                                        echo "<td>"; 
                                        if($cart['pickup']){
                                            echo "Yes";
                                        } else {
                                            echo "No";
                                        }
                                        echo"</td>";
                                        
                                        echo "<td><a href='".FRONT_END_URL."/user/panel?action=orderDetail&id=".$cart['cartId']."' class='btn btn-danger'>Cart detail</a></td>";
                                        echo "</tr>";
                                    } 
                                } 
                            } 
                        ?>    
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>

                           