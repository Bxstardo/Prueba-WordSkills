<main>
    <div class="jumbotron text-center">
        <h1>Welcome  <?php echo $_SESSION['user']->FirstName." ".$_SESSION['user']->LastName ?></h1>
        <h2>Rol: <?php echo $_SESSION['user']->Rol ?></h1>
        <p class="lead">Please select an option from the menu</p>
    </div>
</main>