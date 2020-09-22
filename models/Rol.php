<?php

    class Rol
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
				$strSql = "SELECT r.*, s.status as status FROM roles r INNER JOIN statuses s ON s.id = r.status_id";
				$query = $this->pdo->select($strSql);
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function newRol($data)
		{
			try {
				$data['status_id'] = 1;
				$this->pdo->insert('users', $data);
			} catch(PDOException $e) {
				die($e->getMessage());
			}
			
		}

		public function getRolById($id)
		{
			try {
				$strSql = 'SELECT * FROM roles WHERE id = :id';
				$array = ['id' => $id];
				$query = $this->pdo->select($strSql, $array);
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function editRol($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->update('roles', $data, $strWhere);
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}
		public function deleteRol($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->delete('roles', $strWhere);
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function editStatus($data)
    	{
        	try{
        	    $strWhere='id='.$data['id'];
        	    $this->pdo->update('roles',$data,$strWhere);
        	}catch(PDOException $e){
        	    die($e->getMessage());
        	}
    	}
    }