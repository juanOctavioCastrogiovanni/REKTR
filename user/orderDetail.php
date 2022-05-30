<div class="span9">
    <h3> ORDEN DETAIL</h3>
    <hr class="soft" />
    
    <div class="row">
        <!-- <div class="span9" style="min-height:900px"> -->
            <div class="well" style="margin-left: 25px !important;">
                <!-- <h5></h5><br /> -->
                <!-- orders list -->
                <?php include "./detail.php"?>
            </div>
        </div>
        <div style="justify-content:space-between;display:flex;">
            <a href="panel?action=orderList" class="btn btn-info"><p><</p></a>
            <a href="./process.php?action=cancel&id=<?php echo $_GET['id']?>" class="btn btn-danger"><p>Cancel order</p></a>
        </div>
            </div>