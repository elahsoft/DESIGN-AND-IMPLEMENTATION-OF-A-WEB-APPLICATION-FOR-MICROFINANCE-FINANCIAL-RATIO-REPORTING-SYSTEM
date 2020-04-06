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
<div class="row" id="cost_of_funds">
    <div class="col-lg-3 col-md-3 col-sm-3" id="cost_of_funds-label">
        <h2>Cost of Funds</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="cost_of_funds-text">
        <p> For a successful interest rate management determination, the portfolio yield is 
            compared to the cost of funding the gross loan portfolio with borrowings. 
            Cost of fund should always be less than the portfolio yield.
            Efforts should be made to minimize cost of funds and maximize portfolio yield.
            Comparing the cost of funds to the portfolio yield gives your MFI financial spread.
        </p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-4 col-md-4 col-sm-4" id="side-menu">
        <p> <a href="index.php?page=cost_of_funds">Cost of Funds </a></p>
        <p> <a href="index.php?page=cost_of_funds_list"> Cost of Funds List </a></p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8"  id="cost_of_funds-form">
        <form method="post" action="../controllers/c_cost_of_funds.php">
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
                    <label for="Financial Expense on Funding Liabilities">Financial Expense on Funding Liabilities</label>
                    <input type="text" name="financial_expense_on_funding_liabilities" 
                        id="financial_expense_on_funding_liabilities" class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Average Deposit">Average Deposit</label>
                    <input type="text" name="average_deposit" id="average_deposit" class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Average Borrowings">Average Borrowings</label>
                    <input type="text" name="average_borrowings" id="average_borrowings" class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="submit" name="sub-cost_of_funds" id="sub-cost_of_funds" value="Compute"/>
                </div>
            </div>
        </form>                                
    </div>
</div>

