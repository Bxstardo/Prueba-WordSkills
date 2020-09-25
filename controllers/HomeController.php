<?php
	
	class HomeController
	{
		public function index() 
		{
			if(isset($_SESSION['user'])){
				require 'views/layout.php';
				require 'views/home.php';	
			}else{
				header('Location: ?controller=login');
			}
		}
	}