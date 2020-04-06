<?php
    require_once '../models/AdjustedReturnOnAssets.php';
    require_once '../models/AdjustedReturnOnEquity.php';
    require_once '../models/ManagementReportPeriod.php';
    require_once "../config/session_manager.php";
    checkTimeOut();
    if ($_SESSION['timed_out']) {
        header("Location:../index.php");
    }
    
    //retrieve the records on database
    $adjustedReturnOnEquity = new AdjustedReturnOnEquity();
    $whereDataArray = array();
    $whereFieldArray = array();
    $logic = "";
    $adjustedReturnOnEquityRecords = $adjustedReturnOnEquity->select($whereDataArray, 
                                                                                $whereFieldArray, $logic);
    $managementReportPeriod = new ManagementReportPeriod();
    $adjustedReturnOnAssets = new AdjustedReturnOnAssets();

?>
<div class="row" id="adjusted_return_on_equity">
    <div class="col-lg-3 col-md-3 col-sm-3" id="adjusted_return_on_equity-label">
        <h2>Adjusted Return On Equity List</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="adjusted_return_on_equity-text">
    <p> This Module assists you to document and prepare your Return on Equity. 
        Return on Equity (ROE) is a good indicator of how well the Bank has used retained 
        earnings and donor money to become sustainable. AROE is inflation adjusted ROE.
        <h6> NOTE:</h6>
            When an MFB is consistently reaching FSS greater than 100 percent, managers should pay 
            closer attention to AROE and AROA, which are more commercial measurements of performance.</p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-3 col-md-3 col-sm-3" id="side-menu">
    <p> <a href="index.php?page=adjusted_return_on_equity"> Adjusted Return On Equity </a></p>
        <p> <a href="index.php?page=adjusted_return_on_equity_list"> Adjusted Return On Equity List </a></p>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9"  id="adjusted_return_on_equity-form">
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
                    <th>ADJUSTED NET OPERATING INCOME</th>
                    <th>TAXES</th>
                    <th>ADJUSTED AVERAGE EQUITY</th>
                    <th>ADJUSTED RETURN ON EQUITY</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                                                    
                    foreach ($adjustedReturnOnEquityRecords as $aROERec=> $a) {
                        $wherDataArray = array($a['period_id']);
                        $wherFieldArray = array("id");
                        $logic = "";
                        $managementReportPeriodRecords = $managementReportPeriod->select($wherDataArray, 
                                                                                $wherFieldArray, $logic);
                        $wherFieldArray = array("period_id");
                        $adjustedReturnOnAssetsRecords = $adjustedReturnOnAssets->select($wherDataArray, 
                        $wherFieldArray, $logic);
                ?>
                        <tr>
                            <td><?php echo $managementReportPeriodRecords[0]['from_date']." to ".$managementReportPeriodRecords[0]['to_date']; ?></td>
                            <td>
                                <?php
                                    if (@$adjustedReturnOnAssetsRecords[0]) {
                                        echo $adjustedReturnOnAssetsRecords[0]['adjusted_net_operating_income'];
                                    }
                                    else {
                                        echo 0;
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if (@$adjustedReturnOnAssetsRecords[0]) {
                                        echo $adjustedReturnOnAssetsRecords[0]['taxes'];
                                    }
                                    else {
                                        echo 0;
                                    }
                                ?>
                            </td>
                            <td><?php echo $a['adjusted_average_equity']; ?></td>
                            <td><?php 
                                    $adjusted_return_on_equity = ($adjustedReturnOnAssetsRecords[0]['adjusted_net_operating_income'] - 
                                    $adjustedReturnOnAssetsRecords[0]['taxes'])/$a['adjusted_average_equity'];
                                    $adjusted_return_on_equity_array = explode(".",$adjusted_return_on_equity);
                                    $whole_number = $adjusted_return_on_equity_array[0];
                                    $decimal_part = 0;
                                    if (@$adjusted_return_on_equity_array[1])
                                        $decimal_part = substr($adjusted_return_on_equity_array[1],0,2);
                                    echo $whole_number.".".$decimal_part;
                                ?>
                            </td>

                            <td class="status-check">
                                <?php 
                                    if ($a['status'] == 1) {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$a['id']; ?>" id="<?php echo "status".$a['id']; ?>" 
                                            checked="checked"  class="glyph-button" onclick="updateStatus(0, 'AdjustedReturnOnEquity', <?php echo $a['id']; ?> )"/>
                            `   <?php
                                                            }
                                    else {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$a['id']; ?>" id="<?php echo "status".$a['id']; ?>" 
                                            class="glyph-button" onclick="updateStatus(1, 'AdjustedReturnOnEquity', <?php echo $a['id']; ?> )"/>
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
                        <th>ADJUSTED NET OPERATING INCOME</th>
                        <th>TAXES</th>
                        <th>ADJUSTED AVERAGE EQUITY</th>
                        <th>ADJUSTED RETURN ON EQUITY</th>
                        <th>STATUS</th>
                    </tr>
                </tfoot>
        </table>
    </div>
</div>

