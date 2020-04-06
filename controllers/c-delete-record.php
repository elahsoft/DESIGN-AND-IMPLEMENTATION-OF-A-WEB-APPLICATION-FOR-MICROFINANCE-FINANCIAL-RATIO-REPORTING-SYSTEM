<?php
    require_once '../models/ManagementReportPeriod.php';

    session_start();

    $tableName = $_GET['tableName'];
    $id = $_GET['recordId'];
    
    $modelObject = null;
    $redirectLoc = '';
    $activity_feature = '';
    $datetime = date('m/d/y h:i:s');
    $datetimeArray = explode(" ", $datetime);
    $date = $datetimeArray[0];
    $time = $datetimeArray[1];
    if ($tableName == 'ManagementReportPeriod') {
        $modelObject = new ManagementReportPeriod();
        $redirectLoc = "Location: ../admin/index.php?page=period_list";
    }
    
    $modelObjectDeleteResult = $modelObject->delete(array($id), '');
    
   
    if ($modelObjectDeleteResult ) {
        $_SESSION['success'] = 1;
    } 
    else {
        $_SESSION['success'] = 0;
    }
    header($redirectLoc);


?>