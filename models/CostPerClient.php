<?php
    if(file_exists("../config/database.php")) {
        require_once '../config/database.php';
    } 
    else {
        require_once 'config/database.php';
    }

    class CostPerClient extends database{

        private $fieldsArray = array("period_id", "average_number_of_clients", "date",  "status");
        private $tableName = "ra_cost_per_client";

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

        public function computeCostPerClient($operating_expense, $average_number_of_clients) {
            if ($average_number_of_clients > 0)
                $cost_per_client_ratio = $operating_expense/ $average_number_of_clients;
            else 
                $cost_per_client_ratio = 0;
            return $cost_per_client_ratio;
        }
    }

?>