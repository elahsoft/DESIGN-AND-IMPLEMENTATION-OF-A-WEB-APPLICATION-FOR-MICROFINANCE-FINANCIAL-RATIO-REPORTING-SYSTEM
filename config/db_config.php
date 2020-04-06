<?php
    class db_config {
        private $server_name = "localhost";
        private $username = "alvanamfb_admin";
        private $password = "YWx2YW5hTUZCMjAxOCo=";
        private $database_name = "ratio_analysis";
        protected $conn;

        public function __contruct() {
            $password_decoded = $this->decode($this->password);
            try {
                $this->conn = new PDO("mysql:host=$this->server_name;dbname=$this->database_name", $this->username, $password_decoded);
                // set the PDO error mode to exception
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
            catch(PDOException $pde) {
                echo "Error: " . $pde->getMessage();
            }
        }
            
        public function decode($password) {
            $password = base64_decode($password);
            return $password;
        }
        public function encode($password) {
            $password = base64_encode($password);
            return $password;
        }

    }
    //$dbcon = new db_config();

    //echo $dbcon->decode("YWx2YW5hTUZCMjAxOCo="); 
?>