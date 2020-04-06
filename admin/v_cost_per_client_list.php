<?php
    require_once '../models/CostPerClient.php';
    require_once '../models/OperationalSelfSufficiency.php';
    require_once '../models/ManagementReportPeriod.php';
    require_once "../config/session_manager.php";
    checkTimeOut();
    if ($_SESSION['timed_out']) {
        header("Location:../index.php");
    }
    
    //retrieve the records on database
    $costPerClient = new CostPerClient();
    $whereDataArray = array();
    $whereFieldArray = array();
    $logic = "";
    $costPerClientRecords = $costPerClient->select($whereDataArray, $whereFieldArray, $logic);
    $managementReportPeriod = new ManagementReportPeriod();
    $operationalSelfSufficiency= new OperationalSelfSufficiency();
    $operating_expense = 0;

?>
<div class="row" id="cost_per_client">
    <div class="col-lg-3 col-md-3 col-sm-3" id="cost_per_client-label">
        <h2>Operating Expense Ratio</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="cost_per_client-text">
        <p>  The Cost per Client Ratio indicates to an institution how much it currently 
            spends in Personnel and Administrative Expenses to serve a single active client. 
            It informs the MFI how much it must earn on average from each client to be profitable.</p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-3 col-md-3 col-sm-3" id="side-menu">
        <p> <a href="index.php?page=cost_per_client"> Cost Per Client</a></p>
        <p> <a href="index.php?page=cost_per_client_list"> Cost Per Client List </a></p>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9"  id="cost_per_client-form">
        <p class="status-report">
        <?php 
            if (@$_SESSION['success']) {
                    if (@$_SESSION['success'] == true) { echo "Operation successful!"; }
                    else { echo "Operation Unsuccessful!"; } 
                    unset($_SESSION['success']);
                    }
        ?>
            </p>
        <table id="list" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>PERIOD</th>
                    <th>OPERATING EXPENSE</th>
                    <th>AVERAGE NUMBER OF CLIENTS</th>
                    <th>COST PER CLIENT</th>
                    <th>STATUS </th>
                </tr>
            </thead>
            <tbody>
                <?php
                                                    
                    foreach ($costPerClientRecords as $cPCRec=> $c) {
                        $wherDataArray = array($c['period_id']);
                        $wherFieldArray = array("id");
                        $logic = "";
                        $managementReportPeriodRecords = $managementReportPeriod->select($wherDataArray, 
                                                                                $wherFieldArray, $logic);
                ?>
                        <tr>
                            <td><?php echo $managementReportPeriodRecords[0]['from_date']." to ".$managementReportPeriodRecords[0]['to_date']; ?></td>                            <td><?php
                                    $wherDataArray = array($c['period_id']);
                                    $wherFieldArray = array("id");
                                    $logic = "";
                                    $operationalSelfSufficiencyRecord = $operationalSelfSufficiency->select($wherDataArray, 
                                    $wherFieldArray, $logic);
                                    if (@$operationalSelfSufficiencyRecord[0]) {
                                        $operating_expense = 
                                        $operationalSelfSufficiencyRecord[0]['personnel_expense'] +
                                        $operationalSelfSufficiencyRecord[0]['administrative_expense'];
                                    }
                                    echo $operating_expense;
                                ?>
                             </td>
                            <td><?php 
                                echo $c['average_number_of_clients'];
                            ?></td>
                            <td><?php 
                                echo $operating_expense/$c['average_number_of_clients'];
                            ?></td>
                            <td class="status-check">
                                <?php 
                                    if ($c['status'] == 1) {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$c['id']; ?>" id="status" 
                                            checked="checked"  class="glyph-button" onclick="updateStatus(0, 'CostPerClient', <?php echo $c['id']; ?> )"/>
                            `   <?php
                                                            }
                                    else {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$c['id']; ?>" id="status" 
                                            class="glyph-button" onclick="updateStatus(1, 'CostPerClient', <?php echo $c['id']; ?> )"/>
                                <?php
                                        }
                                ?>
                            </td>      
                        </tr>
                    <?php
                                                                    }
                    ?>
            </tbody>
                <tfoot>
                    <tr>
                        <th>PERIOD</th>
                        <th>OPERATING EXPENSE</th>
                        <th>AVERAGE NUMBER OF CLIENTS</th>
                        <th>COST PER CLIENT</th>
                        <th>STATUS </th>
                    </tr>
                </tfoot>
        </table>
    </div>
</div>

