<?php
include('conn.php');
$pid = $_POST['pid'];


$from=oci_parse($connection,"select country,fromplace,type,price,to_char(departure,'YYYY-MM-DD HH24:MI:SS'),to_char(return,'YYYY-MM-DD HH24:MI:SS'),state,preferredAirline from airline_available where aaid = $pid");
oci_execute($from);
$row;
$country = null;
if(($row = oci_fetch_array($from,OCI_BOTH)) == false){
 return;
}
$arr = array("from"=>null,"departure"=>null,"return"=>null,"airline"=>null,"price"=>0,"type"=>null);
do{
    $country = $row[0];
    $arr["from"] = $row[1];
    $arr["departure"] = $row[4];
    $arr["return"] = $row[5];
    $arr["airline"] = $row[7];
    $arr["price"] = $row[3];
    $arr["type"] = $row[2];


}while(($row = oci_fetch_array($from,OCI_BOTH)));


echo json_encode($arr);

?>
