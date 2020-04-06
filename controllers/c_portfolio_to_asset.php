<?php
    require_once '../models/PortfolioToAsset.php';

    session_start();

    $period_id = $_POST['period_id'];

    $gross_loan_portfolio = $_POST['gross_loan_portfolio'];
    $assets = $_POST['assets'];
    
    $datetime = date('m/d/y h:i:s');
    $datetimeArray = explode(" ", $datetime);
    $date = $datetimeArray[0];
    $status = 1;

    $portfolioToAsset = new PortfolioToAsset();
    
    $dataArray = array ($period_id, $gross_loan_portfolio, $assets, $date, $status);

    $dataType = array(PDO::PARAM_INT, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_INT );

    $success = $portfolioToAsset->insert($dataArray, $dataType);


    if ($success) {
        $_SESSION['success'] = 1;
    }
    else {
        $_SESSION['success'] = 0;
    }
    header("Location: ../admin/index.php?page=portfolio_to_asset");
?>