<?php

    class Status
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
				$strSql = "SELECT * FROM statuses";
				$query = $this->pdo->select($strSql);
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function newRol($data)
		{
			try {
				$this->pdo->insert('statuses', $data);
			} catch(PDOException $e) {
				die($e->getMessage());
			}
			
		}

		public function getRolById($id)
		{
			try {
				$strSql = 'SELECT * FROM statuses WHERE id = :id';
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
				$this->pdo->update('statuses', $data, $strWhere);
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}
		public function deleteRol($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->delete('statuses', $strWhere);
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function editStatus($data)
    	{
        	try{
        	    $strWhere='id='.$data['id'];
        	    $this->pdo->update('statuses',$data,$strWhere);
        	}catch(PDOException $e){
        	    die($e->getMessage());
        	}
    	}
    }