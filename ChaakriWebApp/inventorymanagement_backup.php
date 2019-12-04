<?php include('server.php');

//fetch the records to be update
if (isset($_GET['edit'])) {
	$id=$_GET['edit'];
	$edit_state=true;
	$rec=mysqli_query($db,"SELECT * FROM info WHERE id=$id;");
	$record=mysqli_fetch_array($rec);
	$name=$record['name'];
	$kgs=$record['kgs'];
	$price=$record['price'];
	$id=$record['id'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<title>Inventory Management</title>
</head>
<body>

<nav class="navbar navbar-fixed-top" style="margin-bottom: 15px; background-color: #0195BA;">
  <div class="container">
  <ul class="nav navbar-nav">
    <li><a style="color: white; font-size: 30px;" href="#">Chaakri</a></li>
    <li><a style="color: white; font-size: 20px;"  href="#">Home</a></li>
    <li><a style="color: white; font-size: 20px;"  href="#">Orders</a></li>
    <li><a style="color: white; font-size: 20px;"  href="#">Inventory</a></li>
  </ul>
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
<?php if(isset($_SESSION['msg'])):?>
	<div class="h3"><?php echo $_SESSION['msg']; unset($_SESSION['msg']) ?></div>
<?php endif ?>


	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Kgs</th>
				<th>Price</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php while ($row=mysqli_fetch_array($results)) { ?>
			<tr>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['kgs']; ?></td>
				<td><?php echo $row['price']; ?></td>
				<td>
				<a href="inventorymanagement.php?edit=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
				</td>
				<td>
				<a href="server.php?del=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
				</td>
			</tr>	<?php } ?>
		</tbody>
	</table>
</div>
</div>
</div>


<div class="panel panel-default" style="margin-bottom: 20px;padding-bottom: 20px;">
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
		<form action="server.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<br><br>
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
			</div>
			<div class="form-group">
				<label for="kgs">kgs</label>
				<input type="text" name="kgs" class="form-control" value="<?php echo $kgs; ?>">
			</div>
			<div class="form-group">
				<label for="price">Price</label>
				<input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
			</div>
		<div class="input-group">

		<?php if($edit_state==false): ?>
			<button class="btn btnprimary" type="submit" name="save">Save</button>
		<?php else: ?>
			<button class="btn btnprimary" type="update" name="update">Update</button>
		<?php endif?>


		</div>

		</form>
	</div>
	</div>
	</div>



</div>

</body>
</html>
