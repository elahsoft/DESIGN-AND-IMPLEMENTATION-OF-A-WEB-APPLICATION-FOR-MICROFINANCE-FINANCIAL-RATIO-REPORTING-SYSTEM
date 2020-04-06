<?php
    require_once '../models/WriteOffRatio.php';

    session_start();

    $period_id = $_POST['period_id'];

    $value_of_loans_written_off = $_POST['value_of_loans_written_off'];
        
    $datetime = date('m/d/y h:i:s');
    $datetimeArray = explode(" ", $datetime);
    $date = $datetimeArray[0];
    $status = 1;

    $writeOffRatio = new WriteOffRatio();
    
    $dataArray = array ($period_id, $value_of_loans_written_off, $date, $status);

    $dataType = array(PDO::PARAM_INT, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_INT );

    $success = $writeOffRatio->insert($dataArray, $dataType);


    if ($success) {
        $_SESSION['success'] = 1;
    }
    else {
        $_SESSION['success'] = 0;
    }
    header("Location: ../admin/index.php?page=write_off_ratio");
?>