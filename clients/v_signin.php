<?php
    session_start();
?>
<div class="row" id="signin">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3> Sign In </h3>
            <p class="status-report"> 
                <?php 
                    if ($_SESSION) {
                        if (@$_SESSION['error'] != '') { 
                            echo @$_SESSION['error']; 
                                                }
                        if (@$_SESSION['timed_out']) {
                            echo "Logged In Session Expired! Please Sign in again.";
                                                }
                                            }
                    session_destroy();
                ?> 
            </p>
        </div>
    </div>
    <div>
    <form method="post" action="controllers/c_signin.php">
        <div class="col-lg-12 col-md-12 col-sm-12 form-group" id="control-input">
            <input class="form-control" placeholder="User Name" name="username" id="username" type="text" />
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 form-group" id="control-input">
            <input class="form-control" placeholder="Password" name="password" id="password" type="password"/>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 form-group" id="control-submit">
            <input class="form-control" value="Sign in" name="sub-signin" id="sub-signin" type="submit"/>
        </div>
    </form>
    </div>