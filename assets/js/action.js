var checkButton = null;
var actionForm = null;
var searchInput = null;
var availabilityText = null;

var formUrl = null;
var formPinInput = null;
var formNavigationDelayCheck = null;

var dynamicArea = null;
var userMessage = null;

window.onload = ()=>{
    checkButton =  document.querySelector("#checkButton");
    actionForm =  document.querySelector(".action-form");
    availabilityText = document.querySelector(".available");
    searchInput = document.querySelector("#searchInput");

    formUrl = document.querySelector("#formUrl");
    formPinInput = document.querySelector("#formPinInput");
    formNavigationDelayCheck = document.querySelector("#formNavigationDelayCheck");

    dynamicArea = document.querySelector("#dynamicArea");
}


/* === UI Interactions ===  */

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

const navigationDelayChanged = () =>{
    if (formNavigationDelayCheck.checked)
    {   
        dynamicArea.innerHTML = `
            <div class="form-group">
                <label for="userMessage">` + userMessageHeader + `</label>
                <input class="form-control" id="userMessage" placeholder="` + userMessagePlaceholder + `">
                <small class="form-text text-muted">` + userMessageText + `</small>
            </div>
        `;

        userMessage = document.querySelector("#userMessage");
    }
    else
    {
        dynamicArea.innerHTML = ``;
        
    }
}

const setIssueResponse = (data) =>{
    console.log(data);
    //TODO : Complate interaction
}



/* ===  Services === */

const issueService = ()=>{
    event.preventDefault();

    var request = new XMLHttpRequest();
    request.open('POST', 'issueUrl.service', true);

    request.onload = function() {
        if (this.status == 200) 
        {
            let data = JSON.parse(this.response);
            setIssueResponse(data);
        }
        else
        {
            setIssueResponse({'code' : 500 , 'msg': serviceServerError});
        }
    };
    let formData = new FormData();
    formData.append("target_path",searchInput.value);
    formData.append("source_url",formUrl.value);
    formData.append("password",formPinInput.value);
    formData.append("delay", formNavigationDelayCheck.checked);
    formData.append("user_message",userMessage.value);
    request.send(formData);
};

const fetchService = ()=>{
    var request = new XMLHttpRequest();
    request.open('POST', 'isAvailable.service', true);

    request.onload = function() {
        if (this.status == 200) 
        {
            let data = JSON.parse(this.response);
            availabilityText.innerHTML = data.msg;
            setAvailability(data.isAvailable);

        } 
    };
    let formData = new FormData();
    formData.append("url_name",searchInput.value)
    request.send(formData);
};
