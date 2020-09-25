<?php

require 'models/User.php';
require 'models/Department.php';

    class UserController
    {
        private $model;

        public function __construct()
		{
            $this->model = new User;
            $this->department = new Department;
		}
		
		

        public function index()
		{
			if(isset($_SESSION['user'])){
				require 'views/layout.php';
				$users = $this->model->getAll();
				$departments = $this->department->getAll();
				require 'views/users/list.php';
			}else{
				require 'views/login.php';
			}
        }

		public function add()
		{
			if(isset($_SESSION['user'])){
				$this->model->newUser($_REQUEST);	
				$users = $this->model->getAll();		
				echo json_encode(["msj" => "se agrego correctamente", "users" => $users]);
				return;
			}
		}
        
        public function edit()
		{
			if(isset($_SESSION['user'])){
				$Id = $_REQUEST['Id'];
				$user = $this->model->getUserById($Id);
				echo json_encode(["msj" => "se trajeron los datos correctamente", "user" => $user]);	
			}
		}

		public function update()
		{
			if(isset($_SESSION['user'])){
				$this->model->editUser($_POST);
				$users = $this->model->getAll();		
				echo json_encode(["msj" => "se agrego correctamente", "users" => $users]);
			}
		}

		public function updateStatus()
		{
			if(isset($_SESSION['user'])){
				$user = $this->model->getUserById($_REQUEST['Id']);
				$data = [];
				if($user[0]->StatusUser == "Active") { 
					$data = [
						'Id' => $user[0]->Id,
						'StatusUser' => "Inactive"
					];
				} elseif($user[0]->StatusUser == "Inactive") {
					$data = [
						'Id' => $user[0]->Id,
						'StatusUser' => "Active"
					];
				}
				$this->model->editUser($data);
				$users = $this->model->getAll();	
				echo json_encode(["msj" => "se cambio estado correctamente", "users" => $users]);
			}
		}

		
		public function updateAccess()
		{
			if(isset($_SESSION['user'])){
				$user = $this->model->getUserById($_REQUEST['Id']);
				$data = [];
				if($user[0]->Access == "on") { 
					$data = [
						'Id' => $user[0]->Id,
						'Access' => null
					];
				}else {
					$data = [
						'Id' => $user[0]->Id,
						'Access' => "on"
					];
				}
				$this->model->editUser($data);
				$users = $this->model->getAll();	
				echo json_encode(["msj" => "se elimino correctamente", "users" => $users]);
			}
		}
    }