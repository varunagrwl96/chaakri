<?php 
header('Access-Control-Allow-Origin: *');
require_once('php_includes/db_conx.php');

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