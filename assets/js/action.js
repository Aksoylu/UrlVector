var checkButton = null;
var actionForm = null;
var availabilityText = null;
window.onload = ()=>{
    checkButton =  document.querySelector("#checkButton");
    actionForm =  document.querySelector(".action-form");
    availabilityText = document.querySelector(".available");
}

const fetchService = ()=>{
    var request = new XMLHttpRequest();
    request.open('POST', 'isAvailable.service', true);

    request.onload = function() {
        if (this.status == 200) 
        {
            console.log(this.response);
            let data = JSON.parse(this.response);
            //msg
            availabilityText.innerHTML = data.msg;
            setAvailability(data.isAvailable);

        } 
    };

    request.send();
};

const checkInput = (e) =>{

    setTimeout(()=>{
        console.log(e.value.length);
        if (e.value.length > 0)
            checkButton.disabled = false;
        else
            checkButton.disabled = true;

    }, 100 )
   
}

const setAvailability = (value) =>{
    if (value)
    {
        actionForm.classList.add('animate__bounceInLeft');
        actionForm.classList.remove('animate__bounceOutLeft');

        availabilityText.classList.add("text_green");
        availabilityText.classList.remove("text_red");
    }
    else
    {
        if (actionForm.classList.contains("animate__bounceInLeft"))
        {
            actionForm.classList.add('animate__bounceOutLeft');
            actionForm.classList.remove('animate__bounceInLeft');
        }
        availabilityText.classList.remove("text_green");
        availabilityText.classList.add("text_red");
    }
}