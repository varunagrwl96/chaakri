

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Material Design Bootstrap</title>
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
                <a class="navbar-brand" href="../dashboard.php" style="color: white;">
                    <strong>Chaakri</strong>
                </a>
                <div class="collapse navbar-collapse" id="navbarNav1">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../ordersummary.html" style="color: white;">Orders<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../inventorymanagement.php" style="color: white;">Inventory<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../way2sms/sms.php" style="color: white;">Promotion
                            <span class="sr-only">(current)</span></a>
                        </li>
						 <li class="nav-item">
                            <a class="nav-link" href="../sakhiorders.php" style="color: white;">Sakhi Orders<span class="sr-only">(current)</span></a>
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
            <div class="col-md-2"></div>
            <div class="col-md-8">
            <form action="sms.php" method="post">
                <!--Naked Form-->
                        <div class="card-block">

                            <!--Header-->
                            <div class="text-xs-center">
                                <h3> Send a Text Message:</h3>
                                <hr class="mt-2 mb-2">
                            </div>

                            <!--Body-->
                            <div class="md-form">
                                <i class="fa fa-user prefix"></i>
                                <input type="text" id="form2" class="form-control" name="recepient">
                                <label for="form2">Recepient</label>
                            </div>

                            <div class="md-form">
                                <i class="fa fa-envelope prefix"></i>
                                <input type="text" id="form4" class="form-control" name="message">
                                <label for="form4">Your Message</label>
                            </div>

                            <div class="md-form">
                                <button name="submit" type="submit" class="btn btn-primary">Send</button>
                            </div>


                        </div>
            </form>
            </div>
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


<?php 

if (isset($_POST['submit'])) {
    $recepient=$_POST['recepient'];
    $message=$_POST['message'];
    include('way2sms-api.php');
    sendWay2SMS ( '8097002807' , 'P9243Q' , $recepient ,$message);  
}



 ?>
