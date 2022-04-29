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
                                <th>Order nº</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Order</th>
                            </tr>
                            </thead>
                            <tbody>
                        <?php
                          echo "<tr>
                                    <td>1</td>
                                    <td>04-29-2022 11:00</td>
                                    <td>$945</td>
                                    <td><a href='".FRONT_END_URL."/user/panel?action=orderDetail&id=1' class='btn btn-danger'>Detail</a></td>
                                </tr>";
                        ?>    
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>