<?php
    require_once '../models/FinancialSelfSufficiency.php';

    session_start();

    $period_id = $_POST['period_id'];

    $average_equity = $_POST['average_equity'];
    $average_fixed_assets = $_POST['average_fixed_assets'];
    $inflation_rate = $_POST['inflation_rate'];
    $average_funding_liabilities = $_POST['average_funding_liabilities'];
    $commercial_rate_for_funds = $_POST['commercial_rate_for_funds'];
    $interest_and_fees_expense = $_POST['interest_and_fees_expense'];
    $gross_loan_losses = $_POST['gross_loan_losses'];
    $lost_interest_deductions = $_POST['lost_interest_deductions'];
    
    $datetime = date('m/d/y h:i:s');
    $datetimeArray = explode(" ", $datetime);
    $date = $datetimeArray[0];
    $status = 1;

    $financialSelfSufficiency = new FinancialSelfSufficiency();
    
    $dataArray = array ($period_id, $average_equity, $average_fixed_assets, $inflation_rate,
     $average_funding_liabilities,
     $commercial_rate_for_funds, $interest_and_fees_expense, $gross_loan_losses, $lost_interest_deductions,
     $date, $status);

    $dataType = array(PDO::PARAM_INT, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, 
    PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR,
    PDO::PARAM_STR, PDO::PARAM_INT );

    $success = $financialSelfSufficiency->insert($dataArray, $dataType);


    if ($success) {
        $_SESSION['success'] = 1;
    }
    else {
        $_SESSION['success'] = 0;
    }
    header("Location: ../admin/index.php?page=financial_self_sufficiency");
?>