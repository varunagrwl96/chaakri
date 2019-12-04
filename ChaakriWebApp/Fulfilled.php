<?php
include_once('../php_processing/php_includes/db_conx.php');
$sql = "SELECT *  FROM orders WHERE status = 1";
$query = mysqli_query($connection, $sql);
//echo $sql;
$check = mysqli_fetch_assoc($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fullfilled Orders</title>
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
                <a class="navbar-brand" href="dashboard.php" style="color: white;">
                    <strong>Chaakri</strong>
                </a>
                <div class="collapse navbar-collapse" id="navbarNav1">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="ordersummary.html" style="color: white;">Orders<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="inventorymanagement.php" style="color: white;">Inventory<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="way2sms/sms.php" style="color: white;">Promotion
                            <span class="sr-only">(current)</span></a>
                        </li>
						 <li class="nav-item">
                            <a class="nav-link" href="sakhiorders.php" style="color: white;">Sakhi Orders<span class="sr-only">(current)</span></a>
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
                <h1>Fullfilled Orders</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </div>
</main>
<!-- /.Main -->

<div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer ID</th>
                            <th>Quantity</th>
                            <th>Inventory ID</th>
                            <th>Date</th>
                            <th>Delivery</th>
                            <th>Sakhi ID</th>
                            <th>Status</th>
                            <th>Delivery Mode</th>
                            <th>Delivery Address</th>
							<th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php if(isset($check) && count($check)) : ?>
                      <?php foreach ($query as $key => $quer) : ?>

                        <tr>
                            <th scope="row"><?php echo $quer['id'];?></th>
                            <td><?php echo $quer['customer_id'];?></td>
                            <td><?php echo $quer['quantity'];?></td>
                            <td><?php echo $quer['inventory_id'];?></td>
                            <td><?php echo $quer['orderTS'];?></td>
                            <td><?php echo $quer['deliveryTS'];?></td>

                            <td><?php echo $quer['sakhi_id'];?></td>
							<td><?php echo $quer['status'];?></td>
                            <td><?php echo $quer['delivery_mode'];?></td>
                            <td><?php echo $quer['delivery_address'];?></td>
                            <td><?php echo $quer['price'];?></td>
                        </tr>
                      <?php endforeach; ?>
                      <?php else : ?>
                        <div class="alert  alert-warning">
                          <h3>Sorry, no results found! </h3>
                          </div>
                      <?php endif; ?>

                    </tbody>
                </table>
            </div>
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
