<div class="span9">
                <h3> ACCOUNT DELETE</h3>
                <hr class="soft" />

                <div class="row">
                    <!-- <div class="span9" style="min-height:900px"> -->
                    <div class="well" style="margin-left: 25px !important;">
                       <h5>All data will be deleted and cannot be recovered.
                        Do you wish to continue?</h5><br />
                        <form action="./admin/user.php?action=recoveryUser" method="POST">
                            <div class="control-group">
                                <label class="control-label" for="inputEmail1">Enter your email to delete your account</label>
                                <div class="controls">
                                    <input class="span3" type="text" id="inputEmail1" placeholder="Email" name="email">
                                </div>
                            </div>
                            <div class="controls">
                                <button type="submit" class="btn btn-danger">Delete account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>