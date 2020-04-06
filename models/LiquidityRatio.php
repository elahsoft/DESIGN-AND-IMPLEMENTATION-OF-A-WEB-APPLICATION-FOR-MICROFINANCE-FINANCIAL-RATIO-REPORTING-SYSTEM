<?php
    if(file_exists("../config/database.php")) {
        require_once '../config/database.php';
    } 
    else {
        require_once 'config/database.php';
    }

    class LiquidityRatio extends database{

        private $fieldsArray = array("period_id", "cash", 
        "trade_investments", "demand_deposits", "short_term_time_deposits", 
        "int_payable_funding_lia", "accounts_payable", "other_current_liabilities", "date",  "status");
        private $tableName = "ra_liquidity_ratio";

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

        public function computeLiquidityRatio($cash,  $trade_investments,
            $demand_deposits, $short_term_time_deposits, $int_payable_funding_lia, $accounts_payable,
            $other_current_liabilities ) {
            $denominator = $demand_deposits + $short_term_time_deposits + $int_payable_funding_lia + 
            $accounts_payable + $other_current_liabilities;

            if ($denominator > 0)
                $liquidity_ratio = ($cash +  $trade_investments)/ $denominator;
            else 
                $this->liquidity_ratio = 0;
            return $liquidity_ratio;            
        }
    }

?>