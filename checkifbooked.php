<?php

include('conn.php');
$pid = $_POST['pid'];
$uid = $_POST['uid'];

$booked = array("booked"=>null);

$check_booked=oci_parse($connection,"select abid from airline_booking where aaid = $pid and usid = $uid");
oci_execute($check_booked);
$row;
if(($row = oci_fetch_array($check_booked,OCI_BOTH)) == false){
 return;
}
do{
   
$booked["booked"] = $row[0];
}while(($row = oci_fetch_array($check_booked,OCI_BOTH)));


$check_c=oci_parse($connection,"select * from cancelling where abid = $pid");
oci_execute($check_c);
$row1;
if(($row1 = oci_fetch_array($check_c,OCI_BOTH)) == false){
echo $booked["booked"];
    echo $booked["booked"];
 return;
}
do{
    $booked["booked"] = null;
}while(($row1 = oci_fetch_array($check_c,OCI_BOTH)));
    


echo $booked["booked"];


?>