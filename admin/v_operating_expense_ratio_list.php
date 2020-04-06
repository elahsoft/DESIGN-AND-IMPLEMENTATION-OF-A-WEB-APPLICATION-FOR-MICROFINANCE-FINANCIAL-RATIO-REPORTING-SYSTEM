<?php
    require_once '../models/YieldOnGrossPortfolio.php';
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
    $yieldOnGrossPortfolio= new YieldOnGrossPortfolio();
    $average_gross_loan_portfolio = 0;
    $operating_expense = 0;

?>
<div class="row" id="operating_expense_ratio">
    <div class="col-lg-3 col-md-3 col-sm-3" id="operating_expense_ratio-label">
        <h2>Operating Expense Ratio</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="operating_expense_ratio-text">
        <p>  The Operating Expense Ratio enables managers to quickly compare administrative and 
            personnel expenses to the MFB’s yield on the Gross Loan Portfolio. The lower the 
            operating expense ratio, the more efficient the MFB is.</p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-3 col-md-3 col-sm-3" id="side-menu">
        <p> <a href="index.php?page=operating_expense_ratio_list"> Operating Expense Ratio List </a></p>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9"  id="operating_expense_ratio-form">
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
                    <th>AVERAGE GROSS LOAN PORTFOLIO</th>
                    <th>OPERATING EXPENSE RATIO</th>
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
                            <td><?php echo $managementReportPeriodRecords[0]['from_date']." to ".$managementReportPeriodRecords[0]['to_date']; ?></td>                            <td><?php
                                    $wherDataArray = array($o['period_id']);
                                    $wherFieldArray = array("id");
                                    $logic = "";
                                    $yieldOnGrossPortfolioRecord = $yieldOnGrossPortfolio->select($wherDataArray, 
                                    $wherFieldArray, $logic);
                                    if (@$yieldOnGrossPortfolioRecord[0]) {
                                        $average_gross_loan_portfolio = 
                                        $yieldOnGrossPortfolioRecord[0]['average_gross_loan_portfolio'];
                                    }
                                    $operating_expense = $o['personnel_expense'] + $o['administrative_expense'];
                                    echo $operating_expense;
                                ?>
                             </td>
                            <td><?php echo $average_gross_loan_portfolio;?></td>
                            <td><?php 
                                if ($average_gross_loan_portfolio) {
                                    echo $operating_expense/$average_gross_loan_portfolio;
                                }
                                else {
                                    echo 0;
                                }
                            ?></td>       
                        </tr>
                    <?php
                                                                    }
                    ?>
            </tbody>
                <tfoot>
                    <tr>
                        <th>PERIOD</th>
                        <th>OPERATING EXPENSE</th>
                        <th>AVERAGE GROSS LOAN PORTFOLIO</th>
                        <th>OPERATING EXPENSE RATIO</th>
                    </tr>
                </tfoot>
        </table>
    </div>
</div>

