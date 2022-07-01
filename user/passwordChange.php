<div class="span9">
                <h3> PASSWORD CHANGE</h3>
                <hr class="soft" />

                <div class="row">
                    <!-- <div class="span9" style="min-height:900px"> -->
                    <div class="well" style="margin-left: 25px !important;">
                        <h5>Reset your password</h5><br />
                        Please enter the email address for your account. A verification code will be sent to you. Once
                        you have received the verification code, you will be able to choose a new password for your
                        account.<br /><br /><br />
                        <form action="../admin/user.php?action=recoveryUser" method="POST">
                            <div class="control-group">
                                <label class="control-label" for="inputEmail1">E-mail address</label>
                                <div class="controls">
                                    <input class="span3" type="text" id="inputEmail1" placeholder="Email" name="email">
                                </div>
                            </div>
                            <div class="controls">
                                <button type="submit" class="btn block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>