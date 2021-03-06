<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link rel="stylesheet" href="table.css" />
    <link rel="stylesheet" href="admin.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    
  </head>
  <body>
  

    <div class="container">
      <div class="form-container">
       
        <div class="tab-btns">
          <button id="user" >User</button>
          <button id="flight" >Flight</button>
        </div>

        
        <!-- user form -->
        <div>
        <form id="showUser" class="user-form" name="showuser" method="POST">
          
        <h2>User Form</h2>

        <div class="inputcontainer-user">
          <input type="text" placeholder="User ID" name="userid" readonly/>
          <img src="images/user-icon.png" width="15px" height="auto" alt="" />
        </div>
        <div class="inputcontainer-user">
          <input type="text" placeholder="Email" name="email"  required />
          <img src="images/email-icon.png" width="15px" 
          height="auto" style="margin-top: 3px" />
        </div>
        <div class="inputcontainer-user">
          <input type="password" placeholder="Password" name="password" required />
          <img src="images/pass-icon.png" width="15px" height="auto" alt="" />
        </div>
        <div class="inputcontainer-user">
          <input type="text" placeholder="Username" name="username" required />
          <img src="images/user-icon.png" width="15px" height="auto" alt="" />
        </div>
        <div class="inputcontainer-user">
          <input type="tel" placeholder="Phone" name="phone" oninput="this.value = this.value.replace(/[^+0-9]/g, '').replace(/^(\+.?)\+/g, '$1').replace(/(\+.*)\+/g, '$1');" required />
          <img src="images/tel-icon.png" width="12px" height="auto" alt="" />
        </div>
        <div class="inputcontainer-user">
          <select name="role" required>
            <option value="role" selected disabled hidden>Role</option>
            <option value="admin">Admin</option>
            <option value="moderator">Moderator</option>
            <option value="user">User</option>
          </select>
          <img src="images/role-icon.jpg" width="15px" height="auto" alt="" />
        </div>
        <?php 
            $date = new DateTime();
            $dt= $date->format('Y-m-d\TH:i:s');
           ?>
        <div class="inputcontainer-user">
          <input step="any" type="datetime-local" name="udate" value='<?php echo $dt; ?>' />
          <img src="images/date-icon.png" width="15px" height="auto" alt="" />
        </div>
        
        <div class="btns-user">
          <button name="userinsert">Insert</button>
          <button name="userdelete">Delete</button>
          <button name="userupdate">Update</button>
        </div>
      </form>
        
       </div>
       <!-- end user form -->





       <!-- flight form -->
        <div>
        <form id="showFlight" class="flight-form" method="POST" name="showFlight" enctype="multipart/form-data">
          
        <h2>Available Flights</h2>

        <div class="inputcontainer-flight">
          <label for="aaid">Flight ID</label>
          <input type="text" placeholder="Flight ID" name="flightid" readonly />
        </div>

        <div class="inputcontainer-flight">
          <label for="country">Country</label>
          <input type="text" placeholder="Country" name="country" />
        </div>

        <div class="inputcontainer-flight">
          <label for="description">Description</label>
          <input type="text" placeholder="Description" name="description" />
        </div>

        <div class="inputcontainer-flight">
          <label for="fromplace">From</label>
          <input type="text" placeholder="From" name="fromplace" />
        </div>

        <div class="inputcontainer-flight">
          <label for="type">Type</label>
          <select name="type" id="type" required>
            <option value="type" selected disabled hidden>Type</option>
            <option value="One Way Trip">One Way Trip</option>
            <option value="Round Trip">Round Trip</option>
          </select>
        </div>
          
        <div class="inputcontainer-flight">
          <label for="departure">Departure Date</label>
          <input step="any" type="datetime-local" name="departure">  
        </div>

        <div class="inputcontainer-flight">
          <label for="return">Return Date</label>
          <input step="any" type="datetime-local" name="return">  
        </div>
        
        <div class="inputcontainer-flight">
          <label for="state">State</label>
          <select name="state" id="state" required>
            <option value="state" selected disabled hidden>State</option>
            <option value="Available">Available</option>
            <option value="Unavailable">Unavailable</option>
          </select>
        </div>

        <div class="inputcontainer-flight">
          <label for="airline">Airline</label>
          <input type="text" placeholder="Airline" name="airline" />
        </div>

        <div class="inputcontainer-flight">
          <label for="price">Price</label>
          <input type="text" placeholder="Price" name="price" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
        </div>

        <?php 
            $date = new DateTime();
            $dt= $date->format('Y-m-d\TH:m:s');
           ?>
        <div class="inputcontainer-flight">
          <label for="date">Date</label>
          <input step="any" type="datetime-local" name="date" value='<?php echo $dt; ?>'>  
        </div>

        <div class="inputcontainer-flight">
             <label for="img">No file choosen</label>
             <input name="imgurl" type="file" placeholder="image url" accept="image/x-png,image/gif,image/jpeg,image/jpg"/>

        </div>

        <div class="btns-flight">
          <button name="flightinsert">Insert</button>
          <button name="flightdelete">Delete</button>
          <button name="flightupdate">Update</button>
        </div>
      </form>
        


      </div>
      <!-- end flight form -->

      </div>


    </div>
