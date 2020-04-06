<?php
    require_once '../models/CostOfFunds.php';
    require_once '../models/ManagementReportPeriod.php';
    require_once "../config/session_manager.php";
    checkTimeOut();
    if ($_SESSION['timed_out']) {
        header("Location:../index.php");
    }
    
    //retrieve the records on database
    $costOfFunds = new CostOfFunds();
    $whereDataArray = array();
    $whereFieldArray = array();
    $logic = "";
    $costOfFundsRecords = $costOfFunds->select($whereDataArray, 
                                                                                $whereFieldArray, $logic);
    $managementReportPeriod = new ManagementReportPeriod();

?>
<div class="row" id="cost_of_funds">
    <div class="col-lg-3 col-md-3 col-sm-3" id="cost_of_funds-label">
        <h2>Cost of Funds List</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="cost_of_funds-text">
        <p> For a successful interest rate management determination, the portfolio yield is 
            compared to the cost of funding the gross loan portfolio with borrowings. 
            Cost of fund should always be less than the portfolio yield.
            Efforts should be made to minimize cost of funds and maximize portfolio yield.
            Comparing the cost of funds to the portfolio yield gives your MFI financial spread.
        </p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-3 col-md-3 col-sm-3" id="side-menu">
        <p> <a href="index.php?page=cost_of_funds"> Cost of Funds </a></p>
        <p> <a href="index.php?page=cost_of_funds_list"> Cost of Funds List </a></p>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9"  id="cost_of_funds-form">
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
                    <th>FINANCIAL EXP ON FUNDING LIABILITIES</th>
                    <th>AVERAGE DEPOSIT</th>
                    <th>AVERAGE BORROWINGS</th>
                    <th>COST OF FUNDS</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                                                    
                    foreach ($costOfFundsRecords as $cOFRec=> $c) {
                        $wherDataArray = array($c['period_id']);
                        $wherFieldArray = array("id");
                        $logic = "";
                        $managementReportPeriodRecords = $managementReportPeriod->select($wherDataArray, 
                                                                                $wherFieldArray, $logic);
                ?>
                        <tr>
                            <td><?php echo $managementReportPeriodRecords[0]['from_date']." to ".$managementReportPeriodRecords[0]['to_date']; ?></td>
                            <td><?php echo $c['financial_expense_on_funding_liabilities']; ?></td>
                            <td><?php echo $c['average_deposit']; ?></td>
                            <td><?php echo $c['average_borrowings']; ?></td>
                            <td><?php 
                                    $cost_of_funds = 
                                    $c['financial_expense_on_funding_liabilities']/
                                    ($c['average_deposit'] + $c['average_borrowings']);
                                    $cost_of_funds_array = explode(".",$cost_of_funds);
                                    $whole_number = $cost_of_funds_array[0];
                                    $decimal_part = 0;
                                    if (@$cost_of_funds_array[1])
                                        $decimal_part = substr($cost_of_funds_array[1],0,2);
                                    echo $whole_number.".".$decimal_part;
                                ?>
                            </td>

                            <td class="status-check">
                                <?php 
                                    if ($c['status'] == 1) {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$c['id']; ?>" id="<?php echo "status".$c['id']; ?>" 
                                            checked="checked"  class="glyph-button" onclick="updateStatus(0, 'CostOfFunds', <?php echo $c['id']; ?> )"/>
                            `   <?php
                                                            }
                                    else {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$c['id']; ?>" id="<?php echo "status".$c['id']; ?>" 
                                            class="glyph-button" onclick="updateStatus(1, 'CostOfFunds', <?php echo $c['id']; ?> )"/>
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
                        <th>FINANCIAL EXP ON FUNDING LIABILITIES</th>
                        <th>AVERAGE DEPOSIT</th>
                        <th>AVERAGE BORROWINGS</th>
                        <th>COST OF FUNDS</th>
                        <th>STATUS</th>
                    </tr>
                </tfoot>
        </table>
    </div>
</div>

