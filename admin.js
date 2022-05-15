
document.getElementById('user').addEventListener('click',user)
document.getElementById('flight').addEventListener('click',flight)


function user(){
    document.getElementById('showUser').style.display = 'flex'
    document.getElementById('showFlight').style.display = 'none'
    document.getElementById('user').style.backgroundColor = 'black'
    document.getElementById('flight').style.backgroundColor = '#0505057e'
    document.getElementById('usertbl').style.display = 'flex'
    document.getElementById('flighttbl').style.display = 'none'
}

function flight(){
    document.getElementById('showFlight').style.display = 'flex'
    document.getElementById('showUser').style.display = 'none'
    document.getElementById('flight').style.backgroundColor = 'black'
    document.getElementById('user').style.backgroundColor = '#0505057e'
    document.getElementById('usertbl').style.display = 'none'
    document.getElementById('flighttbl').style.display = 'flex'

}
//this function will trigger the input element
function openInput(){
    document.getElementById('openFile').click()
}
//this function triggers when the file submitted to input element, and we will get the file name here
function onInputChange(){
    var x = document.getElementById("openFile");
    var img_name = "";
    if ('files' in x) {
        if (x.files.length == 1) { //this means you can't choose multiple images or no iamge
            img_name =x.files[0].name + "";
        }
    } 
   
document.getElementById("imglbl").innerHTML = img_name;
}
