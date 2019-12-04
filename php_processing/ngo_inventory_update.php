<?php 
header('Access-Control-Allow-Origin: *');
require_once('php_includes/db_conx.php');

$inventory_id = $_GET['inventory_id'];
$inventory_name = $_GET['inventory_name'];
$inventory_quantity = $_GET['inventory_quantity'];
$inventory_price = $_GET['inventory_price'];

$sql = "UPDATE inventory set product='".$inventory_name."',quantity=".$inventory_quantity.",price=".$inventory_price.") where id=".$inventory_id."";

if ($connection->query($sql) === TRUE)
{
	$url="return.php?data=success";
	Header("Location: $url");
}
else
{
	$url="return.php?data=fail";
	Header("Location: $url");
}
?>	