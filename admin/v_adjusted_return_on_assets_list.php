<?php
    require_once '../models/AdjustedReturnOnAssets.php';
    require_once '../models/ManagementReportPeriod.php';
    require_once "../config/session_manager.php";
    checkTimeOut();
    if ($_SESSION['timed_out']) {
        header("Location:../index.php");
    }
    
    //retrieve the records on database
    $adjustedReturnOnAssets = new AdjustedReturnOnAssets();
    $whereDataArray = array();
    $whereFieldArray = array();
    $logic = "";
    $adjustedReturnOnAssetsRecords = $adjustedReturnOnAssets->select($whereDataArray, 
                                                                                $whereFieldArray, $logic);
    $managementReportPeriod = new ManagementReportPeriod();

?>
<div class="row" id="adjusted_return_on_assets">
    <div class="col-lg-3 col-md-3 col-sm-3" id="adjusted_return_on_assets-label">
        <h2>Adjusted Return On Assets List</h2>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9" id="adjusted_return_on_assets-text">
        <p> This Module assists you to document and prepare your Return on Assets. Return On Assets 
        shows how efficiently the assets of the bank are used to generate profits relative to inflation. 
        Net Operating Income and Average assets are adjusted by the inflation rate. Adjusted 
        Return On Assets is Return On Assets adjusted by inflation. It should be positive.</p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-3 col-md-3 col-sm-3" id="side-menu">
    <p> <a href="index.php?page=adjusted_return_on_assets"> Adjusted Return On Assets </a></p>
        <p> <a href="index.php?page=adjusted_return_on_assets_list"> Adjusted Return On Assets List </a></p>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9"  id="adjusted_return_on_assets-form">
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
                    <th>ADJUSTED NET OPERATING INCOME</th>
                    <th>TAXES</th>
                    <th>ADJUSTED AVERAGE ASSETS</th>
                    <th>ADJUSTED RETURN ON ASSETS</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                                                    
                    foreach ($adjustedReturnOnAssetsRecords as $aROARec=> $a) {
                        $wherDataArray = array($a['period_id']);
                        $wherFieldArray = array("id");
                        $logic = "";
                        $managementReportPeriodRecords = $managementReportPeriod->select($wherDataArray, 
                                                                                $wherFieldArray, $logic);
                ?>
                        <tr>
                            <td><?php echo $a['date']; ?> </td>
                            <td><?php echo $managementReportPeriodRecords[0]['from_date']." to ".$managementReportPeriodRecords[0]['to_date']; ?></td>
                            <td>
                                <?php 
                                    echo $a['adjusted_net_operating_income'];
                                ?>
                            </td>
                            <td>
                                <?php 
                                   echo $a['taxes'];
                                ?>
                            </td>
                            <td><?php echo $a['adjusted_average_assets']; ?></td>
                            <td><?php 
                                    $adjusted_return_on_assets = ($a['adjusted_net_operating_income'] - 
                                    $a['taxes'])/$a['adjusted_average_assets'];
                                    $adjusted_return_on_assets_array = explode(".",$adjusted_return_on_assets);
                                    $whole_number = $adjusted_return_on_assets_array[0];
                                    $decimal_part = 0;
                                    if (@$adjusted_return_on_assets_array[1])
                                        $decimal_part = substr($adjusted_return_on_assets_array[1],0,2);
                                    echo $whole_number.".".$decimal_part;
                                ?>
                            </td>

                            <td class="status-check">
                                <?php 
                                    if ($a['status'] == 1) {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$a['id']; ?>" id="<?php echo "status".$a['id']; ?>" 
                                            checked="checked"  class="glyph-button" onclick="updateStatus(0, 'AdjustedReturnOnAssets', <?php echo $a['id']; ?> )"/>
                            `   <?php
                                                            }
                                    else {
                                ?>
                                        <input type="checkbox" name="<?php echo "status".$a['id']; ?>" id="<?php echo "status".$a['id']; ?>" 
                                            class="glyph-button" onclick="updateStatus(1, 'AdjustedReturnOnAssets', <?php echo $a['id']; ?> )"/>
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
                        <th>ADJUSTED NET OPERATING INCOME</th>
                        <th>TAXES</th>
                        <th>ADJUSTED AVERAGE ASSETS</th>
                        <th>ADJUSTED RETURN ON ASSETS</th>
                        <th>STATUS</th>
                    </tr>
                </tfoot>
        </table>
    </div>
</div>

