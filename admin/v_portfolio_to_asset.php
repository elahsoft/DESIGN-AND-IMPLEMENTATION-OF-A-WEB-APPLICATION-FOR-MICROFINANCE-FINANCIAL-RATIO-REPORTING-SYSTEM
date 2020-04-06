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
<div class="row" id="portfolio_to_asset">
    <div class="col-lg-3 col-md-3 col-sm-3" id="portfolio_to_asset-label">
        <h2>Portfolio to Asset Ratio</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="portfolio_to_asset-text">
        <p> Portfolio to Assets indicates how well the MFI is allocating 
            her assets to granting of loans to micro-entrepreneurs. </p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-4 col-md-4 col-sm-4" id="side-menu">
        <p> <a href="index.php?page=portfolio_to_asset"> Portfolio to Asset Ratio </a></p>
        <p> <a href="index.php?page=portfolio_to_asset_list"> Portfolio to Asset Ratio List </a></p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8"  id="portfolio_to_asset-form">
        <form method="post" action="../controllers/c_portfolio_to_asset.php">
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
                    <label for="Gross Loan Portfolio">Gross Loan Portfolio</label>
                    <input type="text" name="gross_loan_portfolio" id="gross_loan_portfolio" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Assets">Assets</label>
                    <input type="text" name="assets" id="assets" class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="submit" name="sub-portfolio_to_asset" id="sub-portfolio_to_asset" value="Compute"/>
                </div>
            </div>
        </form>                                
    </div>
</div>

