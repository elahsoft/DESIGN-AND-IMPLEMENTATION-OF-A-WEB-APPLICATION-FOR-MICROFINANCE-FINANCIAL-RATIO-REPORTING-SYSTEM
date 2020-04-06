<?php
    require_once '../models/AdjustedReturnOnAssets.php';

    session_start();

    $period_id = $_POST['period_id'];
    
    $adjusted_net_operating_income = $_POST['adjusted_net_operating_income'];
    $taxes = $_POST['taxes'];
    $adjusted_average_assets = $_POST['adjusted_average_assets'];
    
    $datetime = date('m/d/y h:i:s');
    $datetimeArray = explode(" ", $datetime);
    $date = $datetimeArray[0];
    $status = 1;

    $adjustedReturnOnAssets = new AdjustedReturnOnAssets();
    
    $dataArray = array ($period_id, $adjusted_net_operating_income, $taxes, $adjusted_average_assets,
     $date, $status);

    $dataType = array(PDO::PARAM_INT, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, 
    PDO::PARAM_STR, PDO::PARAM_INT );

    $success = $adjustedReturnOnAssets->insert($dataArray, $dataType);


    if ($success) {
        $_SESSION['success'] = 1;
    }
    else {
        $_SESSION['success'] = 0;
    }
    header("Location: ../admin/index.php?page=adjusted_return_on_assets");
?>