
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
$(".navlink").click(closeNav);
$("#logout").click(function(){
    sessionStorage.setItem("id","yawar")
    let val= sessionStorage.getItem("id")
    console.log(val)
    sessionStorage.clear()
});
});

/* function to close side navbar when you click anywhere except the side navbar */
$(document).ready(function(){
$('body').click(function(){ 
  if(!$('.menu-class').is(':hover') && !$('#mySidenav').is(':hover')){
    document.getElementById("mySidenav").style.width = "0";
}
});
});
