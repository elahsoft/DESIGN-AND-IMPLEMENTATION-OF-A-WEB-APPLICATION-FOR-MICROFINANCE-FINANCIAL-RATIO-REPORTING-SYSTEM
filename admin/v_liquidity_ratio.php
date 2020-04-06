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
<div class="row" id="liquidity_ratio">
    <div class="col-lg-3 col-md-3 col-sm-3" id="liquidity_ratio-label">
        <h2>Liquidity Ratio</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="liquidity_ratio-text">
        <p> The liquidity Ratio is a measurement of the sufficiency of cash resources 
            to pay the short-term obligations to depositors, lenders and other creditors.
        </p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-4 col-md-4 col-sm-4" id="side-menu">
        <p> <a href="index.php?page=liquidity_ratio"> Liquidity Ratio</a></p>
        <p> <a href="index.php?page=liquidity_ratio_list"> Liquidity Ratio List </a></p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8"  id="liquidity_ratio-form">
        <form method="post" action="../controllers/c_liquidity_ratio.php">
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
                    <label for="Cash">Cash</label>
                    <input type="text" name="cash" id="cash" class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Trade Investments">Trade Investments</label>
                    <input type="text" name="trade_investments" id="trade_investments" class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Demand Deposits">Demand Deposits</label>
                    <input type="text" name="demand_deposits" id="demand_deposits" class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Short-term Time Deposits">Short-term Time Deposits</label>
                    <input type="text" name="short_term_time_deposits" id="short_term_time_deposits" class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Interest Payable on Funding Liabilities">Interest Payable on Funding Liabilities</label>
                    <input type="text" name="int_payable_funding_lia" id="int_payable_funding_lia" class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Accounts Payable">Accounts Payable</label>
                    <input type="text" name="accounts_payable" id="accounts_payable" class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Other current Liabilities">Other current Liabilities</label>
                    <input type="text" name="other_current_liabilities" id="other_current_liabilities" class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="submit" name="sub-liquidity_ratio" id="sub-liquidity_ratio" value="Compute"/>
                </div>
            </div>
        </form>                                
    </div>
</div>

