<?php
    require_once '../models/FinancialSelfSufficiency.php';
    require_once '../models/OperationalSelfSufficiency.php';
    require_once '../models/ManagementReportPeriod.php';
    require_once "../config/session_manager.php";
    checkTimeOut();
    if ($_SESSION['timed_out']) {
        header("Location:../index.php");
    }
    
    //retrieve the records on database
    $financialSelfSufficiency = new FinancialSelfSufficiency();
    $whereDataArray = array();
    $whereFieldArray = array();
    $logic = "";
    $financialSelfSufficiencyRecords = $financialSelfSufficiency->select($whereDataArray, 
                                                                                $whereFieldArray, $logic);
                                                                                
    $managementReportPeriod = new ManagementReportPeriod();
    $operationalSelfSufficiency = new OperationalSelfSufficiency();
?>
<div class="row" id="operational_self_sufficency">
    <div class="col-lg-3 col-md-3 col-sm-3" id="operational_self_sufficency-label">
        <h2>Financial Self Sufficiency List</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="operational_self_sufficency-text">
        <p> This Module assists you to document and prepare your Financial Self Sufficiency Ratio.
            Financial Self Sufficiency Ratio helps you to determine whether or not the income of 
            the MFB is able to cover the costs - both direct and indirect. The Bank is financially self 
            sufficient if FSS is equal to or greater than 100%.</p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-2 col-md-2 col-sm-2" id="side-menu">
    <p> <a href="index.php?page=financial_self_sufficiency"> Financial Self Sufficiency </a></p>
        <p> <a href="index.php?page=financial_self_sufficiency_list"> Financial Self Sufficiency List </a></p>
    </div>
    <div class="col-lg-10 col-md-10 col-sm-10"  id="financial_self_sufficency-form">
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
                    <th>ADJUSTED FINANCIAL EXPENSE</th>
                    <th>NET LOAN LOSSES</th>
                    <th>OPERATING EXPENSES</th>
                    <th>FINANCIAL SELF SUFFICIENCY</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                                                    
                    foreach ($financialSelfSufficiencyRecords as $fSSRec=> $f) {
                        $whereDataArray = array($f['period_id']);
                        $whereFieldArray = array("id");
                        $logic = "";
                        $managementReportPeriodRecord = $managementReportPeriod->select($whereDataArray, 
                                                                                $whereFieldArray, $logic);
                ?>
                        <tr>
                            <td><?php echo $f['date']; ?></td>
                            <td><?php echo $managementReportPeriodRecord[0]['from_date']." to ".$managementReportPeriodRecord[0]['to_date']; ?></td>
                            <td>
                                <?php 
                                    $whereDataArray = array($f['period_id']);
                                    $whereFieldArray = array("period_id");
                                    $logic = "";
                                    $operationalSelfSufficiencyRecord = $operationalSelfSufficiency->select(
                                        $whereDataArray, $whereFieldArray, $logic);
                                    
                                    if (@$operationalSelfSufficiencyRecord[0]) {
                                        $financial_revenue = $operationalSelfSufficiencyRecord[0]['interest_earned_in_cash'] + 
                                        $operationalSelfSufficiencyRecord[0]['income_from_fees'] +
                                        $operationalSelfSufficiencyRecord[0]['commissions'] + 
                                        $operationalSelfSufficiencyRecord[0]['interest_accrued_but_not_yet_earned'];
                                        echo $financial_revenue;
                                    }
                                    else {
                                        echo 0;
                                    }
                                ?>
                            </td>
                            
                            <td>
                                <?php 
                                    $inflation_adjustment = ($f['average_equity'] - $f['average_fixed_assets']) * $f['inflation_rate'];
                                    $subsidized_cost_of_fund_adjustment = ($f['average_funding_liabilities'] *
                                    $f['commercial_rate_for_funds']) - $f['interest_and_fees_expense'];

                                    $adjusted_financial_expense = 
                                            $inflation_adjustment + $subsidized_cost_of_fund_adjustment;
                                    echo $adjusted_financial_expense;
                                ?>
                            </td>
                            <td><?php 
                                    $net_loan_losses = $f['gross_loan_losses'] - $f['lost_interest_deductions'];
                                    echo $net_loan_losses; 
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if (@$operationalSelfSufficiencyRecord[0]) {
                                        $operating_expense = $operationalSelfSufficiencyRecord[0]['personnel_expense'] + 
                                        $operationalSelfSufficiencyRecord[0]['administrative_expense'];
                                        echo $operating_expense;
                                    }
                                    else {
                                        echo 0;
                                    }
                                ?>
                            </td>
                            <td><?php 
                                    if (@$operationalSelfSufficiencyRecord[0]) {
                                        $financial_self_sufficiency = $financial_revenue/($adjusted_financial_expense
                                            + $net_loan_losses+ $operating_expense);
                                        $financial_self_sufficiency_array = explode(".",$financial_self_sufficiency);
                                        $whole_number = $financial_self_sufficiency_array[0];
                                        $decimal_part = 0;
                                        if (@$financial_self_sufficiency_array[1])
                                            $decimal_part = substr($financial_self_sufficiency_array[1],0,2);
                                        echo $whole_number.".".$decimal_part;
                                    }
                                    else {
                                        echo 0;
                                    }
                                ?>
                            </td>

                            <td class="status-check">
                                <?php 
                                    if ($f['status'] == 1) {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$f['id']; ?>" id="<?php echo "status".$f['id']; ?>" 
                                            checked="checked"  class="glyph-button" onclick="updateStatus(0, 'FinancialSelfSufficiency', <?php echo $f['id']; ?> )"/>
                            `   <?php
                                                            }
                                    else {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$f['id']; ?>" id="<?php echo "status".$f['id']; ?>" 
                                            class="glyph-button" onclick="updateStatus(1, 'FinancialSelfSufficiency', <?php echo $f['id']; ?> )"/>
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
                        <th>ADJUSTED FINANCIAL EXPENSE</th>
                        <th>NET LOAN LOSSES</th>
                        <th>OPERATING EXPENSES</th>
                        <th>FINANCIAL SELF SUFFICIENCY</th>
                        <th>STATUS</th>
                    </tr>
                </tfoot>
        </table>
    </div>
</div>

