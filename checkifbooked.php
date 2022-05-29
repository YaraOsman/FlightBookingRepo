<?php

include('conn.php');
$pid = $_POST['pid'];
$uid = $_POST['uid'];

$booked = 'none';

$check_booked=oci_parse($connection,"select abid from airline_booking where aaid = $pid and usid = $uid");
oci_execute($check_booked);
$row;
while(($row = oci_fetch_array($check_booked,OCI_BOTH)) != false){
$booked = $row[0];
}
if(($row = oci_fetch_array($check_booked,OCI_BOTH)) != false){
$booked = $row[0];
}



$check_c=oci_parse($connection,"select * from cancelling where abid = $booked");
oci_execute($check_c);
$row1;
while(($row1 = oci_fetch_array($check_c,OCI_BOTH)) != false){
$booked = 'none';
}
  


echo $booked;


?>