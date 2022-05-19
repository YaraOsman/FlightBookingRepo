
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BestTravel</title>
    <link rel="icon" href="images/title.png" />
    <link rel="stylesheet" href="index.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
   
  </head>
  <body>
    <!--Home-->
    <div id="home">
      <!--Home navbar-->
      <nav>
        <!--Leftside navbar start-->
        <div onclick="openNav()" class="hidden-leftsidenav">
          <img src="images/menu-24.png" class="menu-class" />
        </div>
        <div class="leftside-nav">
          <a href="#">
            <img src="images/title.png" />
            <p>BestTravel</p>
          </a>
        </div>

        <!--Leftside nav end-->
<?php echo "<script> console.log('1111111111111')</script>"; ?>
        <div class="rightside-nav">
          <!-- search box when screen size more than 992px-->
          <div class="searchBox_">
            <input
              class="searchInput"
              type="text"
              name=""
              placeholder="Search"
            />
            <div class="searchButton" href="#">
              <img src="images/srch.png" class="searchimg" />
            </div>
          </div>

          <ul>
            <li>
              <a href="#home">Home</a>
            </li>
            <li>
              <a href="#packages">Packages</a>
            </li>
            <li>
              <a href="#login">Login</a>
            </li>
            <li>
              <a href="#reviews">Reviews</a>
            </li>
            <li>
              <a href="#feedback">Feedback</a>
            </li>
            <li>
              <a href="#about">About us</a>
            </li>
            <li>
              <a href="admin.php">user</a>
            </li>
          </ul>
        </div>

        <!-- search box when screen size less than 992px-->
        <div class="searchBox">
          <input class="searchInput" type="text" placeholder="Search" />
          <div class="searchButton" href="#">
            <img src="images/srch.png" class="searchimg" />
          </div>
        </div>
      </nav>

      <!-- hidden leftside navs-->
      <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"
          >&times;</a
        >
        <div class="sidenav-login">
          <div>
            <img class="sidenavlogin-img" src="images/pic-1.png" alt="" />
          </div>
          <div class="sidenavlogin-content">
            <p>User Name</p>
          </div>
        </div>
        <ul id="ul">
          <li>
            <a class="navlink" href="#home">Home</a>
          </li>
          <li>
            <a class="navlink" href="#packages">Packages</a>
          </li>
          <li>
            <a class="navlink" href="#login">Login</a>
          </li>
          <li>
            <a class="navlink" href="#reviews">Reviews</a>
          </li>
          <li>
            <a class="navlink" href="#feedback">Feedback</a>
          </li>
          <li>
            <a class="navlink" href="#about">About us</a>
          </li>
          <li>
              <a href="admin.php">user</a>
            </li>
        </ul>
      </div>

      <!--Home background-->
      <div class="home-background">
        <div class="home-text">
          <p class="first-p">Never Stop</p>
          <p class="second-p">Exploring</p>
          <pre>
Lorem ipsum dolor sit amet consectetur Totam eo
sit quod. Ab omnis eos vel nesciunt quod beatae.
Lorem, ipsum dolor.
        </pre
          >
        </div>
      </div>
    </div>

    <!--Packages-->
    <div id="packages">
      <header class="packages-header"><h2>Packages</h2></header>
      <div class="packages-box-container">

      <!-- the php connection with oracle -->
      <?php require("conn.php");
       
        $airline_available=oci_parse($connection,'select * from airline_available');
        oci_execute($airline_available);
       ?>
      <?php 
       while(($row = oci_fetch_array($airline_available,OCI_BOTH)) != false){ 
         ?>
        <!--First box-->
        <div class="packages-box">
          <div>
            <div class="box-header">
              
              <img src="images/<?php echo $row[7]; ?>" alt="<?php echo $row[1]; ?>" />
              <p><?php echo $row[1]; ?></p>
            </div>
            <div class="box-text">
              <p>
                <?php echo $row[2]; ?> 
              </p>
            </div>
          </div>
          <div class="anchor-div">
            <hr />
            <div class="box-anchor">
              <a href="countries.html">BOOK NOW</a>
            </div>
          </div>
        </div>
        
        <?php 
       }
        ?>
        
        
      </div>
    </div>


    <!--About Us-->
    <footer id="about">
      <div class="about-container">
        <div class="separated-about">
          <div class="about-column">
            <h6>Quick links</h6>
            <a href="#">Home</a>
            <a href="#packages">packages</a>
            <a href="#login">Login</a>
            <a href="#reviews">Reviews</a>
            <a href="#feedback">Feedback</a>
            <a href="#about">About us</a>
          </div>
          <div class="about-column">
            <h6>Extra links</h6>
            <a href="#">My account</a>
            <a href="#">Ask questions</a>
            <a href="#">Terms of use</a>
            <a href="#">Privacy policy</a>
          </div>
        </div>
        <div class="separated-about">
          <div class="about-column">
            <h6>Contact info</h6>
            <a href="#">0773-555-1111</a>
            <a href="#">0750-333-1111</a>
            <a href="#">GroupB1@gmail.com</a>
            <a href="#">Sulaymaniyah</a>
          </div>
          <div class="about-column">
            <h6>Follow us</h6>
            <a href="#">Facebook</a>
            <a href="#">Twitter</a>
            <a href="#">Instagram</a>
            <a href="#">Linkedin</a>
            <a href="#">Github</a>
          </div>
        </div>
      </div>

      <div class="about-container2">
        <p>
          Created by Group <span>B1</span> | &copy 2022 Copyright All Rights
          Reserved!
        </p>
      </div>
    </footer>
   
    
   

    <script src="jquery-3.6.0.min.js"></script>
    <script src="index.js"></script> 
    
    
    
  </body>
</html>
