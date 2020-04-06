<?php
    require_once '../models/AdjustedReturnOnEquity.php';

    session_start();

    $period_id = $_POST['period_id'];

    $adjusted_average_equity = $_POST['adjusted_average_equity'];
    
    $datetime = date('m/d/y h:i:s');
    $datetimeArray = explode(" ", $datetime);
    $date = $datetimeArray[0];
    $status = 1;

    $adjustedReturnOnEquity = new AdjustedReturnOnEquity();
    
    $dataArray = array ($period_id, $adjusted_average_equity, $date, $status);

    $dataType = array(PDO::PARAM_INT, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_INT );

    $success = $adjustedReturnOnEquity->insert($dataArray, $dataType);


    if ($success) {
        $_SESSION['success'] = 1;
    }
    else {
        $_SESSION['success'] = 0;
    }
    header("Location: ../admin/index.php?page=adjusted_return_on_equity");
?>