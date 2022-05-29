
const emailStored = sessionStorage.getItem('email')

if(emailStored != null){
    $(document).ready(function(){
        $('#log-in1').css('display' , 'none')
        $('#logout1').css('display' , 'initial')
        $('#login').css('display' , 'none')
        $('#signup').css('display' , 'none')
        $('#sidenav-login').css('display' , 'flex')
        $('#email-addr').text(emailStored);
    });
}else{ //if it is null
    $('#log-in1').css('display' , 'initial')
    $('#logout1').css('display' , 'none')
    $('#login').css('display' , 'flex')
    $('#signup').css('display' , 'flex')
    $('#sidenav-login').css('display' , 'none')

}


/* Set the width of the left side navigation to 260px */
function openNav() {
    document.getElementById("mySidenav").style.width = "260px";
}

/* Set the width of the left side navigation to 0 */
function closeNav() {
document.getElementById("mySidenav").style.width = "0";
}
/* function to close side navbar when you click link */
$(document).ready(function(){


$('.booking').click(function(){
  
  var user = sessionStorage.getItem('userid')
  if(user != null){
    var packageid = $(this).attr("value")
    sessionStorage.setItem('packageid',packageid)

    
    $.ajax({
      url: 'checkifbooked.php',
      method: 'POST',
      data: {pid:packageid,uid:user},
      success: function(res){
       console.log("//"+res.includes('none')+"//")
       console.log('packageid:'+packageid)
        if(!res.includes('none')){
         var cancel1 = confirm('you already booked this flight if you want to cancel it, fill you card information and passport number then hit confirm button')

         if(cancel1){//this means the user already booked this flight
console.log('cancel1:'+cancel1)

         var cancel2 = confirm('you are about to cancel your flight please reassure that you want to cancel it!!')
         if(cancel2 ==1 ){//reconfirm cancelling the flight
console.log('cancel2:'+cancel2)
          $.ajax({
            url: 'flightcancelling.php',
            method: 'POST',
            data: {dt: res},
            success: function(res2){
            console.log("second AJAX:"+res2)
            }
          })

         }
        }
        }else{
          location.href = "countries.php"

        }
        
          
      }
  })
    

  }else{
    alert('you haven\'t logged in, please login')
    location.href = '#login'
  }
 
})


window.history.replaceState("","",window.location.href)

$(".navlink").click(closeNav);
$("#logout1").click(function(){
    sessionStorage.clear()
    $('#log-in1').css('display' , 'initial')
    $('#logout1').css('display' , 'none')
    $('#login').css('display' , 'flex')
    $('#signup').css('display' , 'flex')
    $('#sidenav-login').css('display' , 'none')
});

$('#signup-login').click(function(){
  $('#yousignedup').css('display' , 'none')
  $('#signup').css('display' , 'flex')

})
});

$('#signupfrm').submit(function() {
    if($('#password1_su').val().length <8){
      $("label[for = passerr]").text("The password length must more than 7 !!");
      document.getElementById('matchpass').style.display = 'initial'
      return false;
    }else if($('#password1_su').val() != $('#password2_su').val()){
      $("label[for = passerr]").text("Password doesn\'t match !!!");
     document.getElementById('matchpass').style.display = 'initial'
     return false;
   }else 
     return true;
  });

  $('#loginfrm').submit(function() {
    if($('#login-password').val().length <8){
      $("label[for = loginerr]").text("The password length must more than 7 !!");
      document.getElementById('loginerr').style.display = 'initial'
      return false;
    }else 
     return true;
  });

 