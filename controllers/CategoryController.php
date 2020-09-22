<?php

require 'models/Category.php';

    class CategoryController
    {
        private $model;

        public function __construct()
		{
            $this->model = new Category;
        }

        public function index()
		{
            require 'views/layout.php';
            $categories = $this->model->getAll();
            require 'views/categories/list.php';
        }

		public function add()
		{
			$this->model->newCategory($_REQUEST);	
			$categories = $this->model->getAll();		
			echo json_encode(["msj" => "se agrego correctamente", "categories" => $categories]);
			return;
		}
        
        public function edit()
		{
			$id = $_REQUEST['id'];
			$category = $this->model->getCategoryById($id);
			echo json_encode(["msj" => "se trajeron los datos correctamente", "category" => $category]);	
		}

		public function update()
		{
			$this->model->editCategory($_POST);
			$categories = $this->model->getAll();		
			echo json_encode(["msj" => "se agrego correctamente", "categories" => $categories]);
		}

		public function delete()
		{
			$this->model->deleteCategory($_REQUEST);
			$categories = $this->model->getAll();		
			echo json_encode(["msj" => "se elimino correctamente", "categories" => $categories]);
		}

		public function updateStatus()
		{
			$category = $this->model->getCategoryById($_REQUEST['id']);
			$data = [];
			if($category[0]->status_id == 1) { 
				$data = [
					'id' => $category[0]->id,
					'status_id' => 2
				];
			} elseif($category[0]->status_id == 2) {
				$data = [
					'id' => $category[0]->id,
					'status_id' => 1
				];
			}
			$this->model->editStatus($data);
			$categories = $this->model->getAll();	
			echo json_encode(["msj" => "se elimino correctamente", "categories" => $categories]);
		}
    }