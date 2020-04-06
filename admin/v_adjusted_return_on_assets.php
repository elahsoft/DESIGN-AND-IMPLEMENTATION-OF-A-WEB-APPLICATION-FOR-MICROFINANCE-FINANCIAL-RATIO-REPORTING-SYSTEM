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
<div class="row" id="adjusted_return_on_assets">
    <div class="col-lg-3 col-md-3 col-sm-3" id="adjusted_return_on_assets-label">
        <h2>Adjusted Return On Assets</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="adjusted_return_on_assets-text">
        <p> This Module assists you to document and prepare your Return on Assets. Return On Assets 
            shows how efficiently the assets of the bank are used to generate profits relative to inflation. 
            Net Operating Income and Average assets are adjusted by the inflation rate. Adjusted 
            Return On Assets is Return On Assets adjusted by inflation. It should be positive.</p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-4 col-md-4 col-sm-4" id="side-menu">
        <p> <a id="adjusted_return_on_assets" href="index.php?page=adjusted_return_on_assets"> Adjusted Return On Assets </a></p>
        <p> <a id="adjusted_return_on_assets_list" href="index.php?page=adjusted_return_on_assets_list"> Adjusted Return On Assets List </a></p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8"  id="adjusted_return_on_assets-form">
        <form method="post" action="../controllers/c_adjusted_return_on_assets.php">
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
                    <label for="Adjusted Net Operating Income">Adjusted Net Operating Income</label>
                    <input type="text" name="adjusted_net_operating_income" id="adjusted_net_operating_income" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Taxes">Taxes</label>
                    <input type="text" name="taxes" id="taxes" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Adjusted Average Assets">Adjusted Average Assets</label>
                    <input type="text" name="adjusted_average_assets" id="adjusted_average_assets" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="submit" name="sub-adjusted-return-assets" id="sub-adjusted-return-assets" value="Compute"/>
                </div>
            </div>
        </form>                                
    </div>
</div>

