<?php
    require_once '../models/CostOfFunds.php';

    session_start();

    $period_id = $_POST['period_id'];

    $financial_expense_on_funding_liabilities = $_POST['financial_expense_on_funding_liabilities'];
    $average_deposit = $_POST['average_deposit'];
    $average_borrowings = $_POST['average_borrowings'];

    $datetime = date('m/d/y h:i:s');
    $datetimeArray = explode(" ", $datetime);
    $date = $datetimeArray[0];
    $status = 1;

    $costOfFunds = new CostOfFunds();
    
    $dataArray = array ($period_id, $financial_expense_on_funding_liabilities, $average_deposit, 
    $average_borrowings, $date, $status);

    $dataType = array(PDO::PARAM_INT, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_INT );

    $success = $costOfFunds->insert($dataArray, $dataType);


    if ($success) {
        $_SESSION['success'] = 1;
    }
    else {
        $_SESSION['success'] = 0;
    }
    header("Location: ../admin/index.php?page=cost_of_funds");
?>