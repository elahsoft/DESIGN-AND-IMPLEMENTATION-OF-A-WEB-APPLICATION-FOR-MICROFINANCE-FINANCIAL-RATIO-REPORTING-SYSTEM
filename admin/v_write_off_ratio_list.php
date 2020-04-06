<?php
    require_once '../models/WriteOffRatio.php';
    require_once '../models/YieldOnGrossPortfolio.php';
    require_once '../models/ManagementReportPeriod.php';
    require_once "../config/session_manager.php";
    checkTimeOut();
    if ($_SESSION['timed_out']) {
        header("Location:../index.php");
    }
    
    //retrieve the records on database
    $writeOffRatio = new WriteOffRatio();
    $whereDataArray = array();
    $whereFieldArray = array();
    $logic = "";
    $writeOffRatioRecords = $writeOffRatio->select($whereDataArray, 
                                                                                $whereFieldArray, $logic);
    $managementReportPeriod = new ManagementReportPeriod();
    
?>
<div class="row" id="write_off_ratio">
    <div class="col-lg-3 col-md-3 col-sm-3" id="write_off_ratio-label">
        <h2>Write-Off Ratio List</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="write_off_ratio-text">
        <p>  Write-off ratio shows the past quality of the gross loan portfolio. 
            A high ratio indicates a problem in the MFB’s collection efforts.
        </p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-3 col-md-3 col-sm-3" id="side-menu">
        <p> <a href="index.php?page=write_off_ratio">Write Off Ratio </a></p>
        <p> <a href="index.php?page=write_off_ratio_list"> Write Off Ratio List </a></p>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9"  id="write_off_ratio-form">
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
                    <th>VALUE OF LOANS WRITTEN OFF</th>
                    <th>AVERAGE GROSS LOAN PORTFOLIO</th>
                    <th>WRITE-OFF RATIO</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                                                    
                    foreach ($writeOffRatioRecords as $wORRec=> $w) {
                        $wherDataArray = array($w['period_id']);
                        $wherFieldArray = array("id");
                        $logic = "";
                        $managementReportPeriodRecords = $managementReportPeriod->select($wherDataArray, 
                                                                                $wherFieldArray, $logic);
                ?>
                        <tr>
                            <td><?php echo $managementReportPeriodRecords[0]['from_date']." to ".$managementReportPeriodRecords[0]['to_date']; ?></td>
                            <td><?php echo $w['value_of_loans_written_off']; ?></td>
                            <td><?php 
                                $wherDataArray = array($w['period_id']);
                                $wherFieldArray = array("period_id");
                                $yieldOnGrossPortfolio = new YieldOnGrossPortfolio();
                                $yieldOnGrossPortfolioRecords = $yieldOnGrossPortfolio->select($wherDataArray, 
                                                                                $wherFieldArray, $logic);
                                if (@$yieldOnGrossPortfolioRecords[0])
                                    echo $yieldOnGrossPortfolioRecords[0]['average_gross_loan_portfolio'];
                                else
                                    echo 0;
                                ?>
                            </td>
                            <td><?php 
                                    if ($yieldOnGrossPortfolioRecords[0])
                                        $write_off_ratio = 
                                            $w['value_of_loans_written_off']/$yieldOnGrossPortfolioRecords[0]['average_gross_loan_portfolio'];
                                    else
                                        $write_off_ratio = 0;
                                    echo $write_off_ratio;
                                ?>
                            </td>

                            <td class="status-check">
                                <?php 
                                    if ($w['status'] == 1) {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$w['id']; ?>" id="<?php echo "status".$w['id']; ?>" 
                                            checked="checked"  class="glyph-button" onclick="updateStatus(0, 'WriteOffRatio', <?php echo $w['id']; ?> )"/>
                            `   <?php
                                                            }
                                    else {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$w['id']; ?>" id="<?php echo "status".$w['id']; ?>" 
                                            class="glyph-button" onclick="updateStatus(1, 'WriteOffRatio', <?php echo $w['id']; ?> )"/>
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
                        <th>VALUE OF LOANS WRITTEN OFF</th>
                        <th>AVERAGE GROSS LOAN PORTFOLIO</th>
                        <th>WRITE-OFF RATIO</th>
                        <th>STATUS</th>
                    </tr>
                </tfoot>
        </table>
    </div>
</div>

