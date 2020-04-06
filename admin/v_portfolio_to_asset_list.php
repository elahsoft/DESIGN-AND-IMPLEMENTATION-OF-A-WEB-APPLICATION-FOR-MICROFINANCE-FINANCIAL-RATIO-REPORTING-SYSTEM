<?php
    require_once '../models/PortfolioToAsset.php';
    require_once '../models/ManagementReportPeriod.php';
    require_once "../config/session_manager.php";
    checkTimeOut();
    if ($_SESSION['timed_out']) {
        header("Location:../index.php");
    }
    
    //retrieve the records on database
    $portfolioToAsset = new PortfolioToAsset();
    $whereDataArray = array();
    $whereFieldArray = array();
    $logic = "";
    $portfolioToAssetRecords = $portfolioToAsset->select($whereDataArray, 
                                                                                $whereFieldArray, $logic);
    $managementReportPeriod = new ManagementReportPeriod();

?>
<div class="row" id="portfolio_to_asset">
    <div class="col-lg-3 col-md-3 col-sm-3" id="portfolio_to_asset-label">
        <h2>Portfolio To Asset List</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="portfolio_to_asset-text">
        <p>  Portfolio to Assets indicates how well the MFI is allocating 
            her assets to granting of loans to micro-entrepreneurs.</p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-3 col-md-3 col-sm-3" id="side-menu">
        <p> <a href="index.php?page=portfolio_to_asset"> Portfolio to Asset Ratio </a></p>
        <p> <a href="index.php?page=portfolio_to_asset_list"> Portfolio to Asset Ratio List </a></p>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9"  id="portfolio_to_asset-form">
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
                    <th>GROSS LOAN PORTFOLIO</th>
                    <th>ASSET</th>
                    <th>PORTFOLIO TO ASSET RATIO</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                                                    
                    foreach ($portfolioToAssetRecords as $pTARec=> $p) {
                        $wherDataArray = array($p['period_id']);
                        $wherFieldArray = array("id");
                        $logic = "";
                        $managementReportPeriodRecords = $managementReportPeriod->select($wherDataArray, 
                                                                                $wherFieldArray, $logic);
                ?>
                        <tr>
                            <td><?php echo $managementReportPeriodRecords[0]['from_date']." to ".$managementReportPeriodRecords[0]['to_date']; ?></td>
                            <td><?php echo $p['gross_loan_portfolio']; ?></td>
                            <td><?php echo $p['assets']; ?></td>
                            <td><?php 
                                    $portfolio_to_asset = 
                                    $p['gross_loan_portfolio']/$p['assets'];
                                    $portfolio_to_asset_array = explode(".",$portfolio_to_asset);
                                    $whole_number = $portfolio_to_asset_array[0];
                                    $decimal_part = 0;
                                    if (@$portfolio_to_asset_array[1])
                                            $decimal_part = substr($portfolio_to_asset_array[1],0,2);
                                    echo $whole_number.".".$decimal_part;
                                ?>
                            </td>

                            <td class="status-check">
                                <?php 
                                    if ($p['status'] == 1) {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$p['id']; ?>" id="<?php echo "status".$p['id']; ?>" 
                                            checked="checked"  class="glyph-button" onclick="updateStatus(0, 'PortfolioToAsset', <?php echo $p['id']; ?> )"/>
                            `   <?php
                                                            }
                                    else {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$p['id']; ?>" id="<?php echo "status".$p['id']; ?>" 
                                            class="glyph-button" onclick="updateStatus(1, 'PortfolioToAsset', <?php echo $p['id']; ?> )"/>
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
                        <th>GROSS LOAN PORTFOLIO</th>
                        <th>ASSET</th>
                        <th>PORTFOLIO TO ASSET RATIO</th>
                        <th>STATUS</th>
                    </tr>
                </tfoot>
        </table>
    </div>
</div>

