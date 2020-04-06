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
<div class="row" id="write_off_ratio">
    <div class="col-lg-3 col-md-3 col-sm-3" id="write_off_ratio-label">
        <h2>Write-Off Ratio</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="write_off_ratio-text">
        <p> Write-off ratio shows the past quality of the gross loan portfolio. 
            A high ratio indicates a problem in the MFB’s collection efforts.
        </p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-4 col-md-4 col-sm-4" id="side-menu">
        <p> <a href="index.php?page=write_off_ratio">Write-Off Ratio </a></p>
        <p> <a href="index.php?page=write_off_ratio_list">Write-Off Ratio List </a></p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8"  id="write_off_ratio-form">
        <form method="post" action="../controllers/c_write_off_ratio.php">
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
                    <label for="Value of Loans Written Off">Value of Loans Written Off</label>
                    <input type="text" name="value_of_loans_written_off" 
                        id="value_of_loans_written_off" class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="submit" name="sub-write_off_ratio" id="sub-write_off_ratio" value="Compute"/>
                </div>
            </div>
        </form>                                
    </div>
</div>

