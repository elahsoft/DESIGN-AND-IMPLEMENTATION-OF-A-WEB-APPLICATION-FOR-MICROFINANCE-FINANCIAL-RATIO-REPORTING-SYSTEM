<?php
    require_once '../models/LiquidityRatio.php';

    session_start();

    $period_id = $_POST['period_id'];

    $cash = $_POST['cash'];
    $trade_investments = $_POST['trade_investments'];
    $demand_deposits = $_POST['demand_deposits'];
    $short_term_time_deposits = $_POST['short_term_time_deposits'];
    $int_payable_funding_lia = $_POST['int_payable_funding_lia'];
    $accounts_payable = $_POST['accounts_payable'];
    $other_current_liabilities = $_POST['other_current_liabilities'];
    
    $datetime = date('m/d/y h:i:s');
    $datetimeArray = explode(" ", $datetime);
    $date = $datetimeArray[0];
    $status = 1;

    $liquidityRatio = new LiquidityRatio();
    
    $dataArray = array ($period_id, $cash, $trade_investments, $demand_deposits, 
                        $short_term_time_deposits, $int_payable_funding_lia, 
                        $accounts_payable, $other_current_liabilities, $date, $status);

    $dataType = array(PDO::PARAM_INT, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, 
                        PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, 
                        PDO::PARAM_INT );

    $success = $liquidityRatio->insert($dataArray, $dataType);


    if ($success) {
        $_SESSION['success'] = 1;
    }
    else {
        $_SESSION['success'] = 0;
    }
    header("Location: ../admin/index.php?page=liquidity_ratio");
?>