<!-- user table -->
<div id="usertbl">
   <div class="search-container">
     <form action="" method="post">
      <h4 class="search-header">Search By:</h4>
      <input class="search-input" name="u_name_s" type="text" placeholder="Name">
      <input class="search-input" name="u_email_s" type="text" placeholder="Email">
      <input class="search-input" name="u_phone_s" type="text" oninput="this.value = this.value.replace(/[^+0-9]/g, '').replace(/^(\+.?)\+/g, '$1').replace(/(\+.*)\+/g, '$1');" placeholder="Phone">
      <select name="u_role_s" class="search-input">
            <option value="Role" selected disabled hidden>Role</option>
            <option value="Admin">Admin</option>
            <option value="Moderator">Moderator</option>
            <option value="User">User</option>
      </select>
      <input class="search-input" name="u_date_s" type="date">
      <button class="search-btn" name="usersearch" >Search</button>
      <button class="search-btn" name="showall" >Show All</button>

    </form>
    
    </div>
<div class="maintbldiv">
 
    <div class="headerdiv">
      <table class="table-fill" style=" width: 1200px;">
        
          <tr >
            <th style="width: 96px; padding: 6px 0px;">User ID</th>
            <th style="width: 140px; padding: 6px 0px;">User Name</th>
            <th style="width: 200px; padding: 6px 0px;">Email</th>
            <th style="width: 97px; padding: 6px 0px;" >Phone No</th>
            <th style="width: 98px; padding: 6px 0px;">Password</th>
            <th style="width: 90px; padding: 6px 0px;">Role</th>
            <th style="width: 110px; padding: 6px 0px;">Date</th>
          </tr> 
      </table>
    </div>
    <div class="bodydiv" style=" width: 1200px;">
      <table class="table-fill" style=" width: 1200px;">
        <tbody>
          
       <?php include('userrelate.php');  ?>
       <?php 
       while(($row = oci_fetch_array($get_users,OCI_BOTH)) != false){
        ?>
          <tr onclick='getUserRowIndex(this)'>
            <td class="text-left tdu1" ><?php echo isset($row[0])?$row[0]:'' ?></td>
            <td class="text-left tdu2" ><?php echo isset($row[1])?$row[1]:'' ?></td>
            <td class="text-left tdu3" ><?php echo isset($row[2])?$row[2]:'' ?></td>
            <td class="text-left tdu4" ><?php echo isset($row[3])?$row[3]:'' ?></td>
            <td class="text-left tdu5" ><?php echo isset($row[4])?$row[4]:'' ?></td>
            <td class="text-left tdu6" ><?php echo isset($row[5])?$row[5]:'' ?></td>
            <td class="text-left tdu7" ><?php echo isset($row[6])?$row[6]:'' ?></td>
          </tr>
       <?php } ?>
       
       </tbody>
      </table>
      
    </div>
  </div>
  </div>
        <!-- end of user table -->
       

<!-- flight table -->
<div id="flighttbl">

<div class="search-container">
  <form action="" method="POST">
    <h4 class="search-header">Search By:</h4>
    <input class="search-input finpt" name="f_country_s" type="text" placeholder="Country Name">
    <select name="f_type_s" class="search-input search-select">
      <option value="type" selected disabled hidden>Type</option>
      <option value="One Way Trip">One Way Trip</option>
      <option value="Round Trip">Round Trip</option>
    </select>
    <select name="f_state_s" class="search-input search-select">
      <option value="state" selected disabled hidden>State</option>
      <option value="Available">Available</option>
      <option value="Unavailable">Unavailable</option>
    </select>
    <button class="search-btn fbtn" name="flightsearch">Search</button>
    <input class="search-input finpt" name="f_airline_s" type="text" placeholder="Airline">
    <input class="search-input finpt" name="f_price_s" type="text" placeholder="Price" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
    <input class="search-input finpt" name="f_date_s" type="date">
    <button class="search-btn fbtn" name="showallflight" >Show All</button>
       </form>
  </div>
