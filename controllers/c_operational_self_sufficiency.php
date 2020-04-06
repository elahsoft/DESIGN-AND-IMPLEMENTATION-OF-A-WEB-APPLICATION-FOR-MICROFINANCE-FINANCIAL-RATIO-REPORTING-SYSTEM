<?php
    require_once '../models/OperationalSelfSufficiency.php';

    session_start();

    $period_id = $_POST['period_id'];

    $interest_earned_in_cash = $_POST['interest_earned_in_cash'];
    $income_from_fees = $_POST['income_from_fees'];
    $commissions = $_POST['commissions'];
    $interest_accrued_but_not_yet_earned = $_POST['interest_accrued_but_not_yet_earned'];
    $interest_paid_in_cash = $_POST['interest_paid_in_cash'];
    $fees_paid = $_POST['fees_paid'];
    $commissions_paid = $_POST['commissions_paid'];
    $accrued_interest_but_not_yet_paid = $_POST['accrued_interest_but_not_yet_paid'];
    $loan_losses_expense = $_POST['loan_losses_expense'];
    $personnel_expense = $_POST['personnel_expense'];
    $administrative_expense = $_POST['administrative_expense'];

    $datetime = date('m/d/y h:i:s');
    $datetimeArray = explode(" ", $datetime);
    $date = $datetimeArray[0];
    $status = 1;

    $operationalSelfSufficiency = new OperationalSelfSufficiency();
    
    $dataArray = array ($period_id, $interest_earned_in_cash, $income_from_fees, $commissions,
     $interest_accrued_but_not_yet_earned,
     $interest_paid_in_cash, $fees_paid, $commissions_paid, $accrued_interest_but_not_yet_paid,
      $loan_losses_expense,
     $personnel_expense, $administrative_expense, $date, $status);

    $dataType = array(PDO::PARAM_INT, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, 
    PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR,
    PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_INT );

    $success = $operationalSelfSufficiency->insert($dataArray, $dataType);


    if ($success) {
        $_SESSION['success'] = 1;
    }
    else {
        $_SESSION['success'] = 0;
    }
    header("Location: ../admin/index.php?page=operational_self_sufficiency");
?>