<?php

include('conn.php');



$fromplace=null;
$from=oci_parse($connection,"select distinct fromplace from airline_available");
oci_execute($from);
$row;
if(($row = oci_fetch_array($from,OCI_BOTH)) == null){
 return;
}
echo "<script> var html=''; 
window.history.replaceState('','',window.location.href);
";

do{
$fromplace = $row[0];
 echo " html += '<option >$fromplace</option>'; ";

}while(($row = oci_fetch_array($from,OCI_BOTH)));
echo " $('#fromcountry').append(html); </script>";

$from=oci_parse($connection,"select distinct preferredairline from airline_available");
oci_execute($from);
$row=null;
if(($row = oci_fetch_array($from,OCI_BOTH)) == null){
 return;
}
echo "<script> var html1=''; ";

do{
$fromplace = $row[0];
 echo " html1 += '<option >$fromplace</option>'; ";

}while(($row = oci_fetch_array($from,OCI_BOTH)));
echo " $('#airline').append(html1); </script>";




if(isset($_POST['paynow'])){
    
    $cardname = $_POST['card-name'];
    $cardnumber = $_POST['card-number'];
    $cardexp =$_POST['card-exp'];
    $cvc =$_POST['cvc'];
    $userid = $_POST['puid'];



    $pay_check=oci_parse($connection,"select cardno,usid from payment");
    oci_execute($pay_check);
    if(($row = oci_fetch_array($pay_check,OCI_BOTH)) == false){
        $sql = "insert into payment(cardno,cardname,cvc,exp,usid) VALUES('$cardnumber','$cardname','$cvc','$cardexp','$userid')";
        $payment=oci_parse($connection,$sql);
        oci_execute($payment);
        $_SESSION['payed'] = true;
        return;

       }
       do{
        
      if($cardnumber == $row[0]){
          $sql = "update payment set usid=$userid where cardno=$cardnumber";
          $payment=oci_parse($connection,$sql);
          oci_execute($payment);
          $_SESSION['payed'] = true;

          return;
      }
       }while(($row = oci_fetch_array($pay_check,OCI_BOTH)));

        $sql = "insert into payment(cardno,cardname,cvc,exp,usid) VALUES('$cardnumber','$cardname','$cvc','$cardexp','$userid')";
        $payment=oci_parse($connection,$sql);
        oci_execute($payment);
        $_SESSION['payed'] = true;


    }



if(isset($_POST['book'])){
    

    if($_POST['passport'] != null){
    if($_SESSION['payed'] == true){
     
    $packageid = $_POST['pid'];
    $seatnumber =$_POST['snumber'];
    $userid = $_POST['uid'];

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
  
    if($seatnumber == null){
        $seatnumber = 0;
    }
    $passport_number = $_POST['passport'];
    $sql = "update users set passportno = $passport_number where usid = $userid";
    $add_passport=oci_parse($connection,$sql);
    oci_execute($add_passport);


    $sql = "INSERT INTO airline_booking(ABID,AAID,USID,classtype,seatnumber,rowdate) VALUES('$abid','$packageid','$userid','$classtype',$seatnumber,$hdate)";

    $add_flight=oci_parse($connection,$sql);
    oci_execute($add_flight);
     echo "<script>alert('you booked the flight successfuly, if you ever mind to cancel it you have to do it in 2 days befor flight starts');
    location.href = '#index.php'
     
     </script>";


}else{
    echo "<script>alert('please add your payment');</script>";
}

}else{
    echo "<script>alert('please enter a passport number');</script>";
}
}

?>