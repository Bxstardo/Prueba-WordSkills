<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Concurso PHP</title>
	<!-- Bootstrap css -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<!-- Bootstrap css -->
	<link rel="stylesheet" type="text/css" href="assets/css/datatable/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/datatable/responsive.bootstrap4.min.css">
	<script src="https://kit.fontawesome.com/e248bffa71.js" crossorigin="anonymous"></script>	
</head>

<body>

	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="#">Access Room_911</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">				
						<a class="nav-link" href="?controller=user">Emplooyes</a>
					</li>
					<li class="nav-item">				
						<a class="nav-link" href="?controller=category">Departments</a>
					</li>
					<li class="nav-item">				
						<a class="nav-link" href="?controller=login&method=logout">Logout</a>
					</li>
					<li class="nav-item" style="margin-left:900px">				
						<a class="nav-link" href="?controller=login&method=logout"></a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	
	<!-- Bootstrap js -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- Datatables js -->
	<script src="assets/js/datatable/jquery.dataTables.min.js"></script>
	<script src="assets/js/datatable/dataTables.bootstrap4.min.js"></script>
	<script src="assets/js/datatable/dataTables.responsive.min.js"></script>
	<script src="assets/js/datatable/responsive.bootstrap4.min.js"></script>
	<!-- Validator js -->
	<script src="assets/js/validator.js"></script>
	<!-- sweetalert js -->
	<script src="assets/js/sweetalert.js"></script>
</body>

</html>