<div class="span9">
                <h3> USER DETAILS</h3>
                
                <hr class="soft" />

                <div class="row">
                    <!-- <div class="span9" style="min-height:900px"> -->
                    <div class="well" style="margin-left: 25px !important;">
                    <h5>You can view all user detail.</h5><br />

                        
                    <table class="fixed_headers">
                        <thead>
                        <tr>
                            <th>Client ID</th>
                            <th>First</th>
                            <th>Last</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?php echo $_SESSION['ids']['userId']?></td>
                            <td><?php echo $_SESSION['user']['firstname']?></td>
                            <td><?php echo $_SESSION['user']['lastName']?></td>
                            <td><?php echo $_SESSION['user']['email']?></td>
                        </tr>
                        
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>