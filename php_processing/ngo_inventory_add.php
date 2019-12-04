<?php 
header('Access-Control-Allow-Origin: *');
require_once('php_includes/db_conx.php');

$inventory_name = $_GET['inventory_name'];
$inventory_quantity = $_GET['inventory_quantity'];
$inventory_price = $_GET['inventory_price'];

$sql = "INSERT INTO inventory(product,quantity,price) values('".$inventory_name."',".$inventory_quantity.",".$inventory_price.")";

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