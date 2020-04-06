<?php
    require_once '../models/YieldOnGrossPortfolio.php';
    require_once '../models/ManagementReportPeriod.php';
    require_once "../config/session_manager.php";
    checkTimeOut();
    if ($_SESSION['timed_out']) {
        header("Location:../index.php");
    }
    
    //retrieve the records on database
    $yieldOnGrossPortfolio = new YieldOnGrossPortfolio();
    $whereDataArray = array();
    $whereFieldArray = array();
    $logic = "";
    $yieldOnGrossPortfolioRecords = $yieldOnGrossPortfolio->select($whereDataArray, 
                                                                                $whereFieldArray, $logic);
    $managementReportPeriod = new ManagementReportPeriod();

?>
<div class="row" id="yield_on_gross_portfolio">
    <div class="col-lg-3 col-md-3 col-sm-3" id="yield_on_gross_portfolio-label">
        <h2>Yield On Gross Portfolio List</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="yield_on_gross_portfolio-text">
        <p> Portfolio Yield or Yield on Gross Portfolio is the ability of the MFI 
                to generate cash for her operations from the Gross Loan Portfolio. 
                Portfolio Yield should be compared against effective interest rate of loans; 
                if the yield is significantly/consistently lower than the effective interest rate, 
                it means the MFI has a problem with Loan collections.</p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-3 col-md-3 col-sm-3" id="side-menu">
        <p> <a href="index.php?page=yield_on_gross_portfolio"> Yield On Gross Portfolio </a></p>
        <p> <a href="index.php?page=yield_on_gross_portfolio_list"> Yield On Gross Portfolio List </a></p>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9"  id="yield_on_gross_portfolio-form">
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
                    <th>CASH FROM GROSS LOAN PORTFOLIO</th>
                    <th>AVERAGE GROSS LOAN PORTFOLIO</th>
                    <th>YIELD ON GROSS PORTFOLIO</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                                                    
                    foreach ($yieldOnGrossPortfolioRecords as $yOGPRec=> $y) {
                        $wherDataArray = array($y['period_id']);
                        $wherFieldArray = array("id");
                        $logic = "";
                        $managementReportPeriodRecords = $managementReportPeriod->select($wherDataArray, 
                                                                                $wherFieldArray, $logic);
                ?>
                        <tr>
                            <td><?php echo $managementReportPeriodRecords[0]['from_date']." to ".$managementReportPeriodRecords[0]['to_date']; ?></td>
                            <td><?php echo $y['cash_from_gross_loan_portfolio']; ?></td>
                            <td><?php echo $y['average_gross_loan_portfolio']; ?></td>
                            <td><?php 
                                    $yield_on_gross_portfolio = 
                                    $y['cash_from_gross_loan_portfolio']/$y['average_gross_loan_portfolio'];
                                    $yield_on_gross_portfolio_array = explode(".",$yield_on_gross_portfolio);
                                    $whole_number = $yield_on_gross_portfolio_array[0];
                                    $decimal_part = 0;
                                    if (@$yield_on_gross_portfolio_array[1])
                                            $decimal_part = substr($yield_on_gross_portfolio_array[1],0,2);
                                    echo $whole_number.".".$decimal_part;
                                ?>
                            </td>

                            <td class="status-check">
                                <?php 
                                    if ($y['status'] == 1) {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$y['id']; ?>" id="<?php echo "status".$y['id']; ?>" 
                                            checked="checked"  class="glyph-button" onclick="updateStatus(0, 'YieldOnGrossPortfolio', <?php echo $y['id']; ?> )"/>
                            `   <?php
                                                            }
                                    else {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$y['id']; ?>" id="<?php echo "status".$y['id']; ?>" 
                                            class="glyph-button" onclick="updateStatus(1, 'YieldOnGrossPortfolio', <?php echo $y['id']; ?> )"/>
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
                        <th>CASH FROM GROSS LOAN PORTFOLIO</th>
                        <th>AVERAGE GROSS LOAN PORTFOLIO</th>
                        <th>YIELD ON GROSS PORTFOLIO</th>
                        <th>STATUS</th>
                    </tr>
                </tfoot>
        </table>
    </div>
</div>

