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
<div class="row" id="portfolio_at_risk">
    <div class="col-lg-3 col-md-3 col-sm-3" id="portfolio_at_risk-label">
        <h2>Portfolio At Risk</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="portfolio_at_risk-text">
        <p> It indicates the potential for future losses based on the current performance of the loan portfolio. 
            Best practice and regulatory threshold for Nigeria requires that the Portfolio at Risk for MFBs should 
            not exceed 2.5%.
        </p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-4 col-md-4 col-sm-4" id="side-menu">
        <p> <a href="index.php?page=portfolio_at_risk">Portfolio at Risk </a></p>
        <p> <a href="index.php?page=portfolio_at_risk_list"> Portfolio at Risk List </a></p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8"  id="portfolio_at_risk-form">
        <form method="post" action="../controllers/c_portfolio_at_risk.php">
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
                    <label for="Sum of principal outstanding on all past-due Loans">Sum of Principal outstanding on all past-due Loans</label>
                    <input type="text" name="principal_outstanding_on_all_past_due_loans" 
                        id="principal_outstanding_on_all_past_due_loans" class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Renegotiated Loans">Renegotiated Loans</label>
                    <input type="text" name="renegotiated_loans" id="renegotiated_loans" class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="submit" name="sub-portfolio_at_risk" id="sub-portfolio_at_risk" value="Compute"/>
                </div>
            </div>
        </form>                                
    </div>
</div>

