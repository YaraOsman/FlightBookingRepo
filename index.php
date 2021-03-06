
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
        <div class="rightside-nav">
          <!-- search box when screen size more than 992px-->
          <div class="searchBox_">
            <input class="searchInput" type="text" name="" placeholder="Search"/>
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
              <a href="#login" id="log-in1">Login</a>
              <a href="#logout" id="logout1">Logout</a>
            </li>
            
            <li>
              <a href="#about">About us</a>
            </li>
          </ul>
          <div onclick="openNav()" class="hidden-leftsidenav2">
            <img src="images/menu-24.png" class="menu-class" />
          </div>
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
        <div class="sidenav-login" id="sidenav-login">
          <div>
            <img class="sidenavlogin-img" src="images/pic-1.png" alt="" />
          </div>
          <div class="sidenavlogin-content">
            <p id="email-addr">email</p>
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
            <a class="navlink" href="#login" id="log-in2">Login</a>
            <a id="logout2" >Logout</a>
          </li>
          <li>
            <a class="navlink" href="#about">About us</a>
          </li>
          <li>
              <a href="admin.php">Admin</a>
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
       
        $airline_available=oci_parse($connection,'select * from airline_available where (months_between(departure , sysdate)*30)>2');
        oci_execute($airline_available);
      
      $row;
      if(($row = oci_fetch_array($airline_available,OCI_BOTH)) == false){
        echo "There is no flight yet..";
      }
      while(($row = oci_fetch_array($airline_available,OCI_BOTH))){
   
         ?>
        <div class="packages-box">
          <div>
            <div class="box-header">
              <img src="uploadedimages/<?php echo $row[10]; ?>" />
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
            <div class="box-anchor" id="cli">
              <a value="<?php echo $row[0]; ?>" class="booking" >BOOK NOW</a>
            </div>
          </div>
        </div>
        
        <?php 
       }
        ?>
        
        
      </div>
    </div>


    <!--Login-->
    <div id="login">
      <header class="login-header">
        <h3>Login</h3>
        <img src="images/avatar.jpg" alt="avatar" />
      </header>
      <label id="yousignedup">You signed up successfully, please login</label>
      <div class="loginform-container">
        <form id="loginfrm" class="login-form" action="" method="POST">
          <label class="login-label" for="email">Email</label>
          <input class="login-input" id="login-email" name="login-email" type="email" placeholder="Enter Email" required />
          <label class="login-label" for="pass">Password</label>
          <input class="login-input" id="login-password" name="login-password" type="password" placeholder="Enter Password" required />
          <label for="loginerr" class="err" id="loginerr"></label>
          <div class="loginform-button">
            <button type="submit" name="logingbtn">Login</button>
            <p>Forgot <a href="#">password?</a></p>
          </div>
          <div class="loginform-footer">
            <p>Don't have an account?<a href="#signup" id="signup-login"> Sign up</a></p>
          </div>
        </form>
      </div>
    </div>

    <!--Sign Up-->
    <div id="signup">
      <div class="signup-container">
        <div class="signup-header">
          <h1>Sign Up</h1>
          <p>Please fill in this form to create an account.</p>
          <hr />
        </div>
        <form class="signup-form" action="" method="POST" id="signupfrm">
          <label class="signupform-label" for="email">Email</label>
          <input class="signupform-input" name="email_su" type="email" placeholder="Enter Email" required />

          <label class="signupform-label" for="username">Create Username</label>
          <input class="signupform-input" name="username_su" type="text" placeholder="Username" required />
          
          <label class="signupform-label" for="pass">Password</label>
          <input class="signupform-input" id="password1_su" name="password1_su" type="password" placeholder="Enter Password" required />
         
          <label class="signupform-label" for="rpass">Repeat Password</label>
          <input class="signupform-input" id="password2_su" name="password2_su" type="password" placeholder="Repeat Password" required />
         
          <label class="signupform-label" for="phoneNo">Phone Number</label>
          <input class="signupform-input" name="phone_su" type="text" placeholder="Phone Number" required
           oninput="this.value = this.value.replace(/[^+0-9]/g, '').replace(/^(\+.?)\+/g, '$1').replace(/(\+.*)\+/g, '$1');" />
          
          <div>
            <label class="signupform-label" for="checkbox">Remember me</label>
            <input type="checkbox" />
          </div>
          <label class="err" id="matchpass" for="passerr"></label>
          <p>
            By creating an account you agree to our
            <a href="#">Terms & Privacy</a>.
          </p>
          <div class="signupform-button">
            <button type="button">Cancel</button>
            <button type="submit" name="signup" >Sign Up</button>
          </div>
        </form>
      </div>
    </div>


    
      <!--Reviews-->
      <div id="reviews">
        <div class="reviews-container">
          <header class="reviews-header">
            <h2>Client Reviews</h2>
          </header>
          <div class="reviewsbox-container">
            <div class="reviews-box">
              <img src="images/r1.png" alt="" />
              <div>
                <p>
                  <span class="reviewsbox-span"> Ahmad:</span>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Aspernatur.
                </p>
              </div>
            </div>
            <div class="reviews-box">
              <img src="images/r2.png" alt="" />
              <div>
                <p>
                  <span class="reviewsbox-span"> Zana:</span>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Aspernatur.
                </p>
              </div>
            </div>
            <div class="reviews-box">
              <img src="images/r3.png" alt="" />
              <div>
                <p>
                  <span class="reviewsbox-span"> Darya:</span>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Aspernatur.
                </p>
              </div>
            </div>
            <div class="reviews-box">
              <img src="images/r4.png" alt="" />
              <div>
                <p>
                  <span class="reviewsbox-span"> Paywand:</span>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Aspernatur.
                </p>
              </div>
            </div>
            <div class="reviews-box">
              <img src="images/r5.png" alt="" />
              <div>
                <p>
                  <span class="reviewsbox-span"> Nova:</span>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Aspernatur.
                </p>
              </div>
            </div>
            <div class="reviews-box">
              <img src="images/r6.png" alt="" />
              <div>
                <p>
                  <span class="reviewsbox-span"> Rawand:</span>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Aspernatur.
                </p>
              </div>
            </div>
          </div>
          <footer class="reviews-footer">
            <p>For more reviews <a href="">Click here</a></p>
            <p>
              Want to add a review or give us a feedback?<a href="">
                Click here</a
              >
            </p>
          </footer>
        </div>
      </div>

      <!--Feedback-->
      <div id="feedback">
        <div class="feedback-container">
          <div class="feedback-header">
            <h2>Give us your feedback</h2>
          </div>
          <div class="feedback-caption">
            <p>
              please <span>Login</span> first to add your feedback,<br />
              if you don't have an account <a href="#signup">click here</a> to
              make one.
            </p>
          </div>
          <div class="feedbackform-container">
            <form class="feedback-form" action="">
              <label class="feedbackform-label" for="username">Username</label>
              <input class="feedbackform-input" type="text" placeholder="Username" required />
              <label class="feedbackform-label" for="password">Password</label>
              <input
                class="feedbackform-input"
                type="pass"placeholder="Password"required />
              <label class="textarea-label" for="textarea"
                >Enter your opinion here:
              </label>
              <textarea
                name="feedback"
                rows="5"
                placeholder="Enter your opinion here"
              ></textarea>
              <button type="submit">SUBMIT</button>
            </form>
          </div>
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
    <script src="main.js"></script>
    <?php require('userrelate.php'); ?>
    
    
  </body>
</html>
