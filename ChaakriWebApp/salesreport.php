
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
                <h1 class="card-text">Sales Report</h1>
                <hr>
            </div> 
            <div class="col-md-2">
              <a href="twitterapi/sendtweet.php" class="btn btn-primary" style="color: white;">
              Appreciate</a>
            </div>       
        </div>

        <div class="row">

            <div class="col-md-4">

            </div>


 

        </div>

        <div class="row" style="margin-top: 2em; margin-bottom: 2em;">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                        <div id="sakhisales" style="width: 100%; height: 300px;"></div>   
                    </div>
                </div>      
            </div>
        </div>

        <div class="row" style="margin-top: 2em; margin-bottom: 2em;">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                        <div id="barchart" style="width: 100%; height: 300px;"></div>   
                    </div>
                </div>      
            </div>
        </div>

<div class="row" style="margin-bottom: 2em;">
</div>



    </div>

</main>
<!-- /.Main -->



    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Name1', 'Name2','Name3', 'Name4', 'Name5'],
          ['2004',  1000,      400, 700, 500, 1200],
          ['2005',  1170,      460, 1010, 650, 560],
          ['2006',  660,       1120, 800, 1000, 400],
          ['2007',  1030,      540, 450, 200, 300]
        ]);

        var options = {
          title: 'Top 5 Sakhi Sales',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('sakhisales'));

        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Orders by Users', 'Orders'],
          ['Jeera', 1000],
          ['Khichdi', 1170],
          ['Peppery Oats', 660],
          ['Punjabi masala', 1030]
        ]);

        var options = {
          chart: {
            title: 'User Sales',
            subtitle: '',
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
</body>

</html>
