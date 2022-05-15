<?php

include('conn.php');

$aaid=0;
$country = isset($_POST['country'])?$_POST['country']:'';
$description = isset($_POST['description'])?$_POST['description']:'';
$type = isset($_POST['type'])?$_POST['type']:'';
$price = isset($_POST['price'])?(int)$_POST['price']:'';
$date = isset($_POST['date'])?$_POST['date']:'';
$state = isset($_POST['state'])?$_POST['state']:'';
$imgurl = isset($_POST['imgurl'])?$_POST['imgurl']:'';
$airline = isset($_POST['airline'])?$_POST['airline']:'';

if(isset($_POST['flightinsert'])){

$airline_id=oci_parse($connection,'select max(AAID) from airline_available');
oci_execute($airline_id);
while(($row = oci_fetch_array($airline_id,OCI_BOTH)) != false){
$aaid = (int)$row[0]+1;
}
//this will change the date format to 10-May-2022
$timestamp = strtotime($date);	 
$ldate = str_replace('T',' ',date("d-m-Y H:i:s", $timestamp));
$hdate = "to_date('$ldate','DD-MM-YYYY HH24:MI:SS')";

$sql = "insert into airline_available(AAID,country,description,type,price,AAdate,state,imgurl,preferredAirline)values('$aaid','$country','$description','$type','$price',$hdate,'$state','$imgurl','$airline')";
$add_airline=oci_parse($connection,$sql);
oci_execute($add_airline);

flight();

}else if(isset($_POST['flightupdate'])){
	flight();
}else if(isset($_POST['flightdelete'])){
	echo "<script>
    const yesno = confirm('Are you sure you want to delete it?');
    if( yesno == true){
       ".deleteflight()."
    }
    </script>";
}

$get_airlines = oci_parse($connection,"select AAID,country,description,type,price,to_char(AADate,'YYYY-MM-DD HH24:MI:SS'),state,imgurl,preferredAirline from airline_available order by AAID desc");
oci_execute($get_airlines);

function flight(){
echo "<script> 
document.getElementById('showFlight').style.display = 'flex'
document.getElementById('showUser').style.display = 'none'
document.getElementById('flight').style.backgroundColor = 'black'
document.getElementById('user').style.backgroundColor = '#0505057e'
document.getElementById('flighttbl').style.display = 'flex'
document.getElementById('usertbl').style.display = 'none'
</script>";
}
function deleteflight(){
    global $connection;
   if(isset($_POST['flightid'])){
       $aaid = (int)$_POST['flightid'];
       $sql = "delete airline_available where aaid = $aaid";
       $delete_flight = oci_parse($connection,$sql);
       oci_execute($delete_flight);
   }
 
    flight();
}

?>