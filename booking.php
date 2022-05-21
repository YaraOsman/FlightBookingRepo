<?php

include('conn.php');

$fromplace=null;
$from=oci_parse($connection,'select fromplace from airline_available');
oci_execute($from);
echo "<script> var html=''; ";
while(($row = oci_fetch_array($from,OCI_BOTH)) != false){
$fromplace = $row[0];

echo " html += '<option >$fromplace</option>'; ";

}
echo " $('#fromcountry').append(html); </script>";




echo "eeeeeeeeeeeeeeee:".$_POST['fromcountry'];
if($_POST['fromcountry'] == 1){
    echo "11111111111111111111";
$sql = "";
if(isset($_POST['fromcountry'])){
    $fromcountry = $_POST['fromcountry'];
    $sql = "select country from airline_available where fromplace like $fromcountry";
}else{
    $fromcountry = isset($_POST['fromcountry'])?$_POST['fromcountry']:'';
    $sql = "select country from airline_available";
}

$country=null;
$to=oci_parse($connection,$sql);
oci_execute($to);
echo "<script> var html1=''; ";
while(($row = oci_fetch_array($to,OCI_BOTH)) != false){
$country = $row[0];

echo " html1 += '<option >$country</option>'; ";

}
echo " $('#country').append(html1); </script>";


}

?>