<?php
    require_once '../models/PortfolioAtRisk.php';

    session_start();

    $period_id = $_POST['period_id'];
    
    $principal_outstanding_on_all_past_due_loans = $_POST['principal_outstanding_on_all_past_due_loans'];
    $renegotiated_loans = $_POST['renegotiated_loans'];
        
    $datetime = date('m/d/y h:i:s');
    $datetimeArray = explode(" ", $datetime);
    $date = $datetimeArray[0];
    $status = 1;

    $portfolioAtRisk = new PortfolioAtRisk();
    
    $dataArray = array ($period_id, $principal_outstanding_on_all_past_due_loans, $renegotiated_loans, 
        $date, $status);

    $dataType = array(PDO::PARAM_INT, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_INT );

    $success = $portfolioAtRisk->insert($dataArray, $dataType);


    if ($success) {
        $_SESSION['success'] = 1;
    }
    else {
        $_SESSION['success'] = 0;
    }
    header("Location: ../admin/index.php?page=portfolio_at_risk");
?>