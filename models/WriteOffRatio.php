<?php
   if(file_exists("../config/database.php")) {
        require_once '../config/database.php';
    } 
    else {
        require_once 'config/database.php';
    }

    class WriteOffRatio extends database{

        private $fieldsArray = array("period_id", "value_of_loans_written_off", "date",  "status");
        private $tableName = "ra_write_off_ratio";

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

        public function computeWriteOffRatio($value_of_loans_written_off, $average_gross_loan_portfolio) {
            if ($average_gross_loan_portfolio > 0)
             $write_off_ratio = $value_of_loans_written_off/ $average_gross_loan_portfolio;
            else 
                $write_off_ratio = 0;
            return $write_off_ratio;
        }
    }

?>