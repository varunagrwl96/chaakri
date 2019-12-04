<?php

         $usrn = $_GET['username'];

         $con = mysqli_connect("mysql.hostinger.in","u915472644_app","abcdef");
         if (!$con)
               {
                         die('Could not connect: ' . mysql_error());
                }

           mysqli_select_db($con ,"u915472644_app");

           $sql1="Select Groups from Users where Username='$usrn'";
           $result=mysqli_query($con,$sql1);
           $row=mysqli_fetch_array($result);
           $grp = $row[0];




           $i=mysqli_query($con,"select * from Attending where Groups='$grp' OR Groups='All' OR Groups='$grp2' OR Groups='$grp3' OR Groups='$grp4' OR Groups='$grp5' OR Groups='$grp6' OR Groups='$grp7' order by Event");


           $check='';
          while($row = mysqli_fetch_array($i))
            {

                  $r[]=$row;
                  $check=$row['Name'] ;            }

                header('Content-Type: application/json');
                print(json_encode($r));


 mysqli_close($con);

    ?>
