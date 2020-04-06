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
<div class="row" id="cost_per_client">
    <div class="col-lg-3 col-md-3 col-sm-3" id="cost_per_client-label">
        <h2>Cost Per Client</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="cost_per_client-text">
        <p> The Cost per Client Ratio indicates to an institution how much it currently 
            spends in Personnel and Administrative Expenses to serve a single active client. 
            It informs the MFI how much it must earn on average from each client to be profitable.
        </p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-4 col-md-4 col-sm-4" id="side-menu">
        <p> <a href="index.php?page=cost_per_client"> Cost Per Client</a></p>
        <p> <a href="index.php?page=cost_per_client_list"> Cost Per Client List </a></p>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8"  id="cost_per_client-form">
        <form method="post" action="../controllers/c_cost_per_client.php">
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
                    <label for="Average Number of Clients">Average Number of Clients</label>
                    <input type="text" name="average_number_of_clients" id="average_number_of_clients" 
                    class="form-control" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="submit" name="sub-cost_per_client" id="sub-cost_per_client" value="Compute"/>
                </div>
            </div>
        </form>                                
    </div>
</div>

