<?php
if(isset($_POST['form3']) && isset($_POST['form4']))
{
	$username = $_POST['form3'];
	$password = $_POST['form4'];
	if($username == "admin" && $password == "admin")
	{
		$url="dashboard.php";
		Header("Location: $url");
	}
	else
	{
		$url="index.php?msg=invalid";
		Header("Location: $url");
	}
}
else
{
	$url="index.php?msg=illegal";
	Header("Location: $url");
}
?>