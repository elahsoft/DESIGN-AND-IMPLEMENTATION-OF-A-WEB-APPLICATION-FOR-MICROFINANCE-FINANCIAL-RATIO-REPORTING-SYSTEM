<?php
    require_once '../models/YieldOnGrossPortfolio.php';
    require_once '../models/ManagementReportPeriod.php';

    session_start();

    $period_id = $_POST['period_id'];

    $cash_from_gross_loan_portfolio = $_POST['cash_from_gross_loan_portfolio'];
    $average_gross_loan_portfolio = $_POST['average_gross_loan_portfolio'];
    
    $datetime = date('m/d/y h:i:s');
    $datetimeArray = explode(" ", $datetime);
    $date = $datetimeArray[0];
    $status = 1;

    $yieldOnGrossPortfolio = new YieldOnGrossPortfolio();
    
    $dataArray = array ($period_id, $cash_from_gross_loan_portfolio, $average_gross_loan_portfolio, $date, $status);

    $dataType = array(PDO::PARAM_INT, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_INT );

    $success = $yieldOnGrossPortfolio->insert($dataArray, $dataType);


    if ($success) {
        $_SESSION['success'] = 1;
    }
    else {
        $_SESSION['success'] = 0;
    }
    header("Location: ../admin/index.php?page=yield_on_gross_portfolio");
?>