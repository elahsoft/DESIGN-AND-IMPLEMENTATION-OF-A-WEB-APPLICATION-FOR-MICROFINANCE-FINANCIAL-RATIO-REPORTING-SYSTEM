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
<div class="row" id="operational_self_sufficency">
    <div class="col-lg-3 col-md-3 col-sm-3" id="operational_self_sufficency-label">
        <h2>Operational Self Sufficiency</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="operational_self_sufficency-text">
        <p> This Module assists you to document and prepare your Operational Self Sufficiency Ratio.
        Operational Self Sufficiency Ratio indicates whether revenues from operations are sufficient to 
        cover all operating expenses. It is ok if the calculation gives a 100%.</p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-4 col-md-4 col-sm-4" id="side-menu">
        <p> <a id="operational_self_sufficiency" href="index.php?page=operational_self_sufficiency"> Operational Self Sufficiency </a></p>
        <p> <a id="operational_self_sufficiency_list" href="index.php?page=operational_self_sufficiency_list"> Operational Self Sufficiency List </a></p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8"  id="operational_self_sufficency-form">
        <form method="post" action="../controllers/c_operational_self_sufficiency.php">
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
           
            <h6 id="computational-section"> Financial Revenue Computational Values </h6>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Interest Earned In Cash">Interest Earned In Cash</label>
                    <input type="text" name="interest_earned_in_cash" id="interest_earned_in_cash" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Income from fees">Income from Fees</label>
                    <input type="text" name="income_from_fees" id="income_from_fees" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Commissions">Commissions</label>
                    <input type="text" name="commissions" id="commissions" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Interest Accrued but not yet earned">Interest Accrued but not yet Earned</label>
                    <input type="text" name="interest_accrued_but_not_yet_earned" id="interest_accrued_but_not_yet_earned" 
                    class="form-control" required/>
                </div>
            </div>
            <h6 id="computational-section"> Financial Expense Computational Values </h6>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Interest Paid in Cash">Interest Paid in Cash</label>
                    <input type="text" name="interest_paid_in_cash" id="interest_paid_in_cash" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Fees Paid">Fees Paid</label>
                    <input type="text" name="fees_paid" id="fees_paid" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Commissions Paid">Commissions Paid</label>
                    <input type="text" name="commissions_paid" id="commissions_paid" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Accrued Interest but not yet Paid">Accrued Interest but not Yet Paid</label>
                    <input type="text" name="accrued_interest_but_not_yet_paid" id="accrued_interest_but_not_yet_paid" 
                    class="form-control" required/>
                </div>
            </div>
            <h6 id="computational-section"> Loan Losses Expense Computational Values</h6>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Loan Losses Expense">Loan Losses Expense</label>
                    <input type="text" name="loan_losses_expense" id="loan_losses_expense" 
                    class="form-control" required/>
                </div>
            </div>
            <h6 id="computational-section"> Operating Expense Computational Values</h6>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Personnel Expense">Personnel Expense</label>
                    <input type="text" name="personnel_expense" id="personnel_expense" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Administrative Expense">Administrative Expense</label>
                    <input type="text" name="administrative_expense" id="administrative_expense" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="submit" name="sub-operational-self-sufficiency" id="sub-operational-self-sufficiency" value="Compute"/>
                </div>
            </div>
        </form>                                
    </div>
</div>

