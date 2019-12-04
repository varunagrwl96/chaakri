<?php
include_once('php_includes/db_conx.php');

if(isset($_GET['sakhi_phone'])){
  $sakhi_phone = $_GET['sakhi_phone'];
  $sql = "SELECT id  FROM users WHERE mobile_no=$sakhi_phone LIMIT 1";
  $query = mysqli_query($connection, $sql);
  $row = mysqli_fetch_row($query);
  $sakhi_id = $row[0];
  $sql = "SELECT *  FROM orders WHERE sakhi_id = $sakhi_id AND status = 0";
  $query = mysqli_query($connection, $sql);
  $i=0;
  $arr = array();
  $r=array();

  if (mysqli_num_rows($query) > 0)
  {
    while($row = mysqli_fetch_array($query))
    {
		$r[$i]=$row;
		//$arr=['id'=>$row['id'], 'customer_id'=>$row['customer_id'],'quantity'=>$row['inventory_id'],'timestamp'=>$row['orderTS'],'address'=>$row['delivery_address'],'price'=>$row['price']];
    /* $arr[$i][0] = $row["id"];
      $arr[$i][1] = $row["customer_id"]; //Sakhi Lat
      $arr[$i][2] = $row["quantity"]; //Sakhi Long
      $arr[$i][3] = $row["inventory_id"];
      $arr[$i][4] = $row["orderTS"];
      $arr[$i][5] = $row["delivery_address"];
      $arr[$i][6] = $row["price"]; */
      $i++;

    }
	header('Content-Type: application/json');
    print(json_encode($r));
   // echo $data;

  }

}
?>
