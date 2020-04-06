<?php
    require_once '../models/LiquidityRatio.php';
    require_once '../models/ManagementReportPeriod.php';
    require_once "../config/session_manager.php";
    checkTimeOut();
    if ($_SESSION['timed_out']) {
        header("Location:../index.php");
    }
    
    //retrieve the records on database
    $liquidityRatio = new LiquidityRatio();
    $whereDataArray = array();
    $whereFieldArray = array();
    $logic = "";
    $liquidityRatioRecords = $liquidityRatio->select($whereDataArray, 
                                                                                $whereFieldArray, $logic);
    $managementReportPeriod = new ManagementReportPeriod();

?>
<div class="row" id="liquidity_ratio">
    <div class="col-lg-3 col-md-3 col-sm-3" id="liquidity_ratio-label">
        <h2>Cost of Funds List</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="liquidity_ratio-text">
        <p> The liquidity Ratio is a measurement of the sufficiency of cash resources 
            to pay the short-term obligations to depositors, lenders and other creditors.
        </p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-2 col-md-2 col-sm-2" id="side-menu">
        <p> <a href="index.php?page=liquidity_ratio">Liquidity Ratio </a></p>
        <p> <a href="index.php?page=liquidity_ratio_list"> Liquidity Ratio List </a></p>
    </div>
    <div class="col-lg-10 col-md-10 col-sm-10"  id="liquidity_ratio-form">
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
                    <th>CASH </th>
                    <th>TRADE INVEST.</th>
                    <th>DEMAND DEP.</th>
                    <th>SHORT-TERM TIME DEP.</th>
                    <th>INT. PAYABLE</th>
                    <th>ACCT. PAYABLE</th>
                    <th>OTHER CURR. LIA.</th>
                    <th>LIQ. RATIO</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                                                    
                    foreach ($liquidityRatioRecords as $lQRec=> $l) {
                        $wherDataArray = array($l['period_id']);
                        $wherFieldArray = array("id");
                        $logic = "";
                        $managementReportPeriodRecords = $managementReportPeriod->select($wherDataArray, 
                                                                                $wherFieldArray, $logic);
                ?>
                        <tr>
                            <td><?php echo $managementReportPeriodRecords[0]['from_date']." to ".$managementReportPeriodRecords[0]['to_date']; ?></td>
                            <td><?php echo $l['cash']; ?></td>
                            <td><?php echo $l['trade_investments']; ?></td>
                            <td><?php echo $l['demand_deposits']; ?></td>
                            <td><?php echo $l['short_term_time_deposits']; ?></td>
                            <td><?php echo $l['int_payable_funding_lia']; ?></td>
                            <td><?php echo $l['accounts_payable']; ?></td>
                            <td><?php echo $l['other_current_liabilities']; ?></td>
                            <td><?php 
                                    $liquidity_ratio = 
                                    ($l['cash'] + $l['trade_investments'])/
                                    ($l['demand_deposits'] + $l['short_term_time_deposits'] + 
                                    $l['int_payable_funding_lia'] + $l['accounts_payable'] + $l['other_current_liabilities']);
                                    $liquidity_ratio_array = explode(".",$liquidity_ratio);
                                    $whole_number = $liquidity_ratio_array[0];
                                    $decimal_part = 0;
                                    if (@$liquidity_ratio_array[1])
                                        $decimal_part = substr($liquidity_ratio_array[1],0,2);
                                    echo $whole_number.".".$decimal_part;
                                ?>
                            </td>

                            <td class="status-check">
                                <?php 
                                    if ($l['status'] == 1) {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$l['id']; ?>" id="<?php echo "status".$l['id']; ?>" 
                                            checked="checked"  class="glyph-button" onclick="updateStatus(0, 'LiquidityRatio', <?php echo $l['id']; ?> )"/>
                            `   <?php
                                                            }
                                    else {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$l['id']; ?>" id="<?php echo "status".$l['id']; ?>" 
                                            class="glyph-button" onclick="updateStatus(1, 'LiquidityRatio', <?php echo $l['id']; ?> )"/>
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
                        <th>CASH </th>
                        <th>TRADE INVEST.</th>
                        <th>DEMAND DEP.</th>
                        <th>SHORT-TERM TIME DEP.</th>
                        <th>INT. PAYABLE</th>
                        <th>ACCT. PAYABLE</th>
                        <th>OTHER CURR. LIA.</th>
                        <th>LIQ. RATIO</th>
                        <th>STATUS</th>
                    </tr>
                </tfoot>
        </table>
    </div>
</div>

