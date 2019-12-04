<?php 	include_once("php_includes/db_conx.php");

if(isset($_GET["mobile_no"])){
	// CONNECT TO THE DATABASE
	// GATHER THE GETED DATA INTO LOCAL VARIABLES
	$mobile_no = preg_replace('#[^0-9]#', '', $_GET['mobile_no']);
	$p = $_GET['password'];
	$address = htmlentities($_GET['address']);
	$user_type = preg_replace('#[^0-2]#i', '', $_GET['user_type']);
	$sql = "SELECT id FROM users WHERE mobile_no=$mobile_no LIMIT 1";

  $query = mysqli_query($connection, $sql);
	$u_check = mysqli_num_rows($query);
	if($p == "" || $user_type == "" || $mobile_no == ""){
		echo "missing_values";
    exit();
	} else if ($u_check > 0){
    echo "already_registered";
    exit();
	}else {
		$p_hash = md5($p);
		$name= $_GET['name'];
    $sql = "INSERT INTO users (mobile_no, password, user_type, registration_date)
		        VALUES($mobile_no,'$p_hash',$user_type,now())";
    //echo $sql;
    $query = mysqli_query($connection, $sql);
		$uid = mysqli_insert_id($connection);

    if($user_type == 1 ){
      $availability = 1;
  		$sql = "INSERT INTO sakhis (id, name, availability, address) VALUES ($uid,'$name',$availability, '$address')";
      //echo $sql;
      $query = mysqli_query($connection, $sql);
      echo "success";
  	}
    if($user_type == 2 ){

  		$sql = "INSERT INTO customers (id, name, address) VALUES ($uid,'$name','$address')";
      //echo $sql;
      $query = mysqli_query($connection, $sql);
      echo "success";
  	}
	exit();
}
}
?>
