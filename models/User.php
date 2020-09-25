<?php

    class User
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
				$strSql = "SELECT * FROM Users where Rol = 'Emplooye'";
				$query = $this->pdo->select($strSql);
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function newUser($data)
		{
			try {
				$data['StatusUser'] = "Active";
				$data['Rol'] = "Emplooye";
				$this->pdo->insert('Users', $data);
			} catch(PDOException $e) {
				die($e->getMessage());
			}
			
		}

		public function getUserById($Id)
		{
			try {
				$strSql = 'SELECT * FROM Users WHERE Id = :Id AND Rol = "Emplooye" ';
				$array = ['Id' => $Id];
				$query = $this->pdo->select($strSql, $array);
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function editUser($data)
		{
			try {
				$strWhere = 'Id = '. $data['Id'];
				$this->pdo->update('Users', $data, $strWhere);
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}
		public function deleteUser($data)
		{
			try {
				$strWhere = 'Id = '. $data['Id'];
				$this->pdo->delete('Users', $strWhere);
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

	
    }