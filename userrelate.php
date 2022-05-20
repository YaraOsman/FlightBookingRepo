<?php
include('conn.php');

$usid=0;
$email = isset($_POST['email'])?$_POST['email']:'';
$password = isset($_POST['password'])?$_POST['password']:'';
$username = isset($_POST['username'])?$_POST['username']:'';
$phone = isset($_POST['phone'])?(int)$_POST['phone']:'';
$role = isset($_POST['role'])?strtolower($_POST['role']):'';
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
	
    if(isset($_POST['userid'])){
        echo "<script>
        const yesno = confirm('Are you sure you want to update it?');
        if( yesno == true){
           ".updateuser()."
        }
        </script>";
    }

}else if(isset($_POST['userdelete'])){

    if(isset($_POST['userid'])){
    echo "<script>
    const yesno = confirm('Are you sure you want to delete it?');
    if( yesno == true){
       ".deleteuser()."
    }
    </script>";
}
}

$get_users;
$sql = "select USID,name,email,phoneNo,password,role,to_char(userdate,'YYYY-MM-DD HH24:MI:SS') from users order by USID desc";
if(isset($_POST['usersearch'])){
    global $connection;
    global $get_users;
    global $sql;
   
    $name = isset($_POST['u_name_s'])?$_POST['u_name_s']:'';
    $email = isset($_POST['u_email_s'])?$_POST['u_email_s']:'';
    $phone = isset($_POST['u_phone_s'])?(int)$_POST['u_phone_s']:'';
    $role = isset($_POST['u_role_s'])?strtolower($_POST['u_role_s']):'';
    $date = isset($_POST['u_date_s'])?$_POST['u_date_s']:'';
    $hdate = "";
    if($date != ""){
        $timestamp = strtotime($date);	 
        $ldate = date("d-m-Y", $timestamp);
        $hdate = "and trunc(userdate) like to_date('$ldate','DD-MM-YYYY')";
      
    }
    

    $sql = "select USID,name,email,phoneNo,password,role,to_char(userdate,'YYYY-MM-DD HH24:MI:SS') from users where name like '%$name%' and email like '%$email%' and phoneNo like '%$phone%' and role like '%$role%' $hdate order by USID desc";
    $get_users = oci_parse($connection,$sql);
    oci_execute($get_users);

 user();

}
if(isset($_POST['showall'])){
    $sql = "select USID,name,email,phoneNo,password,role,to_char(userdate,'YYYY-MM-DD HH24:MI:SS') from users order by USID desc";
}


$get_users = oci_parse($connection,$sql);
oci_execute($get_users);


if(isset($_POST['signup'])){
    $usid=0;
    $email = isset($_POST['email_su'])?$_POST['email_su']:'';
    $password1 = isset($_POST['password1_su'])?$_POST['password1_su']:'';
    $password2 = isset($_POST['password2_su'])?$_POST['password2_su']:'';
    $username = isset($_POST['username_su'])?$_POST['username_su']:'';
    $phone = isset($_POST['phone_su'])?(int)$_POST['phone_su']:'';
    $role = 'user';
    $dt = new DateTime();

    $date= $dt->format('Y-m-d\TH:i:s');
    $timestamp = strtotime($date);	 
    $ldate = str_replace('T',' ',date("d-m-Y H:i:s", $timestamp));
    $hdate = "to_date('$ldate','DD-MM-YYYY HH24:MI:SS')";

    $users_id=oci_parse($connection,'select max(USID) from users');
    oci_execute($users_id);
    while(($row = oci_fetch_array($users_id,OCI_BOTH)) != false){
      $usid = (int)$row[0]+1;
    }

        $sql = "insert into users(USID,name,email,phoneNo,password,role,userdate)values('$usid','$username','$email','$phone','$password1','$role',$hdate)";
        $add_users=oci_parse($connection,$sql);
        oci_execute($add_users);
   
        echo "<script>
        document.getElementById('matchpass').style.display = 'none'
        document.getElementById('signup').style.display = 'none'
        location.href = '#login'
        document.getElementById('yousignedup').style.display = 'initial'
        
        </script>";


}

if(isset($_POST['logingbtn'])){
    $email = isset($_POST['login-email'])?$_POST['login-email']:'';
    $password = isset($_POST['login-password'])?$_POST['login-password']:'';

    $users_id=oci_parse($connection,'select email,password,name from users');
    oci_execute($users_id);
    while(($row = oci_fetch_array($users_id,OCI_BOTH)) != false){
      if($email == $row[0] && $password == $row[1]){
          $username = $row[2];
          echo "<script>
          document.getElementById('yousignedup').style.display = 'initial'
          sessionStorage.setItem('email','$email')
          sessionStorage.setItem('username','$username')
          let eml = sessionStorage.getItem('email')
          window.history.replaceState('','',window.location.href)
          location.reload()
          alert('you logged in successfully')
          </script>";
          
          return;
      }else{
          echo "
          <script>
          $('label[for = loginerr]').text('Username or Password is incorrect !!!!')
          document.getElementById('loginerr').style.display = 'initial'
          
          </script>";
          return;
      }
    }

}




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
       $usid = (int)$_POST['userid'];
       $sql = "delete users where usid = $usid";
       $delete_users = oci_parse($connection,$sql);
       oci_execute($delete_users);
   
 
    user();
}

function updateuser(){
    global $connection,$email,$username,$password,$phone,$role,$date;

    $timestamp = strtotime($date);	 
    $ldate = str_replace('T',' ',date("d-m-Y H:i:s", $timestamp));
    $hdate = "to_date('$ldate','DD-MM-YYYY HH24:MI:SS')";


    $usid = (int)$_POST['userid'];
    $sql = "update users set email='$email',password='$password',name='$username',phoneNo=$phone,role='$role',userdate=$hdate where usid = $usid";
    $update_users = oci_parse($connection,$sql);
    oci_execute($update_users);


 user();
}


?>
