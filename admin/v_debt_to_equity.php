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
<div class="row" id="debt_to_equity">
    <div class="col-lg-3 col-md-3 col-sm-3" id="debt_to_equity-label">
        <h2>Debt to Equity Ratio</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="debt_to_equity-text">
        <p> This ratio shows safety cushion the bank has to absorb losses before creditors 
            are at risk. It also shows how well the MFB is able to leverage its Equity to increase 
            assets through borrowing. It is advisable not to have a leverage ratio that is not more than 1:2.
        </p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-4 col-md-4 col-sm-4" id="side-menu">
        <p> <a href="index.php?page=debt_to_equity"> Debt to Equity </a></p>
        <p> <a href="index.php?page=debt_to_equity_list"> Debt To Equity List </a></p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8"  id="debt_to_equity-form">
        <form method="post" action="../controllers/c_debt_to_equity.php">
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
                    <label for="Liabilities">Liabilities</label>
                    <input type="text" name="liabilities" id="liabilities" class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <label for="Equity">Equity</label>
                    <input type="text" name="equity" id="equity" class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="submit" name="sub-debt_to_equity" id="sub-debt_to_equity" value="Compute"/>
                </div>
            </div>
        </form>                                
    </div>
</div>

