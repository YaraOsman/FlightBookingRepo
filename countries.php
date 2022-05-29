<?php session_start(); ?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Countries</title>
    <link rel="icon" href="images/world-logo.png" />
    <link rel="stylesheet" href="countries.css" />
    <link rel="stylesheet" href="classSeats.css" />
    <link rel="stylesheet" href="payment.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <!--Countries-->
    <div id="countries">
      <div class="countries-container">
        <header class="countries-header"><h1>Book Flight Tickets</h1></header>
        <div class="countries-radio" >
          <div class="countriesradio-1">
            <input class="cr1" type="radio" name="Flight" checked onclick="return false;"/>
            <label for="radio">Round Trip</label>
          </div>
          <div class="countriesradio-2">
            <input class="cr2" type="radio" name="Flight" onclick="return false;"/>
            <label for="radio">One Way Trip</label>
          </div>
        </div>
        <form id="countyfrm" class="book-form" action="" method="POST">
          <label for="from" id="tstid">From</label>
          <select name="fromcountry" id="fromcountry">
            <option value="from" selected disabled hidden>Location</option>
          </select>
          <label for="departure" >Departure</label>
          <input type="datetime-local" id="departure" />
          <label class="r1" for="return">Return</label>
          <input class="r1" type="datetime-local" id="return"/>
          <label for="class">Class</label>
          <a onclick="showSeats()">Select a Class</a>
          <label for="airline">Preffered Airline</label>
          <select name="airline" id="airline">
            <option selected disabled hidden>Choose an airline</option>
          </select>
          <label for="price">Price</label>
          <input type="text" name='price' id="price"/>
          <label for="payment">Payment</label>
          <a onclick="openPay()">Pay with</a>
          <label for="passport">Passport Number</label>
          <input type="text" name='passport' id="passpord"/>
          <button type="submit" name="book" >Book</button>
          <input id="pid" name="pid" hidden />
          <input id="uid" name="uid" hidden />
          <input id="snumber" name="snumber" hidden/>
        </form>
      </div>
    </div>

      



    <!-- Seat Buttons -->
    <div class="seatButtons-container" id="seatButtons-container">
      <div class="buttonSeat1" id="buttonSeat1"></div>
      <div class="buttonSeat2" id="buttonSeat2"></div>
    </div>

    <!--  The landscape airplane  -->
    <div class="landscape-class" id="landscape-class">
      <header>
        <h3>Book the seat you want</h3>
        <div class="closebtn-container">
          <a href="javascript:void(0)" onclick="closeSeats()" class="closebtn"
            >&times;</a
          >
        </div>
      </header>
      <div class="landscapeAirplaneimg-container">
        <img src="images/airplane.png" alt="landscape airplane" />
      </div>
      <button onclick="closeSeats()" class="book-btn">Book</button>
    </div>

    <!--  The portrait airplane  -->
    <div class="portrait-class" id="portrait-class">
      <header>
        <h3>Book the seat you want</h3>
        <div class="closebtn-container">
          <a href="javascript:void(0)" onclick="closeSeats()" class="closebtn2"
            >&times;</a
          >
        </div>
      </header>
      <div class="portraitAirplaneimg-container">
        <img src="images/airplanePortrait.jpg" alt="portrait airplane" />
      </div>
      <button onclick="closeSeats()" class="book-btn2">Book</button>
    </div>






    <!-- Payment -->
    <div class="pay">
      <div id="pay">
        <div class="payment-container">
          <a href="javascript:void(0)" onclick="closePay()">&times;</a>
          <header class="payment-header">
            <img src="images/lockk.png" alt="" />
            <h2>Payment</h2>
          </header>
          <div class="paymentform-container">
            <form class="payment-form" action="" method="POST" id="payment-form">
              <label class="payment-label" for="name">CARDHOLDER'S NAME</label>
              <input class="payment-input" name="card-name" type="text" placeholder="Name on card" required/>
              <label class="payment-label" for="cardnumber">CARD NUMBER</label>
              <div class="cardnumber-input">
                <input class="payment-input" name="card-number" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}"
                autocomplete="cc-number" maxlength="19" placeholder="---- ---- ---- ----" required />
                <img src="images/credit icon.png" alt="" />
              </div>
              <div class="datecvv-container">
                <div class="date-container">
                  <label class="payment-label" for="date">EXPIRY DATE</label>
                  <input class="payment-input2" type="tel" placeholder="Mm/yyyy" name="card-exp" required/>
                </div>
                <div class="cvv-container">
                  <label class="payment-label" for="cvc">CVC/CVV</label>
                  <input class="payment-input2" type="tel" maxlength="3"
                   name="cvc" placeholder="Code" required />
                </div>
              </div>
              <button class="payment-button" name="paynow">Pay Now</button>
              <input id="payput" name="puid" hidden/>

            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="jquery-3.6.0.min.js"></script>
   
    <?php include('booking.php'); ?>
    <script src="./countries.js"></script>


  </body>
</html>
