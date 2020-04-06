<?php
    if(file_exists("../config/database.php")) {
        require_once '../config/database.php';
    } 
    else {
        require_once 'config/database.php';
    }

    class PortfolioAtRisk extends database{

        private $fieldsArray = array("period_id", "principal_outstanding_on_all_past_due_loans", 
        "renegotiated_loans", "date",  "status");
        private $tableName = "ra_portfolio_at_risk";

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

        public function computePortfolioAtRisk($principal_outstanding_on_all_past_due_loans, $renegotiated_loans, 
            $gross_loan_portfolio) {
            if ($gross_loan_portfolio > 0)
                $portfolio_at_risk = ($principal_outstanding_on_all_past_due_loans +  $renegotiated_loans)/
                 $gross_loan_portfolio;
            else 
                $portfolio_at_risk = 0;
            return $portfolio_at_risk;
        }
    }

?>