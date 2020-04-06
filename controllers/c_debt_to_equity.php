<?php
    require_once '../models/DebtToEquity.php';

    session_start();

    $period_id = $_POST['period_id'];
    $liabilities = $_POST['liabilities'];
    $equity = $_POST['equity'];
    
    $datetime = date('m/d/y h:i:s');
    $datetimeArray = explode(" ", $datetime);
    $date = $datetimeArray[0];
    $status = 1;

    $debtToEquity = new DebtToEquity();
    
    $dataArray = array ($period_id, $liabilities, $equity, $date, $status);

    $dataType = array(PDO::PARAM_INT, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_INT );

    $success = $debtToEquity->insert($dataArray, $dataType);


    if ($success) {
        $_SESSION['success'] = 1;
    }
    else {
        $_SESSION['success'] = 0;
    }
    header("Location: ../admin/index.php?page=debt_to_equity");
?>