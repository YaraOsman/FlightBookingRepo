<?php

include('conn.php');
echo '-------------------';
$fromplace=null;
$from=oci_parse($connection,"select distinct fromplace from airline_available");
oci_execute($from);
$row;
if(($row = oci_fetch_array($from,OCI_BOTH)) == null){
 
}
echo "<script> var html=''; ";

do{
$fromplace = $row[0];
 echo " html += '<option >$fromplace</option>'; ";

}while(($row = oci_fetch_array($from,OCI_BOTH)));
echo " $('#fromcountry').append(html); </script>";


if(isset($_POST['book'])){

    $phone = isset($_POST['phone'])?(int)$_POST['phone']:'';
    $packageid = "<script>document.writeln(sessionStorage.getItem('packageid'))</script>";
    $userid = "<script>document.writeln(sessionStorage.getItem('userid'))</script>";
    $seatnumber = "<script>document.writeln(sessionStorage.getItem('seatnumber'))</script>";
    $classtype = null;
    if($seatnumber >=1 && $seatnumber <=8)
    $classtype = 'business class';
    else
    $classtype = 'economy class';


    $date = new DateTime();
    $dt= $date->format('Y-m-d\TH:m:s');
    $timestamp = strtotime($dt);	 
    $ldate = str_replace('T',' ',date("d-m-Y H:i:s", $timestamp));
    $hdate = "to_date('$ldate','DD-MM-YYYY HH24:MI:SS')";
    
    $abid=0;
    $flight_id=oci_parse($connection,'select max(ABID) from airline_booking');
    oci_execute($flight_id);
    while(($row = oci_fetch_array($flight_id,OCI_BOTH)) != false){
        $abid = (int)$row[0]+1;
    }

    echo "<br>".$abid."<br>";
    echo $packageid."<br>";
    echo $userid."<br>";
    echo $classtype."<br>";
    echo $seatnumber."<br>";
    echo $hdate."<br>";
    

    $sql = "INSERT INTO airline_booking  (ABID,AAID,USID,classtype,seatnumber,rowdate)VALUES('$abid','$packageid','$userid','$classtype','$seatnumber',$hdate)";
    $add_flight=oci_parse($connection,$sql);
    oci_execute($add_flight);
    oci_error();
    
}
?>