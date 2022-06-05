<?php
$point = 1;
include "./functions.php";
include ("../middleware/adminMiddleware.php");
include "../components/header.php";
?>
<div id='mainBody'>
    <div class='container'>
        <div class='row'>
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
                           
                            </thead>
                            <tbody>
                            <tr class=tableHeader>
                                <td>Order</td>
                                <td>Date</td>
                                <td>Email</td>
                                <td>User</td>
                                <td>Paid</td>
                                <td>Pick up</td>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php
                            try{ 
                                // HAGO UNA CONSULTA DONDE TRAIGO TODOS LOS CARRITOS VENDIDOS Y NO CANCELADOS PARA ADMINISTRARLOS.
                                // New query where I get all the carts sold and not canceled.
                                $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
                                $conect = $conect->conect();
                                $sql = "SELECT cartId,date, total, pay, pickup, firstname, lastname, email FROM carts INNER JOIN users ON users.userId=carts.userId WHERE sale = 1 AND cancel = 0";
                                $stmt = $conect->prepare($sql);
                                if($stmt->execute()){
                                    if($stmt->rowCount()>0){
                                        foreach($stmt->fetchAll() as $cart){
                                            echo "<tr>";
                                            echo "<td>".$cart['cartId']."</td>";
                                            echo "<td>".$cart['date']."</td>";
                                            echo "<td>".$cart['email']."</td>";
                                            echo "<td>".$cart['firstname']." ".$cart['lastname']."</td>";
                                            echo "<td>"; echo $cart['pay']?"Yes":"No"; echo"</td>";
                                            echo "<td>"; echo $cart['pickup']?"Yes":"No"; echo"</td>";
                                            echo "<td>".$cart['total']."</td>";
                                            echo "<td><a href='./pay.php?action=cancel&id=".$cart['cartId']."' class='btn btn-danger'>X</a></td>";
                                            echo !$cart['pay']? "<td><a href='./pay.php?action=paid&id=".$cart['cartId']."' class='btn btn-success'>Paid</a></td>":"<td><button class='btn btn-success' disabled>Paid</button></td>";
                                            echo !$cart['pickup']? "<td><a href='./pay.php?action=pick&id=".$cart['cartId']."' class='btn btn-success'>Pick</a></td>":"<td><button class='btn btn-success' disabled>Pick</button></td>";
                                            echo "<td><a href='./detail?id=".$cart['cartId']."' class='btn btn-warning'>></a></td>";
                                            echo "</tr>";
                                        } 
                                    } 
                                } 
                            }catch(Exception $e){
                                echo "<p>".$e->getMessage()."</p>";
                            }

                        ?>    
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>

            </div>
                </div>
            </div>
            </div>

                           