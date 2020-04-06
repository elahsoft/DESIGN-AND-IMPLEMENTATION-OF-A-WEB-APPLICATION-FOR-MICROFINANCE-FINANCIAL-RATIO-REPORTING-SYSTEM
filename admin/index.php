<?php
session_start();
$page = @$_GET['page'];
    if (@$_SESSION['logged-in']) {
        require_once '../templates/header.php';
        if ($page == "" || $page == "index" || $page== "dashboard")
            require_once 'dashboard.php';
        else if ($page == "sustainability_profitability")
            require_once 'v_sustainability_profitability.php';
        else if ($page == "asset_liability_management")
            require_once 'v_asset_liability_management.php';
        else if ($page == "portfolio_quality")
            require_once 'v_portfolio_quality.php';
        else if ($page == "efficiency_ratio")
            require_once 'v_efficiency_ratio.php';
        else if ($page == "operational_self_sufficiency")
            require_once 'v_operational_self_sufficiency.php';
        else if ($page == "operational_self_sufficiency_list")
            require_once 'v_operational_self_sufficiency_list.php';
        else if ($page == "financial_self_sufficiency")
            require_once 'v_financial_self_sufficiency.php';
        else if ($page == "financial_self_sufficiency_list")
            require_once 'v_financial_self_sufficiency_list.php';
        else if ($page == "set_period")
            require_once 'v_set_period.php';
        else if ($page == "period_list")
            require_once 'v_period_list.php';
        else if ($page == 'adjusted_return_on_assets')
            require_once 'v_adjusted_return_on_assets.php';
        else if ($page == 'adjusted_return_on_assets_list')
            require_once 'v_adjusted_return_on_assets_list.php';
        else if ($page == 'adjusted_return_on_equity')
            require_once 'v_adjusted_return_on_equity.php';
        else if ($page == 'adjusted_return_on_equity_list')
            require_once 'v_adjusted_return_on_equity_list.php';
        else if ($page == 'yield_on_gross_portfolio')
            require_once 'v_yield_on_gross_portfolio.php';
        else if ($page == 'yield_on_gross_portfolio_list')
            require_once 'v_yield_on_gross_portfolio_list.php';
        else if ($page == 'portfolio_to_asset')
            require_once 'v_portfolio_to_asset.php';
        else if ($page == 'portfolio_to_asset_list')
            require_once 'v_portfolio_to_asset_list.php';
        else if ($page == 'cost_of_funds')
            require_once 'v_cost_of_funds.php';
        else if ($page == 'cost_of_funds_list')
            require_once 'v_cost_of_funds_list.php';
        else if ($page == 'debt_to_equity')
            require_once 'v_debt_to_equity.php'; 
        else if ($page == 'debt_to_equity_list')
            require_once 'v_debt_to_equity_list.php';
        else if ($page == 'liquidity_ratio')
            require_once 'v_liquidity_ratio.php'; 
        else if ($page == 'liquidity_ratio_list')
            require_once 'v_liquidity_ratio_list.php'; 
        else if ($page == 'portfolio_at_risk')
            require_once 'v_portfolio_at_risk.php'; 
        else if ($page == 'portfolio_at_risk_list')
            require_once 'v_portfolio_at_risk_list.php'; 
        else if ($page == 'write_off_ratio')
            require_once 'v_write_off_ratio.php'; 
        else if ($page == 'write_off_ratio_list')
            require_once 'v_write_off_ratio_list.php';
        else if ($page == 'operating_expense_ratio_list')
            require_once 'v_operating_expense_ratio_list.php';
        else if ($page == 'cost_per_client')
            require_once 'v_cost_per_client.php';
        else if ($page == 'cost_per_client_list')
            require_once 'v_cost_per_client_list.php';
        else if ($page == 'generate_report')
            require_once 'v_generate_report.php';
        else if ($page == 'sign-out')
            header("Location:../signout.php");
        else 
            require_once 'dashboard.php';
        
        require_once '../templates/footer.php';
    } 
    else {
        header("Location:../index.php");
    }
?>