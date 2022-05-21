<?php

include('conn.php');

$aaid=0;
$country = isset($_POST['country'])?$_POST['country']:'';
$fromplace = isset($_POST['fromplace'])?$_POST['fromplace']:'';
$description = isset($_POST['description'])?$_POST['description']:'';
$type = isset($_POST['type'])?$_POST['type']:'';
$price = isset($_POST['price'])?(int)$_POST['price']:'';
$date = isset($_POST['date'])?$_POST['date']:'';
$departure = isset($_POST['departure'])?$_POST['departure']:'';
$return = isset($_POST['return'])?$_POST['return']:'';
$state = isset($_POST['state'])?$_POST['state']:'';
$imgurl = isset($_FILES['imgurl'])?$_FILES['imgurl']['name']:'';
$imgurldata = isset($_FILES['imgurl'])?$_FILES['imgurl']['tmp_name']:'';
$airline = isset($_POST['airline'])?$_POST['airline']:'';


if(isset($_POST['flightinsert'])){
$fileext = explode('.',$imgurl);
$filecheck = strtolower(end($fileext));
$fileextstored = array('jpg' , 'jpeg' , 'png');

if(in_array($filecheck,$fileextstored)){//this is checks if the file extention is image or not

$airline_id=oci_parse($connection,'select max(AAID) from airline_available');
oci_execute($airline_id);
while(($row = oci_fetch_array($airline_id,OCI_BOTH)) != false){
$aaid = (int)$row[0]+1;
}

//this will change the date format to 10-May-2022
$timestamp = strtotime($date);	 
$ldate = str_replace('T',' ',date("d-m-Y H:i:s", $timestamp));
$hdate = "to_date('$ldate','DD-MM-YYYY HH24:MI:SS')";

$timestamp1 = strtotime($departure);	 
$ldate1 = str_replace('T',' ',date("d-m-Y H:i:s", $timestamp1));
$hdate1 = "to_date('$ldate1','DD-MM-YYYY HH24:MI:SS')";

$timestamp2 = strtotime($return);	 
$ldate2 = str_replace('T',' ',date("d-m-Y H:i:s", $timestamp2));
$hdate2 = "to_date('$ldate2','DD-MM-YYYY HH24:MI:SS')";

$sql = "INSERT INTO airline_available (AAID,country,type,price,departure,return,state,imgurl,preferredAirline,description,rowdate,fromplace)VALUES('$aaid','$country','$type','$price',$hdate1,$hdate2,'$state','$imgurl','$airline','$description',$hdate,'$fromplace')";
$add_airline=oci_parse($connection,$sql);
oci_execute($add_airline);


$destinationfile = "uploadedimages/".$imgurl;
move_uploaded_file($imgurldata,$destinationfile);

echo "<script>window.history.replaceState('','',window.location.href)</script>";

flight();
}else{
    echo "<script>alert('the file is not image')</script>";
}

}else if(isset($_POST['flightupdate'])){
    if(isset($_POST['flightid'])){
        echo "<script>
        const yesno = confirm('Are you sure you want to update it?');
        if( yesno == true){
           ".updateflight()."
        }
        </script>";
    }
}else if(isset($_POST['flightdelete'])){
    
    if(isset($_POST['flightid'])){
	echo "<script>
    const yesno = confirm('Are you sure you want to delete it?');
    if( yesno == true){
       ".deleteflight()."
    }
    </script>";
}
}


$get_airlines;
$sqlf = "select AAID,country,fromplace,type,price,to_char(departure,'YYYY-MM-DD HH24:MI:SS'),to_char(return,'YYYY-MM-DD HH24:MI:SS'),state,preferredAirline,description,to_char(rowdate,'YYYY-MM-DD HH24:MI:SS') from airline_available order by AAID desc";
if(isset($_POST['flightsearch'])){
    global $connection;
    global $get_airlines;
    global $sqlf;
   
    $country = isset($_POST['f_country_s'])?$_POST['f_country_s']:'';
    $type = isset($_POST['f_type_s'])?$_POST['f_type_s']:'';
    $state = isset($_POST['f_state_s'])?$_POST['f_state_s']:'';
    $airline = isset($_POST['f_airline_s'])?$_POST['f_airline_s']:'';
    $price = isset($_POST['f_price_s'])?$_POST['f_price_s']:'';
    $date = isset($_POST['f_date_s'])?$_POST['f_date_s']:'';

    $hdate = "";
    if($date != ""){
        $timestamp = strtotime($date);	 
        $ldate = date("d-m-Y", $timestamp);
        $hdate = "and trunc(AAdate) like to_date('$ldate','DD-MM-YYYY')";
      
    }

    $sqlf = "select AAID,country,description,type,price,to_char(AADate,'YYYY-MM-DD HH24:MI:SS'),state,imgurl,preferredAirline from airline_available where country like '%$country%' and type like '%$type%' and state like '%$state%' and preferredAirline like '%$airline%' and price like '%$price%' $hdate order by AAID desc";
    $get_airlines = oci_parse($connection,$sqlf);
    oci_execute($get_airlines);

    flight();

}

if(isset($_POST['showallflight'])){
    $sqlf = "select AAID,country,fromplace,type,price,to_char(departure,'YYYY-MM-DD HH24:MI:SS'),to_char(return,'YYYY-MM-DD HH24:MI:SS'),state,preferredAirline,description,to_char(rowdate,'YYYY-MM-DD HH24:MI:SS') from airline_available order by AAID desc";
    flight();
}

$get_airlines = oci_parse($connection,$sqlf);
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
  
       $aaid = (int)$_POST['flightid'];
       $sql = "delete airline_available where aaid = $aaid";
       $delete_flight = oci_parse($connection,$sql);
       oci_execute($delete_flight);
   
 
    flight();
}

function updateflight(){
        global $connection,$country,$description,$type,$price,$date,$state,$imgurl,$airline,$fromplace;
    
        $timestamp = strtotime($date);	 
        $ldate = str_replace('T',' ',date("d-m-Y H:i:s", $timestamp));
        $hdate = "to_date('$ldate','DD-MM-YYYY HH24:MI:SS')";
    
    
        $aaid = (int)$_POST['flightid'];
        $sql = "update airline_available set country='$country',description='$description',type='$type',price=$price,aadate=$hdate,state='$state',imgurl='$imgurl',preferredAirline='$airline',fromplace='$fromplace' where aaid = $aaid";
        $update_flight = oci_parse($connection,$sql);
        oci_execute($update_flight);
    
    
     flight();

}

?>