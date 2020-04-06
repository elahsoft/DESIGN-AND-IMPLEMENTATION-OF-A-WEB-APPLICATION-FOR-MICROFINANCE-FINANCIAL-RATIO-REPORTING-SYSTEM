<?php
    require_once "../config/session_manager.php";
    checkTimeOut();
    if ($_SESSION['timed_out']) {
        session_destroy();
        header("Location:../index.php?page=signin");
    }
?>
<div class="row" id="management_report_period">
    <div class="col-lg-3 col-md-3 col-sm-3" id="management_report_period-label">
        <h2>Set Management Report Period</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="management_report_period-text">
        <p> This Module assists you to manage the period for which the management financial ratios are 
            computed for.
        </p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-4 col-md-4 col-sm-4" id="side-menu">
        <p> <a id="set_period" href="index.php?page=set_period"> Set Period </a></p>
        <p> <a id="period_list" href="index.php?page=period_list"> Period List </a></p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8"  id="management_report_period-form">
        <form method="post" action="../controllers/c_set_period.php">
            <p class="status-report"><?php 
                                        if (@$_SESSION['success']) {
                                            if (@$_SESSION['success'] == true) { echo "Operation successful!"; }
                                            else { echo "Operation Unsuccessful!"; } 
                                            unset($_SESSION['success']);
                                        }
                                    ?>
            </p>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="From">From</label>
                    <input type="date" name="from" id="from" 
                    class="form-control" required/>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="To">To</label>
                    <input type="date" name="to" id="to" 
                    class="form-control" required/>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="submit" name="sub-set_period" id="sub-set_period" value="Set"/>
                </div>
            </div>
        </form>                                
    </div>
</div>

