<?php include_once("php_includes/db_conx.php");

if(isset($_GET["mobile_no"])){
	// CONNECT TO THE DATABASE
	$m = $_GET["mobile_no"];
	$sql = "SELECT id  FROM users WHERE mobile_no=$m LIMIT 1";
	$query = mysqli_query($connection, $sql);
	$row = mysqli_fetch_row($query);
	$cust_id = $row[0];

	// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
 	//$id = $_GET['id'];
	
	// END FORM DATA ERROR HANDLING
	
  	$sql = "SELECT address FROM customers WHERE id=$cust_id";
	echo $sql
  	$query = mysqli_query($connection, $sql);
        $row = mysqli_fetch_row($query);
			echo $row[0];
		}
	
?>
