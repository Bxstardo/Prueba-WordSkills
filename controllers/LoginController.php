<?php
	
	require 'models/Login.php';
	
	/**
	 * Clase Controlador Login
	 */
	class LoginController
	{		
		private $model;

		public function __construct()
	    {
	        try{
	            $this->model = new Login;
	        }catch(PDOException $e){
	            die($e->getMessage());
	        }
	    }

		public function index()
		{
			if(isset($_SESSION['user'])) 
				header('Location: ?controller=home');
			else 
				require 'views/login.php';
		}

		public function login()
		{
			$validateUser = $this->model->validateUser($_POST);
            echo var_dump($validateUser);
			if($validateUser === true) {
				header('Location: ?controller=home');
			} else {
				$error = ['errorMessage' => $validateUser, 'Id' => $_POST['Id']];
				require 'views/login.php';
			}
		}

		public function logout()
		{
			if(isset($_SESSION['user']))
				session_destroy();
			header('Location: ?controller=login');
		}

	}