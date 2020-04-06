<?php
    require 'db_config.php';

    class database extends db_config {

        private $sqlString = "";
        private $stmt = null;
        public function  __construct() {
            //once an object is created db connection is established.
            parent::__contruct();
        }

        public function executeInsert($dataArray, $dataType) {
            try {
                $stmt = $this->conn->prepare($this->sqlString);
                for ($c=0; $c<count($dataArray); $c++) {
                    $stmt->bindValue(($c+1),$dataArray[$c], $dataType[$c]);
                }
            
                if( $stmt->execute() ) {
                    $stmt->closeCursor();
                    return 1;
                }
                else {
                    $stmt->closeCursor();
                    return 0;
                }
            }
            catch (PDOException $pde) {
                echo "Error: " . $pde->getMessage();
                $stmt->closeCursor();
            }
        }

        public function executeUpdate($dataArray) {
            try {
                $stmt = $this->conn->prepare($this->sqlString);
                if( $stmt->execute($dataArray) ) {
                    $stmt->closeCursor();
                    return 1;
                }
                else {
                    $stmt->closeCursor();
                    return 0;
                }
            }
            catch (PDOException $pde) {
                echo "Error: " . $pde->getMessage();
                $stmt->closeCursor();
            }
        }
        
        public function executeSelect($dataArray) {
            $resultArray = array();
           // echo $this->sqlString;
            try {
                $stmt = $this->conn->prepare($this->sqlString);
                if($stmt->execute($dataArray)) {
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $c = 0;
                    foreach ($stmt->fetchAll() as $dataRow=>$dataRowEle) {
                        $resultArray[$c] = $dataRowEle;
                        $c = $c + 1;
                    }
                    $stmt->closeCursor();
                }
                return $resultArray;
            }
            catch (PDOException $pde) {
                echo "Error: ".$pde->getMessage();
                $stmt->closeCursor();
                return false;
            }
        }

        public function executeDelete($dataArray) {
            try {
                $stmt = $this->conn->prepare($this->sqlString);
                if ($stmt->execute($dataArray)) {
                    return true;
                }
            }
            catch (PDOException $pde) {
                echo "Error: ".$e->getMessage();
                $stmt->close();
                return false;
            }
        }

        public function setInsertSql($tableName, $fieldsArray) {
            $fieldsNo = count($fieldsArray);
            $this->sqlString = "INSERT INTO ".$tableName." ( ";
            for($c=0; $c<$fieldsNo; $c++) {
                $this->sqlString = $this->sqlString.$fieldsArray[$c];
                if ($c != $fieldsNo-1) {
                    $this->sqlString = $this->sqlString.",";
                }
            }
            $this->sqlString = $this->sqlString ." ) VALUES ( ";
            for($c=0; $c<$fieldsNo; $c++) {
                $this->sqlString = $this->sqlString."?";
                if ($c != $fieldsNo-1) {
                    $this->sqlString = $this->sqlString.",";
                }
            }
            $this->sqlString = $this->sqlString." )";
        }

        public function setUpdateSql($tableName, $fieldsArray, $whereFieldArray, $logic) {
            $fieldsNo = count($fieldsArray);
            $whereFieldNo = count($whereFieldArray);
            $this->sqlString = "UPDATE ".$tableName." SET ";
            if ($fieldsNo != 1) {
                for($c=0; $c<$fieldsNo; $c++) {
                    $this->sqlString = $this->sqlString.$fieldsArray[$c]." = ?";
                    if($c == ($fieldsNo-1)) {
                        break;
                    }
                    if ($c < $fieldsNo) {
                        $this->sqlString = $this->sqlString.",";
                    }
                }
            }
            else {
                $this->sqlString = $this->sqlString.$fieldsArray[0]." = ?";
            }
            $this->sqlString = $this->sqlString;
            for($c=0; $c<$whereFieldNo; $c++) {
                if ($c == 0) {
                  $this->sqlString = $this->sqlString." WHERE ";
                }
                $this->sqlString = $this->sqlString.$whereFieldArray[$c]." = ? ".$logic." ";
            }
            echo $this->sqlString;
        }

        public function setSelectSql($tableName, $whereFieldArray, $logic) {
            $whereFieldNo = count($whereFieldArray);
            $this->sqlString = "SELECT * FROM ".$tableName;
            for($c=0; $c<$whereFieldNo; $c++) {
                if ($c == 0) {
                    $this->sqlString = $this->sqlString." WHERE ";
                }
                $this->sqlString = $this->sqlString.$whereFieldArray[$c]."= ? ";
                if ($c < ($whereFieldNo-1)) {
                    $this->sqlString = $this->sqlString." ".$logic." ";
                }
            }
        }

        public function setDeleteSql($tableName, $whereFieldArray, $logic) {
            $whereFieldNo = count($whereFieldArray);
            $this->sqlString = "DELETE FROM ".$tableName;
            for ($c=0; $c<$whereFieldNo; $c++) {
                if ($c == 0) {
                    $this->sqlString = $this->sqlString." WHERE ";
                }
                $this->sqlString = $this->sqlString.$whereFieldArray[$c]." = ? ";
                if ($logic != '') {
                    $this->sqlString = $this->sqlString.$logic." ";
                }
            }
        }

    }
?>