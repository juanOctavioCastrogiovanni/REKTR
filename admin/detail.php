<?php
$point = 1;
include "./functions.php";
include ("../middleware/adminMiddleware.php");
include "../components/header.php";
?>
<div id='mainBody'>
    <div class='container'>
        <div class='row'>
        <?php
                    echo "<table class='table table-bordered'>
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
                            <tbody>";
                            try{ 
                                $conect = new Conect(['host'=>'localhost','user'=>'root','password'=>'','db'=>'tecnology']);
                                $conect = $conect->conect();
                                // HAGO UNA CONSULTA DONDE TRAIGO TODOS LOS PRODUCTOS RELACIONADOS CON EL CARRITO QUE VIENE POR ID.
                                // I make a query where I get all the products related to the cart that comes by id.
                                $sql = sprintf("SELECT products.image1,products.name,productscarts.qty,products.price,productscarts.subtotal FROM productscarts INNER JOIN products ON products.productId = productscarts.productId WHERE cartId = %d", $_GET['id']);
                                $stmt = $conect->prepare($sql);
                                if($stmt->execute()){
                                    foreach($stmt->fetchAll() as $product){
                                        echo "<tr>
                                        <td>".$_GET['id']."</td>
                                        <td> <img width='60' src='../themes/images/products/upload/".$product['image1']."' alt=''/></td>
                                        <td>".$product['name']."</td>
                                        <td>".$product['qty']."</td>
                                        <td>$".$product['price']."</td>
        
                                        <td style='width: 94px;'>$".$product['subtotal']."</td>
                                        </tr>";
                                    }
                                }
                                
                                unset($stmt);
                                // HAGO UNA CONSULTA DONDE TRAIGO EL CARRITO QUE VIENE POR ID.
                                // I make a query where I get the cart that comes by id.
                                $sql = sprintf("SELECT carts.date,total FROM carts WHERE cartId = %d", $_GET['id']);
                                $stmt = $conect->prepare($sql);
                                if($stmt->execute()){
                                    foreach($stmt->fetchAll() as $cart){
                                        echo "
                                            <tr>
                                            <td colspan='5' style='text-align:right'><strong>Order date</strong></td>
                                            <td><strong>".$cart['date']." </strong></td>
                                            </tr>
                                            <tr>
                                            <td colspan='5' style='text-align:right'><strong>TOTAL PRICE =</strong></td>
                                            <td class='label label-important' style='display:block'> <strong> $".$cart['total']." </strong></td>
                                            </tr>
                                            </tbody>
                                        </table>";
                                    }
                                
                                }
                                unset($stmt);
                                unset($conect);
                            }catch(Exception $e){
                                echo "<p>".$e->getMessage()."</p>";
                            }
?>
                </div>
            </div>
            </div>

                           