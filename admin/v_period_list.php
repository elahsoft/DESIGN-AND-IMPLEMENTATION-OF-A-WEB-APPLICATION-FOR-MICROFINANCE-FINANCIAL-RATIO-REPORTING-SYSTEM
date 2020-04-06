<?php
    require_once '../models/ManagementReportPeriod.php';
    require_once "../config/session_manager.php";
    checkTimeOut();
    if ($_SESSION['timed_out']) {
        header("Location:../index.php");
    }
    
    //retrieve the records on database
    $managementReportPeriod = new ManagementReportPeriod();
    $whereDataArray = array();
    $whereFieldArray = array();
    $logic = "";
    $managementReportPeriodRecords = $managementReportPeriod->select($whereDataArray, 
                                                                                $whereFieldArray, $logic);
?>
<div class="row" id="management_report_period">
    <div class="col-lg-3 col-md-3 col-sm-3" id="management_report_period-label">
        <h2>Management Report Period List</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="management_report_period-text">
        <p> This Module assists you to manage the period for which the management financial ratios are 
                computed for.
        </p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-3 col-md-3 col-sm-3" id="side-menu">
        <p> <a href="index.php?page=set_period"> Set Period </a></p>
        <p> <a href="index.php?page=period_list"> Period List </a></p>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9"  id="management_report_period-form">
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
                    <th>DATE</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                                                    
                    foreach ($managementReportPeriodRecords as $mRPRec=> $m) {
                ?>
                        <tr>
                            <td><?php echo $m['from_date']." to ".$m['to_date']; ?></td>
                            <td><?php echo $m['date']; ?></td>
                            <td class="status-check">
                                <?php 
                                    if ($m['status'] == 1) {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$m['id']; ?>" id="<?php echo "status".$m['id']; ?>" 
                                            checked="checked"  class="glyph-button" onclick="updateStatus(0, 'ManagementReportPeriod', <?php echo $m['id']; ?> )"/>
                            `   <?php
                                                            }
                                    else {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$m['id']; ?>" id="<?php echo "status".$m['id']; ?>" 
                                            class="glyph-button" onclick="updateStatus(1, 'ManagementReportPeriod', <?php echo $m['id']; ?> )"/>
                                <?php
                                        }
                                ?>
                            </td>
                            <td class="action-td">
                                <button type="button" id="<?php echo "button".$m['id']; ?>" class="glyph-button" id="glyph-button-delete" onclick="deleteRecord('ManagementReportPeriod', <?php echo $m['id']; ?> )">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </td>
                        </tr>
                    <?php
                                                                    }
                    ?>
            </tbody>
                <tfoot>
                    <tr>
                    <th>PERIOD</th>
                    <th>DATE</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                    </tr>
                </tfoot>
        </table>
    </div>
</div>

