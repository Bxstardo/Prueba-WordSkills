<?php

	/**
	 * Clase de conexión a BD
	 */
	class Database extends PDO
	{
		private $driver = 'mysql';
		private $host = 'localhost';
		private $dbName = 'room_911';
		private $charset = 'utf8';
		private $user = 'root';
		private $password = '';

		public function __construct()
		{
			try {				
				parent::__construct("{$this->driver}:host={$this->host}; dbname={$this->dbName}; charset={$this->charset}",$this->user, $this->password);
				$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				echo "Conexión Fallida {$e->getMessage()}";
			}	
		}

		public function select($strSql, $arrayData = array(), $fetchMode = PDO::FETCH_OBJ)
		{
			$query = $this->prepare($strSql);

			foreach ($arrayData as $key => $value) {
				$query->bindParam(":$key", $value);
			}	

			if(!$query->execute()){
				echo "Error, la consulta no se realizó";
			} else {
				return $query->fetchAll($fetchMode);
			}
		}

		public function insert($table, $data)
		{
			try {
				//ordenar el array de datos
				ksort($data);
				//eliminar del array los indices de controller y method
				unset($data['controller'], $data['method']);

				//listado de las filas a insertar
				$fieldNames = implode('`, `', array_keys($data));
				//listado de los parametros a cargar en el insert
				$fieldValues = ':'. implode(', :', array_keys($data));
				//linea del string de la insercion
				$strSql = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");

				//cargar los parametros al string
				foreach ($data as $key => $value) {
					$strSql->bindValue(":$key",$value);
				}

				$strSql->execute();

			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}
		
		public function update($table, $data, $where)
		{
			try {
				//ordenar el array de datos
				ksort($data);

				$fieldDetails = null;
				foreach ($data as $key => $value) {
					$fieldDetails .= "`$key` = :$key,";
				}

				$fieldDetails = rtrim($fieldDetails, ',');

				//UPDATE users SET name = :name, email = :email, status_id =: status_id WHERE
				$strSql = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
				//cargar los parametros al string
				foreach ($data as $key => $value) {
					$strSql->bindValue(":$key",$value);
				}

				$strSql->execute();

			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function delete($table, $where, $limit = 1)
		{
			return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
		}
	}