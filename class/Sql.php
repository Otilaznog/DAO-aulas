<?php

	class Sql extends PDO{

		private $conn;

		public function __construct(){

			$this->conn = new PDO("sqlsrv:Database=bdphp7;server=RECDK-02\SQLEXPRESS;ConnectionPooling=0", "sa", "batata");

		}

		private function setParams($statement, $parameters = array()){

			foreach ($parameters as $key => $value) {
				
				$this->setParam($statement, $key, $value);

			}

		}

		private function setParam($statement, $key,$value) {

			$statement->bindParam($key,$value);

		}

		public function query($rawQuery, $params = array()){

			$stmt = $this->conn->prepare($rawQuery);
			$this->setParams($stmt, $params);
			
			$stmt->execute();

			return $stmt; 

		}

		public function select($rawQuery, $params = array()):array{

			$stmt = $this->query($rawQuery, $params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);

		}

	}

?>