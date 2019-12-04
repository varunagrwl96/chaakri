<?php
if(isset($_GET["mobile_no"])){
	// CONNECT TO THE DATABASE
	include_once("php_includes/db_conx.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
  $password = $_GET['password'];
  $user_type = $_GET['user_type'];
	$p = md5($password);
	$m = $_GET["mobile_no"];
	if($m == "" || $p == ""){
		echo "login_failed";
    exit();
	}
  else {
	// END FORM DATA ERROR HANDLING
	$sql = "SELECT id, password, user_type FROM users WHERE mobile_no=$m LIMIT 1";
  $query = mysqli_query($connection, $sql);
        $row = mysqli_fetch_row($query);
		$db_id = $row[0];
    $db_pass_str = $row[1];
    $db_user_type = $row[2];
		if($p != $db_pass_str || $user_type != $db_user_type){
			echo "login_failed";
            exit();
		} else {
			// CREATE THEIR SESSIONS AND COOKIES
			$_SESSION['userid'] = $db_id;
			$_SESSION['password'] = $db_pass_str;
			//$sql = "UPDATE users SET ip='$ip', lastlogin=now() WHERE username='$db_username' LIMIT 1";
        //    $query = mysqli_query($connection, $sql);
			echo "success";
		  exit();
		}
	}
	exit();
}
?>
