<?php
include('conn.php');

$usid=0;
$email = isset($_POST['email'])?$_POST['email']:'';
$password = isset($_POST['password'])?$_POST['password']:'';
$username = isset($_POST['username'])?$_POST['username']:'';
$phone = isset($_POST['phone'])?(int)$_POST['phone']:'';
$role = isset($_POST['role'])?$_POST['role']:'';
$date = isset($_POST['udate'])?$_POST['udate']:'';

 
if(isset($_POST['userinsert'])){

$users_id=oci_parse($connection,'select max(USID) from users');
oci_execute($users_id);
while(($row = oci_fetch_array($users_id,OCI_BOTH)) != false){
$usid = (int)$row[0]+1;
}
$timestamp = strtotime($date);	 
$ldate = str_replace('T',' ',date("d-m-Y H:i:s", $timestamp));
$hdate = "to_date('$ldate','DD-MM-YYYY HH24:MI:SS')";


$sql = "insert into users(USID,name,email,phoneNo,password,role,userdate)values('$usid','$username','$email','$phone','$password','$role',$hdate)";
$add_users=oci_parse($connection,$sql);
oci_execute($add_users);
user();
}else if(isset($_POST['userupdate'])){
	user();
}else if(isset($_POST['userdelete'])){

    echo "<script>
    const yesno = confirm('Are you sure you want to delete it?');
    if( yesno == true){
       ".deleteuser()."
    }
    </script>";

}

$get_users = oci_parse($connection,"select USID,name,email,phoneNo,password,role,to_char(userdate,'YYYY-MM-DD HH24:MI:SS') from users order by USID desc");
oci_execute($get_users);

function user(){
    echo "
    <script>
    document.getElementById('showUser').style.display = 'flex'
    document.getElementById('showFlight').style.display = 'none'
    document.getElementById('user').style.backgroundColor = 'black'
    document.getElementById('flight').style.backgroundColor = '#0505057e'
    document.getElementById('usertbl').style.display = 'flex'

    </script>
    ";
}

function deleteuser(){
    global $connection;
   if(isset($_POST['userid'])){
       $usid = (int)$_POST['userid'];
       $sql = "delete users where usid = $usid";
       $delete_users = oci_parse($connection,$sql);
       oci_execute($delete_users);
   }
 
    user();
}


?>
