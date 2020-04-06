<?php
    require_once '../models/DebtToEquity.php';
    require_once '../models/ManagementReportPeriod.php';
    require_once "../config/session_manager.php";
    checkTimeOut();
    if ($_SESSION['timed_out']) {
        header("Location:../index.php");
    }
    
    //retrieve the records on database
    $debtToEquity = new DebtToEquity();
    $whereDataArray = array();
    $whereFieldArray = array();
    $logic = "";
    $debtToEquityRecords = $debtToEquity->select($whereDataArray, 
                                                                                $whereFieldArray, $logic);
    $managementReportPeriod = new ManagementReportPeriod();

?>
<div class="row" id="debt_to_equity">
    <div class="col-lg-3 col-md-3 col-sm-3" id="debt_to_equity-label">
        <h2>Cost of Funds List</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="debt_to_equity-text">
        <p> This ratio shows safety cushion the bank has to absorb losses before creditors 
            are at risk. It also shows how well the MFB is able to leverage its Equity to increase 
            assets through borrowing. It is advisable not to have a leverage ratio that is not more than 1:2.
        </p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-3 col-md-3 col-sm-3" id="side-menu">
        <p> <a href="index.php?page=debt_to_equity"> Debt To Equity </a></p>
        <p> <a href="index.php?page=debt_to_equity_list"> Debt To Equity List </a></p>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9"  id="debt_to_equity-form">
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
                    <th>LIABILITIES</th>
                    <th>EQUITY</th>
                    <th>DEBT TO EQUITY</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                                                    
                    foreach ($debtToEquityRecords as $dTERec=> $d) {
                        $wherDataArray = array($d['period_id']);
                        $wherFieldArray = array("id");
                        $logic = "";
                        $managementReportPeriodRecords = $managementReportPeriod->select($wherDataArray, 
                                                                                $wherFieldArray, $logic);
                ?>
                        <tr>
                            <td><?php echo $managementReportPeriodRecords[0]['from_date']." to ".$managementReportPeriodRecords[0]['to_date']; ?></td>
                            <td><?php echo $d['liabilities']; ?></td>
                            <td><?php echo $d['equity']; ?></td>
                            <td><?php 
                                    $debt_to_equity = 
                                    $d['liabilities']/$d['equity'];
                                    $debt_to_equity_array = explode(".",$debt_to_equity);
                                    $whole_number = $debt_to_equity_array[0];
                                    $decimal_part = 0;
                                    if (@$debt_to_equity_array[1])
                                        $decimal_part = substr($debt_to_equity_array[1],0,2);
                                    echo $whole_number.".".$decimal_part;
                                ?>
                            </td>

                            <td class="status-check">
                                <?php 
                                    if ($d['status'] == 1) {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$d['id']; ?>" id="<?php echo "status".$d['id']; ?>" 
                                            checked="checked"  class="glyph-button" onclick="updateStatus(0, 'DebtToEquity', <?php echo $d['id']; ?> )"/>
                            `   <?php
                                                            }
                                    else {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$d['id']; ?>" id="<?php echo "status".$d['id']; ?>" 
                                            class="glyph-button" onclick="updateStatus(1, 'DebtToEquity', <?php echo $d['id']; ?> )"/>
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
                        <th>LIABILITIES</th>
                        <th>EQUITY</th>
                        <th>DEBT TO EQUITY</th>
                        <th>STATUS</th>
                    </tr>
                </tfoot>
        </table>
    </div>
</div>

