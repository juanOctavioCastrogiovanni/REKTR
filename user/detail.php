                    <table class='table table-bordered'>
                            <thead>
                                <tr>
                                <th>Order</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>

                                <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                            try{ 
                                $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
                                $conect = $conect->conect();
                                $sql = sprintf("SELECT products.image1,products.name,productscarts.qty,products.price,productscarts.subtotal FROM productscarts INNER JOIN products ON products.productId = productscarts.productId WHERE cartId = %d", $_GET['id']);
                                $stmt = $conect->prepare($sql);
                                if($stmt->execute()){
                                    foreach($stmt->fetchAll() as $product){
                        ?>
                                        <tr>
                                        <td><?php echo $_GET['id']?></td>
                                        <td> <img width='60' src='../themes/images/products/upload/<?php echo $product['image1']?>' alt=''/></td>
                                        <td><?php echo $product['name'] ?></td>
                                        <td><?php echo $product['qty'] ?></td>
                                        <td>$ <?php echo $product['price'] ?></td>
        
                                        <td style='width: 94px;'>$ <?php echo $product['subtotal'] ?></td>
                                        </tr>
                            <?php
                                    }
                                }
                                unset($stmt);
                                $sql = sprintf("SELECT carts.date,total FROM carts WHERE cartId = %d", $_GET['id']);
                                $stmt = $conect->prepare($sql);
                                if($stmt->execute()){
                                    foreach($stmt->fetchAll() as $cart){
                              
                            ?>
                                            <tr>
                                            <td colspan='5' style='text-align:right'><strong>Order date</strong></td>
                                            <td><strong><?php echo $cart['date'] ?> </strong></td>
                                            </tr>
                                            <tr>
                                            <td colspan='5' style='text-align:right'><strong>TOTAL PRICE =</strong></td>
                                            <td class='label label-important' style='display:block'> <strong> $<?php echo $cart['total'] ?> </strong></td>
                                            </tr>
                                            </tbody>
                                        </table>
                            <?php
                                    }
                                
                                }
                                unset($stmt);
                                unset($conect);
                            }catch(Exception $e){
                                echo "<p>".$e->getMessage()."</p>";
                            }                          
                            ?>