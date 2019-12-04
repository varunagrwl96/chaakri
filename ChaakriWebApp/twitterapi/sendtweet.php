<?php
	include_once("../../php_processing/php_includes/db_conx.php");
	
	$consumer_key='uH0V118EYgxhY7tM78rfhlMBf';
	$consumer_secret='O9O3bq5qBCVNAgXuK6ekf08Zqt9Q4BHdVykf1uedJLJGdi0iU5';
	$access_token='887190134747156480-eWcpBjYp9sZYNUa6Z3xbA6SNr8MrrsN';
	$access_token_secret='vgF7O2C7AOPvlN89t8Ct3IZV31SqjFRyRiTlBiOABCWc5';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Send Tweet</title>
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
		<?php
			//Include Library
			require "autoload.php";
			use Abraham\TwitterOAuth\TwitterOauth;

			//Connect to API
			$connection1= new TwitterOauth($consumer_key,$consumer_secret,$access_token,$access_token_secret);
			$content=$connection1->get("account/verify_credentials");

			if (isset($_POST['tweet'])) {
				$message=$_POST['message'];
				$new_status=$connection1->post("statuses/update",["status"=>$message]);
				echo '<div class="alert alert-success text-center">Successfully Tweeted!</div>';
			}


			if (isset($_POST['appreciate'])) {

				$new_status=$connection1->post("statuses/update",["status"=>'appreciation']);
			}
		?>
		</div>
		
        <div class="row">
            <div class="col-md-12">
                <h1>Send a Tweet!</h1>
                <hr>
            </div>        
        </div>


        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
            <form action="sendtweet.php" method="post">
                <!--Naked Form-->
                        <div class="card-block">

                            <!--Header-->
                            <div class="text-xs-center">
                                <h3>Go Ahead Tweet:</h3>
                                <hr class="mt-2 mb-2">
                            </div>

                            <form action="sendtweet.php" method="">
							<div class="md-form">
                                <i class="fa fa-pencil-square-o prefix"></i>
								<?php
								$msg = "";
								$sql = "SELECT name from sakhis where id = (SELECT sakhi_id FROM `orders` where status=1 group by sakhi_id order by count(*) DESC LIMIT 1)";
								$result = mysqli_query($connection, $sql);
								if (mysqli_num_rows($result) > 0) 
								{
									while($row = mysqli_fetch_assoc($result))
									{
										$msg =  "Congratulations to ".$row["name"]. " for being the most hardworking volunteer! Chaakri Mahila Udyog appreciates & recognizes her immense support!";
									}
								}
								?>
				                <textarea type="text" id="form76" class="md-textarea" name="message"><?php echo $msg;?></textarea>
				                <label for="form76">
									Start tweeting...
								</label>
				            </div>

                            <div class="md-form">
                                <button class="btn btn-primary" type="submit" name="tweet">Tweet</button>
                                <!--<button class="btn btn-default" type="submit" name="appreciate">Appreciate
                                </button>-->
                            </div>

                        </form>
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