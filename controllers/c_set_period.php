<?php
    require_once '../models/ManagementReportPeriod.php';

    session_start();

    $from_period = $_POST['from'];
    $to_period = $_POST['to'];
    
    $datetime = date('m/d/y h:i:s');
    $datetimeArray = explode(" ", $datetime);
    $date = $datetimeArray[0];
    $status = 1;

    $managementReportPeriod = new ManagementReportPeriod();
    
    $dataArray = array ($from_period, $to_period,  $date, $status);

    $dataType = array(PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_INT );

    $success = $managementReportPeriod->insert($dataArray, $dataType);


    if ($success) {
        $_SESSION['success'] = 1;
    }
    else {
        $_SESSION['success'] = 0;
    }
    header("Location: ../admin/index.php?page=set_period");
?>