<?php
    if(file_exists("../config/database.php")) {
        require_once '../config/database.php';
    } 
    else {
        require_once 'config/database.php';
    }
    class FinancialSelfSufficiency extends database{

        private $fieldsArray = array("period_id", "average_equity", "average_fixed_assets", 
        "inflation_rate","average_funding_liabilities", "commercial_rate_for_funds",
        "interest_and_fees_expense", "gross_loan_losses", "lost_interest_deductions", "date",  "status");
        private $tableName = "ra_financial_self_sufficiency";

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

        public function computeInflationAdjustment($average_equity, $average_fixed_assets, $inflation_rate) {
            $inflation_adjustment = $average_equity - ($average_fixed_assets * $inflation_rate);
            return $inflation_adjustment;
        }
        public function computeSubsidizedCostOfFundAdjustment($average_funding_liabilities, $commercial_rate_for_funds,
        $interest_and_fees_expense) {
            $subsidized_cost_of_fund_adjustment = ($average_funding_liabilities * $commercial_rate_for_funds) - $interest_and_fees_expense;
            return $subsidized_cost_of_fund_adjustment;
        }
        public function computeAdjustedFinancialExpense($inflation_adjustment, $subsidized_cost_of_fund_adjustment){
            $adjusted_financial_expense = $inflation_adjustment  + $subsidized_cost_of_fund_adjustment;
            return $adjusted_financial_expense;
        }
        public function computeNetLoanLosses($gross_loan_losses, $lost_interest_deductions){
            $net_loan_losses = $gross_loan_losses - $lost_interest_deductions;
            return $net_loan_losses;
        }
        public function ComputeFinancialSelfSufficiency($financial_revenue, $adjusted_financial_expense, 
        $net_loan_losses, $operating_expense ) {
            $denominator = $adjusted_financial_expense + $net_loan_losses+ $operating_expense;
            if ($denominator > 0)
                $financial_self_sufficiency = $financial_revenue/$denominator;
            else   
                $financial_self_sufficiency = 0;
            return $financial_self_sufficiency;
        }
    }

?>