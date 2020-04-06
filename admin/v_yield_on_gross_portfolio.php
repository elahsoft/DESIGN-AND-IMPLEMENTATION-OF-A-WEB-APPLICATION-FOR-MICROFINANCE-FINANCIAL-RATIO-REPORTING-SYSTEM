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
<div class="row" id="yield_on_gross_portfolio">
    <div class="col-lg-3 col-md-3 col-sm-3" id="yield_on_gross_portfolio-label">
        <h2>Yield On Gross Portfolio</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="yield_on_gross_portfolio-text">
        <p> Portfolio Yield or Yield on Gross Portfolio is the ability of the MFI 
            to generate cash for her operations from the Gross Loan Portfolio. 
            Portfolio Yield should be compared against effective interest rate of loans; 
            if the yield is significantly/consistently lower than the effective interest rate, 
            it means the MFI has a problem with Loan collections.</p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-4 col-md-4 col-sm-4" id="side-menu">
        <p> <a href="index.php?page=yield_on_gross_portfolio"> Yield On Gross Portfolio </a></p>
        <p> <a href="index.php?page=yield_on_gross_portfolio_list"> Yield On Gross Portfolio List </a></p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8"  id="yield_on_gross_portfolio-form">
        <form method="post" action="../controllers/c_yield_on_gross_portfolio.php">
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
                    <label for="Cash from Interest, fees & Commisions on Loan Portfolio">Cash received from interest,fees and commisions 
                        on Loan Portfolio</label>
                    <input type="text" name="cash_from_gross_loan_portfolio" id="cash_from_gross_loan_portfolio" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Average Gross Loan Portfolio">Average Gross Loan Portfolio</label>
                    <input type="text" name="average_gross_loan_portfolio" id="average_gross_loan_portfolio" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="submit" name="sub-yield_on_gross_portfolio" id="sub-yield_on_gross_portfolio" value="Compute"/>
                </div>
            </div>
        </form>                                
    </div>
</div>

