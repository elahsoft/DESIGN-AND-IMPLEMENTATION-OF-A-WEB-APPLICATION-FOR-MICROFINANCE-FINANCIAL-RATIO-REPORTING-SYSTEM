<?php
    require_once '../models/PortfolioAtRisk.php';
    require_once '../models/PortfolioToAsset.php';
    require_once '../models/ManagementReportPeriod.php';
    require_once "../config/session_manager.php";
    checkTimeOut();
    if ($_SESSION['timed_out']) {
        header("Location:../index.php");
    }
    
    //retrieve the records on database
    $portfolioAtRisk = new PortfolioAtRisk();
    $whereDataArray = array();
    $whereFieldArray = array();
    $logic = "";
    $portfolioAtRiskRecords = $portfolioAtRisk->select($whereDataArray, 
                                                                                $whereFieldArray, $logic);
    $managementReportPeriod = new ManagementReportPeriod();
    $portfolioToAsset= new PortfolioToAsset();
    $gross_loan_portfolio = 0;

?>
<div class="row" id="portfolio_at_risk">
    <div class="col-lg-3 col-md-3 col-sm-3" id="portfolio_at_risk-label">
        <h2>Portfolio At Risk List</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="portfolio_at_risk-text">
        <p>  It indicates the potential for future losses based on the current performance of the loan portfolio. 
            Best practice and regulatory threshold for Nigeria requires that the Portfolio at Risk for MFBs should 
            not exceed 2.5%.</p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-3 col-md-3 col-sm-3" id="side-menu">
        <p> <a href="index.php?page=portfolio_at_risk">Portfolio at Risk </a></p>
        <p> <a href="index.php?page=portfolio_at_risk_list"> Portfolio at Risk List </a></p>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9"  id="portfolio_at_risk-form">
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
                    <th>SUM of PRIN. OUTSTANDING ON ALL PAST-DUE LOANS</th>
                    <th>RENEGOTIATED LOANS</th>
                    <th>GROSS LOAN PORTFOLIO</th>
                    <th>PORTFOLIO AT RISK</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                                                    
                    foreach ($portfolioAtRiskRecords as $pARRec=> $p) {
                        $wherDataArray = array($p['period_id']);
                        $wherFieldArray = array("id");
                        $logic = "";
                        $managementReportPeriodRecords = $managementReportPeriod->select($wherDataArray, 
                                                                                $wherFieldArray, $logic);
                ?>
                        <tr>
                            <td><?php echo $managementReportPeriodRecords[0]['from_date']." to ".$managementReportPeriodRecords[0]['to_date']; ?></td>
                            <td><?php echo $p['principal_outstanding_on_all_past_due_loans']; ?></td>
                            <td><?php echo $p['renegotiated_loans']; ?></td>
                            <td><?php
                                    $wherDataArray = array($p['period_id']);
                                    $wherFieldArray = array("id");
                                    $logic = "";
                                    $portfolioToAssetRecord = $portfolioToAsset->select($wherDataArray, 
                                    $wherFieldArray, $logic);
                                    if (@$portfolioToAssetRecord[0]) {
                                        $gross_loan_portfolio = 
                                            $portfolioToAssetRecord[0]['gross_loan_portfolio'];
                                        echo $gross_loan_portfolio;
                                    }
                                    else {
                                        echo 0;
                                    }
                                ?>
                             </td>
                            <td><?php 
                                    $portfolio_at_risk = 
                                    ($p['principal_outstanding_on_all_past_due_loans'] + 
                                        $p['renegotiated_loans'])/$gross_loan_portfolio;
                                    if ($portfolio_at_risk > 0) { 
                                        $portfolio_at_risk_array = explode(".",$portfolio_at_risk);
                                        $whole_number = $portfolio_at_risk_array[0];
                                        $decimal_part = 0;
                                        if (@$portfolio_at_risk_array[1])
                                                $decimal_part = substr($portfolio_at_risk_array[1],0,2);
                                        echo $whole_number.".".$decimal_part;
                                    }
                                    else {
                                        echo 0;
                                    }
                                ?>
                            </td>

                            <td class="status-check">
                                <?php 
                                    if ($p['status'] == 1) {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$p['id']; ?>" id="<?php echo "status".$p['id']; ?>" 
                                            checked="checked"  class="glyph-button" onclick="updateStatus(0, 'PortfolioAtRisk', <?php echo $p['id']; ?> )"/>
                            `   <?php
                                                            }
                                    else {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$p['id']; ?>" id="<?php echo "status".$p['id']; ?>" 
                                            class="glyph-button" onclick="updateStatus(1, 'PortfolioAtRisk', <?php echo $p['id']; ?> )"/>
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
                        <th>SUM of PRIN. OUTSTANDING ON ALL PAST-DUE LOANS</th>
                        <th>RENEGOTIATED LOANS</th>
                        <th>GROSS LOAN PORTFOLIO</th>
                        <th>PORTFOLIO AT RISK</th>
                        <th>STATUS</th>
                    </tr>
                </tfoot>
        </table>
    </div>
</div>

