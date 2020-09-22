<?php

require 'models/User.php';
require 'models/Rol.php';

    class UserController
    {
        private $model;
        private $rol;

        public function __construct()
		{
            $this->model = new User;
            $this->rol = new Rol;
        }

        public function index()
		{
            require 'views/layout.php';
            $users = $this->model->getAll();
            $roles = $this->rol->getAll();
            require 'views/users/list.php';
        }

		public function add()
		{
			$this->model->newUser($_REQUEST);	
            $users = $this->model->getAll();		
			echo json_encode(["msj" => "se agrego correctamente", "users" => $users]);
			return;
		}
        
        public function edit()
		{
			$id = $_REQUEST['id'];
			$user = $this->model->getUserById($id);
			echo json_encode(["msj" => "se trajeron los datos correctamente", "user" => $user]);	
		}

		public function update()
		{
			$this->model->editUser($_POST);
			$users = $this->model->getAll();		
			echo json_encode(["msj" => "se agrego correctamente", "users" => $users]);
		}

		public function delete()
		{
			$this->model->deleteUser($_REQUEST);
			$users = $this->model->getAll();		
			echo json_encode(["msj" => "se elimino correctamente", "users" => $users]);
		}

		public function updateStatus()
		{
			$user = $this->model->getUserById($_REQUEST['id']);
			$data = [];
			if($user[0]->status_id == 1) { 
				$data = [
					'id' => $user[0]->id,
					'status_id' => 2
				];
			} elseif($user[0]->status_id == 2) {
				$data = [
					'id' => $user[0]->id,
					'status_id' => 1
				];
			}
			$this->model->editStatus($data);
			$users = $this->model->getAll();	
			echo json_encode(["msj" => "se elimino correctamente", "users" => $users]);
		}
    }