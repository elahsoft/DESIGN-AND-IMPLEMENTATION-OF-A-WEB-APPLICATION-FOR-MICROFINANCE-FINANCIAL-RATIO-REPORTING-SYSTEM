<?php
    if(file_exists("../config/database.php")) {
        require_once '../config/database.php';
    } 
    else {
        require_once 'config/database.php';
    }

    class CostOfFunds extends database{

        private $fieldsArray = array("period_id", "financial_expense_on_funding_liabilities", 
        "average_deposit", "average_borrowings", "date",  "status");
        private $tableName = "ra_cost_of_funds";

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

        public function computeCostOfFunds($financial_expense_on_funding_liabilities, $average_deposit,
            $average_borrowings) {
            if (($average_deposit + $average_borrowings) > 0)
                $cost_of_funds = $financial_expense_on_funding_liabilities / ($average_deposit + $average_borrowings);
            else
                $cost_of_funds = 0;
            return $cost_of_funds;
        }
    }

?>