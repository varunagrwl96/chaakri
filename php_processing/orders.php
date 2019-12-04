<?php
//ddd
include_once("php_includes/db_conx.php");
include_once("sakhiOrderAllotment.php");

if(isset($_GET["cust_phone"])){
	$m = $_GET["cust_phone"];
	$sql = "SELECT id  FROM users WHERE mobile_no=$m LIMIT 1";
  $query = mysqli_query($connection, $sql);
	//echo $sql;
  $row = mysqli_fetch_row($query);
	$cust_id = $row[0];
	$quantity = preg_replace('#[^0-9]#', '', $_GET['quantity']);
	$inv_id = preg_replace('#[^0-9]#i', '', $_GET['inv_id']);
	$price =  $inv_id * 10;             //preg_replace('#[^0-9]#', '', $_GET['price']);
	$sakhi_id = 0;

	$sakhi_phone = $_GET['sakhi_phone'];
	if($sakhi_phone == '0'){
		//$sakhi_id = 0;
		//Changed to MagicSakhi Logic
		$sakhi_id = (int)getMagicSakhi();
	}
	else{
		$sql = "SELECT id  FROM users WHERE mobile_no=$sakhi_phone LIMIT 1";
	  $query = mysqli_query($connection, $sql);
	  $row = mysqli_fetch_row($query);
		$sakhi_id = $row[0];
	}
	$address = "";

	if(isset($_GET['address']) )
		$address = htmlentities($_GET['address']);
	/*
		$sql = "SELECT address  FROM customers WHERE mobile_no=$m LIMIT 1";
	  $query = mysqli_query($connection, $sql);
		echo $sql;
	  $row = mysqli_fetch_row($query);
		$address = $row[0];
		*/
 $price = "10";

	if($quantity == "" || $cust_id == "" || $price == "" || $inv_id == ""){
		echo "missing_values";
    exit();
	}
	else {
    $sql = "INSERT INTO orders (customer_id, quantity, inventory_id, orderTS, sakhi_id,  delivery_address, price)
		        VALUES($cust_id, $quantity, $inv_id, now(), $sakhi_id, '$address', $price)";
    //echo $sql;
    $query = mysqli_query($connection, $sql);
		if($query)
			echo "inserted";
//dd
	exit();
	}
}
?>
