<?php
    require_once '../models/OperationalSelfSufficiency.php';
    require_once '../models/FinancialSelfSufficiency.php';
    require_once '../models/AdjustedReturnOnAssets.php';
    require_once '../models/AdjustedReturnOnEquity.php';
    require_once '../models/YieldOnGrossPortfolio.php';
    require_once '../models/PortfolioToAsset.php';
    require_once '../models/CostOfFunds.php';
    require_once '../models/DebtToEquity.php';
    require_once '../models/LiquidityRatio.php';
    require_once '../models/PortfolioAtRisk.php';
    require_once '../models/WriteOffRatio.php';
    require_once '../models/CostPerClient.php';
    require_once '../models/ManagementReportPeriod.php';
    

    session_start();

    $status = $_GET['status'];
    $tableName = $_GET['tableName'];
    $id = $_GET['recordId'];
    
    $modelObject = null;
    $redirectLoc = '';
    $activity_feature = '';
    $datetime = date('m/d/y h:i:s');
    $datetimeArray = explode(" ", $datetime);
    $date = $datetimeArray[0];
    $time = $datetimeArray[1];
    if ($tableName == 'OperationalSelfSufficiency') {
        $modelObject = new OperationalSelfSufficiency();
        $redirectLoc = "Location: ../admin/index.php?page=operational_self_sufficiency_list";
    }
    else if ($tableName == 'ManagementReportPeriod') {
        $modelObject = new ManagementReportPeriod();
        $redirectLoc = "Location: ../admin/index.php?page=period_list";
    }
    else if ($tableName == 'FinancialSelfSufficiency') {
        $modelObject = new FinancialSelfSufficiency();
        $redirectLoc = "Location: ../admin/index.php?page=financial_self_sufficiency_list";
    }
    else if ($tableName == 'AdjustedReturnOnAssets') {
        $modelObject = new AdjustedReturnOnAssets();
        $redirectLoc = "Location: ../admin/index.php?page=adjusted_return_on_assets_list";
    }
    else if ($tableName == 'AdjustedReturnOnEquity') {
        $modelObject = new AdjustedReturnOnEquity();
        $redirectLoc = "Location: ../admin/index.php?page=adjusted_return_on_equity_list";
    }
    else if ($tableName == 'YieldOnGrossPortfolio') {
        $modelObject = new YieldOnGrossPortfolio();
        $redirectLoc = "Location: ../admin/index.php?page=yield_on_gross_portfolio_list";
    }
    else if ($tableName == 'PortfolioToAsset') {
        $modelObject = new PortfolioToAsset();
        $redirectLoc = "Location: ../admin/index.php?page=portfolio_to_asset_list";
    }
    else if ($tableName == 'CostOfFunds') {
        $modelObject = new CostOfFunds();
        $redirectLoc = "Location: ../admin/index.php?page=cost_of_funds_list";
    }
    else if ($tableName == 'DebtToEquity') {
        $modelObject = new DebtToEquity();
        $redirectLoc = "Location: ../admin/index.php?page=debt_to_equity_list";
    }
    else if ($tableName == 'LiquidityRatio') {
        $modelObject = new LiquidityRatio();
        $redirectLoc = "Location: ../admin/index.php?page=liquidity_ratio_list";
    }
    else if ($tableName == 'PortfolioAtRisk') {
        $modelObject = new PortfolioAtRisk();
        $redirectLoc = "Location: ../admin/index.php?page=portfolio_at_risk_list";
    }
    else if ($tableName == 'WriteOffRatio') {
        $modelObject = new WriteOffRatio();
        $redirectLoc = "Location: ../admin/index.php?page=write_off_ratio_list";
    }
    else if ($tableName == 'CostPerClient') {
        $modelObject = new CostPerClient();
        $redirectLoc = "Location: ../admin/index.php?page=cost_per_client_list";
    }
    $modelObjectUpdateResult = $modelObject->update(array('status'), array($status, $id), array('id'),'');
    
    if ($modelObjectUpdateResult ) {
        $_SESSION['success'] = 1;
    } 
    else {
        $_SESSION['success'] = 0;
    }
    header($redirectLoc);
    


?>