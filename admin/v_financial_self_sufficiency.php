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
<div class="row" id="financial_self_sufficency">
    <div class="col-lg-3 col-md-3 col-sm-3" id="financial_self_sufficency-label">
        <h2>Financial Self Sufficiency</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="financial_self_sufficency-text">
        <p> This Module assists you to document and prepare your Financial Self Sufficiency Ratio.
        Financial Self Sufficiency Ratio helps you to determine whether or not the income of 
        the MFB is able to cover the costs - both direct and indirect. The Bank is financially 
        self sufficient if FSS is equal to or greater than 100%.</p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-4 col-md-4 col-sm-4" id="side-menu">
        <p> <a id="financial_self_sufficiency" href="index.php?page=financial_self_sufficiency"> Financial Self Sufficiency </a></p>
        <p> <a id="financial_self_sufficiency_list" href="index.php?page=financial_self_sufficiency_list"> Financial Self Sufficiency List </a></p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8"  id="financial_self_sufficency-form">
        <form method="post" action="../controllers/c_financial_self_sufficiency.php">
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
            <h6 id="computational-section"> Inflation Adjustment Computational Values </h6>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Average Equity">Average Equity</label>
                    <input type="text" name="average_equity" id="average_equity" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Average Fixed Assets">Average Fixed Assets</label>
                    <input type="text" name="average_fixed_assets" id="average_fixed_assets" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Inflation Rate">Inflation Rate</label>
                    <input type="text" name="inflation_rate" id="inflation_rate" 
                    class="form-control" required/>
                </div>
            </div>
           
            <h6 id="computational-section"> Subsidized Cost of Fund Adjustment  Computational Values </h6>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Average Funding Liabilities">Average Funding Liabilities</label>
                    <input type="text" name="average_funding_liabilities" id="average_funding_liabilities" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Commercial Rate for Funds">Commercial Rate for Funds</label>
                    <input type="text" name="commercial_rate_for_funds" id="commercial_rate_for_funds" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Interest and Fees Expense">Interest and Fees Expense</label>
                    <input type="text" name="interest_and_fees_expense" id="interest_and_fees_expense" 
                    class="form-control" required/>
                </div>
            </div>
            
            <h6 id="computational-section"> Net Loan Losses Computational Values</h6>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Gross Loan Losses">Gross Loan Losses</label>
                    <input type="text" name="gross_loan_losses" id="gross_loan_losses" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Lost Interest Deductions">Lost Interest Deductions</label>
                    <input type="text" name="lost_interest_deductions" id="lost_interest_deductions" 
                    class="form-control" required/>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="submit" name="sub-financial-self-sufficiency" id="sub-financial-self-sufficiency" value="Compute"/>
                </div>
            </div>
        </form>                                
    </div>
</div>