<div class="maintbldiv" >
  
   
  <div class="headerdiv">
    <table class="table-fill">
      <tr>
        <th style="width: 100px;">Flight ID</th>
        <th style="width: 130px;">Country Name</th>
        <th style="width: 110px;">From</th>
        <th style="width: 95px;">Type</th>
        <th style="width: 90px;">Price</th>
        <th style="width: 130px;">Departure Date</th>
        <th style="width: 130px;">Return Date</th>
        <th style="width: 90px;">State</th>
        <th style="width: 120px;">Preferred Airline</th>
        <th style="width: 120px;">Description</th>
        <th style="width: 130px;">Inserted Date</th>
        <th style="width: 100px;">Image Url</th>
      </tr> 
    </table>
  </div>

  <div class="bodydiv">
    <table class="table-fill">
      <tbody>

      <?php include('aarelate.php') ?>
      <?php 
       while(($row = oci_fetch_array($get_airlines,OCI_BOTH)) != false){
         ?>

          <tr onclick='getFlightRowIndex(this)'>
            <td class="text-left tdf1" style="width: 100px;"><?php echo isset($row[0])?$row[0]:'' ?></td>
            <td class="text-left tdf2" style="width: 130px;"><?php echo isset($row[1])?$row[1]:'' ?></td>
            <td class="text-left tdf3" style="width: 110px;"><?php echo isset($row[2])?$row[2]:'' ?></td>
            <td class="text-left tdf4" style="width: 95px;"><?php echo isset($row[3])?$row[3]:'' ?></td>
            <td class="text-left tdf5" style="width: 90px;"><?php echo isset($row[4])?$row[4]:'' ?></td>
            <td class="text-left tdf6" style="width: 130px;"><?php echo isset($row[5])?$row[5]:'' ?></td>
            <td class="text-left tdf7" style="width: 130px;"><?php echo isset($row[6])?$row[6]:'' ?></td>
            <td class="text-left tdf8" style="width: 90px;"><?php echo isset($row[7])?$row[7]:'' ?></td>
            <td class="text-left tdf9" style="width: 120px;"><?php echo isset($row[8])?$row[8]:'' ?></td>
            <td class="text-left tdf10" style="width: 120px;"><?php echo isset($row[9])?$row[9]:'' ?></td>
            <td class="text-left tdf11" style="width: 130px;"><?php echo isset($row[10])?$row[10]:'' ?></td>
            <td class="text-left tdf12" style="width: 100px;"><?php echo isset($row[11])?$row[11]:'' ?></td>

          </tr>
      <?php } ?>
  
      </tbody>
    </table>
  </div> 
</div>
</div>
     <!-- end of flight table -->

 <script src="admin.js"></script>
 <script>
function getUserRowIndex(index){
  var form = document.getElementById("showUser")
  form.elements[0].value=index.cells[0].innerText
  form.elements[1].value=index.cells[2].innerText
  form.elements[2].value=index.cells[4].innerText
  form.elements[3].value=index.cells[1].innerText
  form.elements[4].value=index.cells[3].innerText
  form.elements[5].value=index.cells[5].innerText
  // this two lines will convert space to T because the <input type"datetime-local"> only accept this type of format "d-m-yTh:i"
  const dte = (index.cells[6].innerText).replace(' ','T')
  form.elements[6].value=dte;
  

}

function getFlightRowIndex(index){
  var form = document.getElementById("showFlight")
  form.elements[0].value = index.cells[0].innerText
  form.elements[1].value = index.cells[1].innerText
  form.elements[2].value = index.cells[9].innerText
  form.elements[3].value = index.cells[2].innerText
  form.elements[4].value = index.cells[3].innerText
  form.elements[5].value = (index.cells[5].innerText).replace(' ','T')
  form.elements[6].value = (index.cells[6].innerText).replace(' ','T')
  form.elements[7].value = index.cells[7].innerText
  form.elements[8].value = index.cells[8].innerText
  form.elements[9].value = index.cells[4].innerText
  form.elements[10].value = (index.cells[10].innerText).replace(' ','T')




}

</script>



  </body>
</html>
