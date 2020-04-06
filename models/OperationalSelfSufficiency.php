<?php
    if(file_exists("../config/database.php")) {
        require_once '../config/database.php';
    } 
    else {
        require_once 'config/database.php';
    }


    class OperationalSelfSufficiency extends database{

        private $fieldsArray = array("period_id", "interest_earned_in_cash", "income_from_fees", 
        "commissions","interest_accrued_but_not_yet_earned", "interest_paid_in_cash",
        "fees_paid", "commissions_paid", "accrued_interest_but_not_yet_paid", "loan_losses_expense",
        "personnel_expense", "administrative_expense", "date",  "status");
        private $tableName = "ra_operational_self_sufficiency";

        public function __construct() {
            parent::__construct();
        }

        public function insert($dataArray, $dataType) {
            $this->setInsertSql($this->tableName, $this->fieldsArray);
            $result = $this->executeInsert($dataArray, $dataType);
            return $result;
        }
        
        public function update($fieldArray, $dataArray, $whereFieldArray, $logic) {
            if (count($fieldArray) > 0) {
                $this->setUpdateSql($this->tableName, $fieldArray, $whereFieldArray, $logic);
            }
            else {
                $this->setUpdateSql($this->tableName, $this->fieldsArray, $whereFieldArray, $logic);
            }
            $result = $this->executeUpdate($dataArray);
            return $result;
        }
        public function select($whereDataArray, $whereFieldArray, $logic) {
            $this->setSelectSql($this->tableName, $whereFieldArray, $logic);
            $result = $this->executeSelect($whereDataArray);
            return $result;
        }
        public function delete($whereDataArray, $logic) {
            $this->setDeleteSql($this->tableName, array('id'), $logic);
            $result = $this->executeDelete($whereDataArray);
            return $result;   
        }
        public function computeFinancialRevenue($interest_earned_in_cash, $income_from_fees, $commissions,
            $interest_accrued_but_not_yet_earned) {
            $financial_revenue = $interest_earned_in_cash + $income_from_fees + $commissions +
            $interest_accrued_but_not_yet_earned;
            return $financial_revenue;
        }
        public function computeFinancialExpense($interest_paid_in_cash, $fees_paid, $commissions_paid,
        $accrued_interest_but_not_yet_paid) {
            $financial_expense = $interest_paid_in_cash + $fees_paid + $commissions_paid +
            $accrued_interest_but_not_yet_paid;
            return $financial_expense;
        }
        public function computeOperatingExpense($personnel_expense, $administrative_expense) {
            $operating_expense = $personnel_expense + $administrative_expense;
            return $operating_expense;
        }
        public function computeOperationalSelfSufficiency($financial_revenue, $financial_expense, $loan_losses, $operating_expense) {
            $denominator = $financial_expense + $loan_losses + $operating_expense;
            $operational_self_sufficiency = $financial_revenue/$denominator;
            return $operational_self_sufficiency;
        }
    }

?>