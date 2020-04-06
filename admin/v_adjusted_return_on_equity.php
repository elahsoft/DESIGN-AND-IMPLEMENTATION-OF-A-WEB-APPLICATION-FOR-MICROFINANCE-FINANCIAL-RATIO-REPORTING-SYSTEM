<?php
    require_once "../config/session_manager.php";
    require_once "../models/ManagementReportPeriod.php";
    checkTimeOut();
    if ($_SESSION['timed_out']) {
        session_destroy();
        header("Location:../index.php?page=signin");
    }
    $managementReportPeriod = new ManagementReportPeriod();
    $whereDataArray = array(1);
    $whereFieldArray = array("status");
    $logic = "";
    $managementReportPeriodRecords = $managementReportPeriod->select($whereDataArray, $whereFieldArray, $logic);
?>
<div class="row" id="adjusted_return_on_equity">
    <div class="col-lg-3 col-md-3 col-sm-3" id="adjusted_return_on_equity-label">
        <h2>Adjusted Return On Equity</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="adjusted_return_on_equity-text">
        <p> This Module assists you to document and prepare your Return on Equity. 
        Return on Equity (ROE) is a good indicator of how well the Bank has used retained 
        earnings and donor money to become sustainable. AROE is inflation adjusted ROE.
        <h6> NOTE:</h6>
            When an MFB is consistently reaching FSS greater than 100 percent, managers should pay 
            closer attention to AROE and AROA, which are more commercial measurements of performance.</p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-4 col-md-4 col-sm-4" id="side-menu">
        <p> <a href="index.php?page=adjusted_return_on_equity"> Adjusted Return On Equity </a></p>
        <p> <a href="index.php?page=adjusted_return_on_equity_list"> Adjusted Return On Equity List </a></p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8"  id="adjusted_return_on_equity-form">
        <form method="post" action="../controllers/c_adjusted_return_on_equity.php">
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
                    <label for="period">Period</label>
                    <select name="period_id" id="period_id" class="form-control" required>
                        <?php
                             foreach ($managementReportPeriodRecords as $managementReportPeriodRec=> $mRP) {
                        ?>
                                <option value="<?php echo  $mRP['id']; ?>" ><?php echo $mRP['from_date']." to ".$mRP['to_date']; ?></option>
                        <?php
                             }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Adjusted Average Equity">Adjusted Average Equity</label>
                    <input type="text" name="adjusted_average_equity" id="adjusted_average_equity" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="submit" name="sub-adjusted-return-on-equity" id="sub-adjusted-return-on-equity" value="Compute"/>
                </div>
            </div>
        </form>                                
    </div>
</div>

