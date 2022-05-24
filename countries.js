
/* radio button functions */
$(document).ready(function(){
   
    
    var pid = $('#pid').val(sessionStorage.getItem('packageid'))
    var uid = sessionStorage.getItem('userid')
    $('#uid').val(uid)
    $('#payput').val(uid)

    
    sessionStorage.removeItem('seatnumber')
    
    $.ajax({
        url: 'test.php',
        method: 'POST',
        data: pid,
        success: function(res){
            var json_data = JSON.parse(res)

            $('#fromcountry').val(json_data.from)
            $('#departure').val(json_data.departure.replace(' ','T'))
            $('#airline').val(json_data.airline)
            $('#price').val(json_data.price)

            if(json_data.type == "Round Trip"){
            $('#return').val(json_data.return.replace(' ','T'))
            $(".r1").css("display","flex");
            $(".r1").css("display","flex");
            $(".cr1").attr('checked', 'checked');
            }else{
            $(".r1").hide();
            $(".cr2").attr('checked', 'checked');

            }

            
        }
    })


});


const buttonSeat1 = document.querySelector(".buttonSeat1");
const buttonSeat2 = document.querySelector(".buttonSeat2");

const seat = [
    {
        id: 1,
        isCheckt: false,
        name: '1',
        class: "B"
    },
    {
        id: 2,
        isCheckt: false,
        name: '2',
        class: "B"
    },
    {
        id: 3,
        isCheckt: false,
        name: '3',
        class: "B"
    },
    {
        id: 4,
        isCheckt: true,
        name: '4',
        class: "B"
    },
    {
        id: 5,
        isCheckt: false,
        name: '5',
        class: "B"
    },
    {
        id: 6,
        isCheckt: true,
        name: '6',
        class: "B"
    },
    {
        id: 7,
        isCheckt: false,
        name: '7',
        class: "B"
    },
    {
        id: 8,
        isCheckt: false,
        name: '8',
        class: "B"
    },
    {
        id: 9,
        isCheckt: true,
        name: '9',
        class: "E"
    },
    {
        id: 10,
        isCheckt: false,
        name: '10',
        class: "E"
    },
    {
        id: 11,
        isCheckt: false,
        name: '11',
        class: "E"
    },
    {
        id: 12,
        isCheckt: true,
        name: '12',
        class: "E"
    },
    {
        id: 13,
        isCheckt: false,
        name: '13',
        class: "E"
    },
    {
        id: 14,
        isCheckt: false,
        name: '14',
        class: "E"
    },
    {
        id: 15,
        isCheckt: true,
        name: '15',
        class: "E"
    },
    {
        id: 16,
        isCheckt: false,
        name: '16',
        class: "E"
    },
    {
        id: 17,
        isCheckt: false,
        name: '17',
        class: "E"
    },
    {
        id: 18,
        isCheckt: false,
        name: '18',
        class: "E"
    },



]
var reserved = [6,4,9,12,15]
var seatNum = null;

buttonSeat1.innerHTML = ''
buttonSeat2.innerHTML = ''

seat.forEach(element => {


    if (element.class == 'B') {
        const btn1 = document.createElement('button')
        btn1.classList.add('btn1')
        btn1.id = element.id;
        btn1.innerText = element.name
        if (element.isCheckt) {
            btn1.classList.add('display-btn1')
        }
        btn1.addEventListener('click', () => {
            if ((seatNum==null || element.isCheckt) && !reserved.includes(element.id)) {
            
            if (element.isCheckt ) {
                // alert('the seat was reserved')
                if (seatNum!=null) {
                    const name = confirm('are you sure to cancel the seat')
                    if (name ==true) {
                        element.isCheckt = false
                        btn1.classList.remove('display-btn1')
                        seatNum=null

                    }
                }
            } else {
                const name = confirm('are you sure to book the seat number '+element.id)
                if(name == true){
                element.isCheckt = true
                seatNum = element.id
                btn1.classList.add('display-btn1')

                }
            }
        }
        else {
            if(reserved.includes(element.id))
            alert('you can\'t cancel others seat')
            else alert('you reserved the seat number '+seatNum+' before')
        }
        })
        buttonSeat1.append(btn1)

    }
    else if (element.class == 'E') {

        const btn2 = document.createElement('button')
        btn2.classList.add('btn2')
        btn2.id = element.id;
        btn2.innerText = element.name
        if (element.isCheckt) {
            btn2.classList.add('display-btn2')
        }
        btn2.addEventListener('click', () => {
        

            if ((seatNum==null || element.isCheckt) && !reserved.includes(element.id)) {
            
                if (element.isCheckt ) {
                    // alert('the seat was reserved')
                    if (seatNum!=null) {
                        const name = confirm('are you sure to cancel the seat')
                        if (name ==true) {
                            element.isCheckt = false
                            btn2.classList.remove('display-btn2')
                            seatNum=null

                        }
                    }
                } else {
                    const name = confirm('are you sure to book the seat number '+element.id)
                    if(name == true){
                    element.isCheckt = true
                    seatNum=element.id
                    btn2.classList.add('display-btn2')
                    }
                }
            }
            else {
                if(reserved.includes(element.id))
                alert('you can\'t cancel others seat')
                else alert('you reserved the seat number '+seatNum+' before')
            }

        })
        buttonSeat2.append(btn2)
    }


});

const landscape=document.querySelector('#landscape-class')
const portrait=document.querySelector('#portrait-class')
const seatButtons=document.querySelector('#seatButtons-container')
const countries=document.querySelector('#countries')

/* display Class container */
function showSeats(){
    countries.style.pointerEvents = "none"
    countries.style.userSelect = "none"
    countries.style.filter = "blur(1px)"
    landscape.classList.toggle('show-landscapeClass')
    portrait.classList.toggle('show-portraitClass')
    seatButtons.classList.add('show-seatButtonsContainer')   
}
/* Close Class container */
function closeSeats(){
    
    sessionStorage.setItem('seatnumber',seatNum)
    $('#snumber').val(sessionStorage.getItem('seatnumber'))
    countries.style.pointerEvents = "initial"
    countries.style.userSelect = "initial"
    countries.style.filter = "initial"
    landscape.classList.remove('show-landscapeClass')
    portrait.classList.remove('show-portraitClass')
    seatButtons.classList.remove('show-seatButtonsContainer')
   
}

const pay=document.getElementById('pay')
/* display Payment */
function openPay() {
    pay.style.display='initial'
    document.getElementById("countries").style.pointerEvents = "none";
    document.getElementById("countries").style.userSelect = "none";
    document.getElementById("countries").style.filter = "blur(1px)";
}
/* Close Payment */
function closePay() {
    pay.style.display='none'
    document.getElementById("countries").style.pointerEvents = "initial";
    document.getElementById("countries").style.userSelect = "initial";
    document.getElementById("countries").style.filter = "initial";

}

