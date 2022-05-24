<?php

include('conn.php');
$pid = $_POST['pid'];
$uid = $_POST['uid'];

$booked = false;

$check_booked=oci_parse($connection,"select abid from airline_booking where aaid = $pid and usid = $uid");
oci_execute($check_booked);
$row;
if(($row = oci_fetch_array($check_booked,OCI_BOTH)) == false){
 return;
}
do{
   
$booked = true;

}while(($row = oci_fetch_array($check_booked,OCI_BOTH)));


echo true;


?>