<?php
session_start();

$name="";
$kgs="";
$price="";
$id=0;
$edit_state=false;

//Check
//making connection to the database
include_once("../php_processing/php_includes/db_conx.php");
$db=$connection;


//If save button is clicked
if (isset($_POST['save'])) {
		$name=$_POST['name'];
	 	$kgs=$_POST['kgs'];
	 	$price=$_POST['price'];

		$query="INSERT INTO inventory(product,quantity,price) VALUES('$name','$kgs','$price')";
		mysqli_query($db,$query);
		$_SESSION['msg']="Records Saved";
		header('location:inventorymanagement.php');
		//redirects to the index page after inserting the data in the database

}

//update records
if (isset($_POST['update'])) {
	$name=$_POST['name'];
	$kgs=$_POST['kgs'];
	$price=$_POST['price'];
	$id=$_POST['id'];
	echo $name;

	mysqli_query($db,"UPDATE inventory SET product='$name', quantity='$kgs',price='$price' WHERE id=$id ");
	$_SESSION['msg']="Records Updated";
	header('location:inventorymanagement.php');

}

//delete records
if (isset($_GET['del'])) {
	$id=$_GET['del'];
	mysqli_query($db,"DELETE FROM inventory WHERE id=$id");
	$_SESSION['msg']="Records Deleted";
	header('location:inventorymanagement.php');
}


//retrieve records from the database
$results=mysqli_query($db,"SELECT * FROM info");
?>
