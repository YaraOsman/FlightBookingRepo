<?php

include('conn.php');
$abid = (int)$_POST['dt'];


    $dt = new DateTime();
    $date= $dt->format('Y-m-d\TH:i:s');
    $timestamp = strtotime($date);	 
    $ldate = str_replace('T',' ',date("d-m-Y H:i:s", $timestamp));
    $hdate = "to_date('$ldate','DD-MM-YYYY HH24:MI:SS')";


$cancell=oci_parse($connection,"insert into cancelling(abid,cancellingdate)values('$abid',$hdate)");
oci_execute($cancell);

echo "cancelleedddd:".$abid;

?>