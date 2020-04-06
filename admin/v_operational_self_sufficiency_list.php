<?php
    require_once '../models/OperationalSelfSufficiency.php';
    require_once '../models/ManagementReportPeriod.php';
    require_once "../config/session_manager.php";
    checkTimeOut();
    if ($_SESSION['timed_out']) {
        header("Location:../index.php");
    }
    
    //retrieve the records on database
    $operationalSelfSufficiency = new OperationalSelfSufficiency();
    $whereDataArray = array();
    $whereFieldArray = array();
    $logic = "";
    $operationalSelfSufficiencyRecords = $operationalSelfSufficiency->select($whereDataArray, 
                                                                                $whereFieldArray, $logic);
    $managementReportPeriod = new ManagementReportPeriod();

?>
<div class="row" id="operational_self_sufficency">
    <div class="col-lg-3 col-md-3 col-sm-3" id="operational_self_sufficency-label">
        <h2>Operational Self Sufficiency List</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="operational_self_sufficency-text">
        <p> This Module assists you to document and prepare your Operational Self Sufficiency Ratio.
            Operational Self Sufficiency Ratio indicates whether revenues from operations are sufficient to 
            cover all operating expenses. It is ok if the calculation gives a 100%.</p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-3 col-md-3 col-sm-3" id="side-menu">
        <p> <a href="index.php?page=operational_self_sufficiency"> Operational Self Sufficiency </a></p>
        <p> <a href="index.php?page=operational_self_sufficiency_list"> Operational Self Sufficiency List </a></p>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9"  id="operational_self_sufficency-form">
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
                    <th>DATE</th>
                    <th>PERIOD</th>
                    <th>FINANCIAL REVENUE</th>
                    <th>FINANCIAL EXPENSE</th>
                    <th>LOAN LOSSES</th>
                    <th>OPERATING EXPENSE</th>
                    <th>OPERATIONAL SELF SUFFICIENCY</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                                                    
                    foreach ($operationalSelfSufficiencyRecords as $oSSRec=> $o) {
                        $wherDataArray = array($o['period_id']);
                        $wherFieldArray = array("id");
                        $logic = "";
                        $managementReportPeriodRecords = $managementReportPeriod->select($wherDataArray, 
                                                                                $wherFieldArray, $logic);
                ?>
                        <tr>
                        <td><?php echo $o['date']; ?></td>
                            <td><?php echo $managementReportPeriodRecords[0]['from_date']." to ".$managementReportPeriodRecords[0]['to_date']; ?></td>
                            <td>
                                <?php 
                                    $financial_revenue = $o['interest_earned_in_cash'] + $o['income_from_fees'] +
                                    $o['commissions'] + $o['interest_accrued_but_not_yet_earned'];
                                    echo $financial_revenue;
                                ?>
                            </td>
                            <td>
                                <?php 
                                    $financial_expense = $o['interest_paid_in_cash'] + $o['fees_paid'] +
                                    $o['commissions_paid'] + $o['accrued_interest_but_not_yet_paid'];
                                    echo $financial_expense;
                                ?>
                            </td>
                            <td><?php echo $o['loan_losses_expense']; ?></td>
                            <td>
                                <?php 
                                    $operating_expense = $o['personnel_expense'] + 
                                    $o['administrative_expense'];
                                    echo $operating_expense;
                                ?>
                            </td>
                            <td><?php 
                                    $operational_self_sufficiency = $financial_revenue/($financial_expense
                                        + $o['loan_losses_expense'] + $operating_expense);
                                    $operational_self_sufficiency_array = explode(".",$operational_self_sufficiency);
                                    $whole_number = $operational_self_sufficiency_array[0];
                                    $decimal_part = 0;
                                    if (@$operational_self_sufficiency_array[1])
                                            $decimal_part = substr($operational_self_sufficiency_array[1],0,2);
                                    echo $whole_number.".".$decimal_part;
                                ?>
                            </td>

                            <td class="status-check">
                                <?php 
                                    if ($o['status'] == 1) {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$o['id']; ?>" id="<?php echo "status".$o['id']; ?>" 
                                            checked="checked"  class="glyph-button" onclick="updateStatus(0, 'OperationalSelfSufficiency', <?php echo $o['id']; ?> )"/>
                            `   <?php
                                                            }
                                    else {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$o['id']; ?>" id="<?php echo "status".$o['id']; ?>" 
                                            class="glyph-button" onclick="updateStatus(1, 'OperationalSelfSufficiency', <?php echo $o['id']; ?> )"/>
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
                        <th>DATE</th>
                        <th>PERIOD</th>
                        <th>FINANCIAL REVENUE</th>
                        <th>FINANCIAL EXPENSE</th>
                        <th>LOAN LOSSES</th>
                        <th>OPERATING EXPENSE</th>
                        <th>OPERATIONAL SELF SUFFICIENCY</th>
                        <th>STATUS</th>
                    </tr>
                </tfoot>
        </table>
    </div>
</div>

