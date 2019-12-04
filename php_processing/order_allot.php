<?php
include_once('php_includes/db_conx.php');
include_once('ChaakriWebApp/way2sms/way2sms-api.php');

if(isset($_GET['order_id'])){
  $status = $_GET['status'];
  $order_id = $_GET['order_id'];
  $times = $_GET['times'];


  $sql = "SELECT customer_id, lmt  FROM orders WHERE id = $order_id  LIMIT 1";
  $query = mysqli_query($connection, $sql);
  $row = mysqli_fetch_row($query);
  $customer_id = $row[0];
  $limit = $row[1];
  $sql = "SELECT mobile_no  FROM users WHERE id = $customer_id  LIMIT 1";
  echo $sql;
  $query = mysqli_query($connection, $sql);
  $row = mysqli_fetch_row($query);
  $phone_no = $row[0];
  echo $phone_no;


  if($status == "pickup"){
  $sql = "UPDATE `orders` SET `delivery_mode`= 1 WHERE id = $order_id";
  $query = mysqli_query($connection, $sql);
  $msg = "Your will have to pickup your order from the destination at ".$times;
  if($query)
    sendWay2SMS('8097002807', 'P9243Q', $phone_no, $msg);
  }

  if($status == "delivery"){
  $sql = "UPDATE `orders` SET `delivery_mode`= 0 WHERE id = $order_id";
  $query = mysqli_query($connection, $sql);
  $msg = "Your order will soon be delivered on to your registered address.";
  if($query)
    sendWay2SMS('8097002807', 'P9243Q', $phone_no, $msg);
 }

 if($status == "cancel"){
   $sql = "UPDATE `orders` SET `lmt`= `lmt`+1 WHERE id = $order_id";
   $query = mysqli_query($connection, $sql);

   if($limit < 2)
    {  include_once("sakhiOrderAllotment.php");
       $sakhi_id = getnewsakhi_oncancel($limit);
       $sql = "UPDATE `orders` SET `sakhi_id`= $sakhi_id WHERE id = $order_id";
       $query = mysqli_query($connection, $sql);

    }
    else{
      $sql = "UPDATE `orders` SET `sakhi_id`= 100 WHERE id = $order_id";
      $query = mysqli_query($connection, $sql);
      $msg = "Your order will be Fulfilled by gruh udyog withing a week.";
      if($query)
        sendWay2SMS('8097002807', 'P9243Q', $phone_no, $msg);


    }


 }



}

?>
