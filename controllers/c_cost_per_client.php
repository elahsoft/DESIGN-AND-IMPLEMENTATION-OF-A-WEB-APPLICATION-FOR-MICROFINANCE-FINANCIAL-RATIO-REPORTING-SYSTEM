<?php
    require_once '../models/CostPerClient.php';

    session_start();

    $period_id = $_POST['period_id'];

    $average_number_of_clients = $_POST['average_number_of_clients'];

    $datetime = date('m/d/y h:i:s');
    $datetimeArray = explode(" ", $datetime);
    $date = $datetimeArray[0];
    $status = 1;

    $costPerClient = new CostPerClient();
    
    $dataArray = array ($period_id, $average_number_of_clients, $date, $status);

    $dataType = array(PDO::PARAM_INT, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_INT );

    $success = $costPerClient->insert($dataArray, $dataType);


    if ($success) {
        $_SESSION['success'] = 1;
    }
    else {
        $_SESSION['success'] = 0;
    }
    header("Location: ../admin/index.php?page=cost_per_client");
?>