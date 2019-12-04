<?php include('server.php');
include_once('../php_processing/php_includes/db_conx.php');
//fetch the records to be update
if (isset($_GET['edit'])) {
	$id=$_GET['edit'];
	$edit_state=true;
	$rec=mysqli_query($db,"SELECT * FROM inventory WHERE id=$id;");
	$record=mysqli_fetch_array($rec);
	$name=$record['product'];
	$kgs=$record['quantity'];
	$price=$record['price'];
	$id=$record['id'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Inventory Management</title>
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


<div class="container" style="margin-top: 15px;">

<div class="row" >
	<div class="col-md-12">
		<h1></h1>
	</div>
</div>

<div class="panel panel-default" style="margin-top: 30px;">

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-10">
  <div class="panel-body"><h1>Manage Inventory</h1></div>
  <br/>
<?php if(isset($_SESSION['msg'])):?>
	<div class="h3"><?php echo $_SESSION['msg']; unset($_SESSION['msg']) ?></div>
<?php endif ?>


	<table class="table" style="table-layout: auto;">
		<thead>
			<tr>
				<th>Name</th>
				<th>Quantity</th>
				<th>Price</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		
		<tbody>
		<?php
		$sql = "SELECT * FROM inventory";
		$result = mysqli_query($connection, $sql);

		if (mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
		?>
        <tr>
            <td><?php echo $row['product']; ?></td>
			<td><?php echo $row['quantity']; ?></td>
			<td><?php echo $row['price']; ?></td>
			<td>
			<a href="inventorymanagement.php?edit=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
			&nbsp;&nbsp;
			<a href="server.php?del=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
			</td>
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

<div class="panel panel-default" style="margin-top: -60px;margin-bottom: 10px;padding-bottom: 20px;">
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
		<form action="server.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<br><br>
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" class="form-control" placeholder="Product Name" value="<?php echo $name; ?>">
			</div>
			<div class="form-group">
				<label for="kgs">Quantity</label>
				<input type="text" name="kgs" class="form-control" placeholder="Product Quantity" value="<?php echo $kgs; ?>">
			</div>
			<div class="form-group">
				<label for="price">Price</label>
				<input type="text" name="price" class="form-control" placeholder="Product Price" value="<?php echo $price; ?>">
			</div>
		<div class="input-group">

		<?php if($edit_state==false): ?>
			<button class="btn btn-primary" type="submit" name="save">Save</button>
		<?php else: ?>
			<button class="btn btn-primary" type="update" name="update">Update</button>
		<?php endif?>


		</div>

		</form>
	</div>
	</div>
	</div>



</div>

</body>
</html>
