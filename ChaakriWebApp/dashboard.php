<?php
include_once('../php_processing/php_includes/db_conx.php');
$sql = "SELECT product from inventory where id = (SELECT inventory_id FROM `orders` group by inventory_id order by count(*) DESC LIMIT 1)";
$query = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($query);
$major_sale = $result['product'];

$sql = "SELECT count(id),sum(quantity) FROM `orders` group by inventory_id order by sum(quantity) DESC LIMIT 1";
$query = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($query);
$major_sale_qty = $result['sum(quantity)'];
$major_sale_count = $result['count(id)'];

$sql = "SELECT name from sakhis where id = (SELECT sakhi_id FROM `orders` where status=1 group by sakhi_id order by sum(quantity) DESC LIMIT 1)";
$query = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($query);
$sakhi_sale = $result['name'];

$sql = "SELECT count(id),sum(quantity) FROM `orders` where status=1 group by sakhi_id order by sum(quantity) DESC LIMIT 1";
$query = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($query);
$sakhi_sale_qty = $result['sum(quantity)'];
$sakhi_sale_count = $result['count(id)'];

$sql = "SELECT delivery_address FROM `orders` order by max(delivery_address) and max(quantity) DESC LIMIT 1";
$query = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($query);
$location_sale = $result['delivery_address'];

$sql = "SELECT count(id),sum(quantity) FROM `orders` order by max(delivery_address) and max(quantity) DESC LIMIT 1";
$query = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($query);
$location_sale_count = $result['count(id)'];
$location_sale_qty = $result['sum(quantity)'];

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard</title>
    <!-- Font A Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="dashboardstyle.css" rel="stylesheet">
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
            <div class="col-md-10">
                <h1 class="card-text">Statistics</h1>
                <hr>
            </div>
            <div class="col-md-2">
              <a href="twitterapi/sendtweet.php" class="btn btn-primary" style="color: white;">
              Appreciate</a>
            </div>
        </div>

        <div class="row">

            <div class="col-md-4">
               <div class="card">
               <div class="card-block">
               <div class="row">
                   <div class="col-md-6">
                       <span class="badge indigo"><h6 style="color: white;">Highest Sold<br>Flavour</h5></span>
                   </div>
                   <div class="col-md-6 text-right">
                       <h6 class="card-text" style="color: black; font-weight: 600;"><?php echo $major_sale;?> Khakra <br/><?php echo $major_sale_qty;?> kgs | <?php echo $major_sale_count;?> orders </h4>
                   </div>
               </div>
               </div>
               </div>
            </div>

            <div class="col-md-4">
               <div class="card">
               <div class="card-block">
               <div class="row">
                   <div class="col-md-6">
                       <span class="badge indigo"><h6 style="color: white;">Highest Sales<br>(Sakhi)</h5></span>
                   </div>
                   <div class="col-md-6 text-right">
                       <h6 class="card-text" style="color: black; font-weight: 600;"><?php echo $sakhi_sale;?> <br/><?php echo $sakhi_sale_qty;?> kgs | <?php echo $sakhi_sale_count;?> orders </h2>
                   </div>
               </div>
               </div>
               </div>
            </div>

            <div class="col-md-4">
               <div class="card">
               <div class="card-block">
               <div class="row">
                   <div class="col-md-6">
                       <span class="badge indigo"><h6 style="color: white;">Highest Sales<br>(Location)</h5>
                       </span>
                   </div>
                   <div class="col-md-6 text-right">
                       <h6 class="card-text" style="color: black; font-weight: 600;">Andheri <br/><?php echo $location_sale_qty;?> kgs | <?php echo $location_sale_count;?> orders </h2>
                   </div>
               </div>
               </div>
               </div>
            </div>

        </div>

        <div class="row" style="margin-top: 2em; margin-bottom: 2em;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-block">
                        <div id="timegraph" style="width: 100%; height: 100%;"></div>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card">
                    <div class="card-block">
                        <div id="barchart" style="width: 100%; height: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>

<div class="row" style="margin-bottom: 2em;">

  <div class="col-md-6">
    <div class="card">
      <div class="card-block">
    <table class="table">
    <thead>
    <p style="color: black;">Top 5 Sakhi</p>
        <tr>
            <th>#</th>
            <th>Name</th>
			<th>Quantity (kgs)</th>
            <th>Sales</th>
        </tr>
    </thead>
    <tbody>
		<?php
		$sql = "SELECT o.sakhi_id, s.name as sname, sum(o.quantity), (40*sum(o.quantity)) FROM orders o, sakhis s where o.status=1 and o.sakhi_id=s.id group by o.sakhi_id order by sum(o.quantity) DESC LIMIT 5";
		$result = mysqli_query($connection, $sql);

		if (mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
		?>
        <tr>
            <th scope="row"><i class="fa fa-user"></i></th>
            <td><?php echo $row["sname"]; ?></td>
			<td><?php echo $row["sum(o.quantity)"]; ?></td>
			<td><?php echo '₹'.$row["(40*sum(o.quantity))"]; ?></td>
        </tr>
		<?php
			
			}
		}
		?>
    </tbody>
</table>
      </div>
    </div>
  </div>

<div class="col-md-6">
  <div class="card">
    <div class="card-block">
      <div id="donut" style="width: 100%; height: 350px;"></div>
    </div>
  </div>
</div>


</div>



    </div>

</main>
<!-- /.Main -->
	<?php
		$pending = 0;
		$fulfilled = 0;
		
		$sql = "SELECT count(*) FROM `orders` where status=0";
		$result = mysqli_query($connection, $sql);

		if (mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$pending = $row["count(*)"];
			}
		}
		
		$sql = "SELECT count(*) FROM `orders` where status=1";
		$result = mysqli_query($connection, $sql);

		if (mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$fulfilled = $row["count(*)"];
			}
		}
		?>
		
	?>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Fulfilled Orders',     <?php echo $fulfilled;?>],
          ['Pending Orders',      <?php echo $pending;?>],

        ]);

        var options = {
          title: 'Order Summary',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donut'));
        chart.draw(data, options);
      }
    </script>



    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Breakfast Khakhra', 'Khichdi','Nachni','Methi Masala'],
          ['2014',  200,      300, 700, 810],
          ['2015',  170,      460, 910, 300],
          ['2016',  460,       720, 800, 700],
          ['2017',  230,      140, 450,600]
        ]);

        var options = {
          title: 'Chaakri Mahila Gruh Udyog Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('timegraph'));

        chart.draw(data, options);
      }
    </script>


    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
	
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Locations', 'Kg'],
		  <?php 
		  $sql = "SELECT o.delivery_address, sum(o.quantity) FROM orders o, inventory i where o.inventory_id=i.id group by inventory_id";
			$result = mysqli_query($connection, $sql);

			if (mysqli_num_rows($result) > 0)
			{
				while($row = mysqli_fetch_assoc($result))
				{
					echo "['".$row["delivery_address"]."',".$row["sum(o.quantity)"]."],";
			?>
         
		  <?php }
			}
		  ?>
        ]);

        var options = {
          chart: {
            title: 'Khakra Sales vs Locations',
            subtitle: 'No. of Kgs Sold',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/tether.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>

<!-- Start of LiveChat (www.livechatinc.com) code -->
<script type="text/javascript">
  window.__lc = window.__lc || {};
  window.__lc.license = 8980665;
  (function() {
    var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
    lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
  })();
</script>
<!-- End of LiveChat code -->

</body>

</html>
