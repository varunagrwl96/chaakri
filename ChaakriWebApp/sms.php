
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>


    <header>
        <!--Navbar-->
        <nav class="navbar navbar-toggleable-md navbar-light">
            <div class="container">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#" style="color: white;">
                    <strong>Chaakri</strong>
                </a>
                <div class="collapse navbar-collapse" id="navbarNav1">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" style="color: white;">Home <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--/.Navbar-->
    </header>

<!-- Main -->
<main class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Login into the Application</h1>
                <hr>
            </div>        
        </div>
        <div class="row">
            <div class="col-md-12">
				<?php
				if(isset($_GET['msg']))
				{
					if($_GET['msg']=="invalid")
					{
						echo '<div class="alert alert-danger text-center">Invalid Username or Password!</div>';
					}
					if($_GET['msg']=="illegal")
					{
						echo '<div class="alert alert-success text-center">Illegal Access!</div>';
					}
				}
				?>
            </div>        
        </div>
    </div>
</main>
<!-- /.Main -->

<div class="container">
<div class="row">
    
<div class="col-lg-3">  
</div>

<div class="col-lg-6">
<!--Form with header-->
<form action="login_verify.php" method="post">
	<div class="card" style="margin-top: 40px;">
		<div class="card-block">

			<!--Header-->
			<div class="form-header blue-gradient">
				<h3><i class="fa fa-user"></i> Login:</h3>
			</div>

			<!--Body-->
			<div class="md-form">
				<i class="fa fa-user prefix"></i>
				<input type="text" id="form3" name="form3" class="form-control">
				<label for="form3">Your username</label>
			</div>

			<div class="md-form">
				<i class="fa fa-lock prefix"></i>
				<input type="password" id="form4" name="form4" class="form-control">
				<label for="form4">Your password</label>
			</div>

			<div class="text-center">
				<button type="submit" name="submit" class="btn btn-indigo">Sign in</button>
			</div>

		</div>
	</div>
</form>
<!--/Form with header-->
</div>    
    
<div class="col-lg-3">  
</div>

</div>
<!--closing row-->

</div>



<!-- This div tag creates vertical space <div style="height:2000px;"></div> -->


<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/tether.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
</body>

</html>
