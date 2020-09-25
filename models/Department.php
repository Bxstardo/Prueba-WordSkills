<?php

    class Department
    {

		private $pdo;
		
        public function __construct()
		{
			try {
				$this->pdo = new Database;
			} catch(PDOException $e){
				die($e->getMessage());
			}	
        }
        
        public function getAll()
		{
			try {
				$strSql = "SELECT * FROM Departments";
				$query = $this->pdo->select($strSql);
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function newDepartment($data)
		{
			try {
				$this->pdo->insert('Departments', $data);
			} catch(PDOException $e) {
				die($e->getMessage());
			}
			
		}

		public function getDepartmentById($id)
		{
			try {
				$strSql = 'SELECT * FROM Departments WHERE Id = :Id';
				$array = ['Id' => $Id];
				$query = $this->pdo->select($strSql, $array);
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function editDepartment($data)
		{
			try {
				$strWhere = 'Id = '. $data['Id'];
				$this->pdo->update('Departments', $data, $strWhere);
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}
		public function deleteDepartment($data)
		{
			try {
				$strWhere = 'Id = '. $data['Id'];
				$this->pdo->delete('Departments', $strWhere);
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}
    }