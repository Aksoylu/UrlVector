var headerLogo = null;
var header = null;

var checkButton = null;
var actionForm = null;
var searchInput = null;
var availabilityText = null;

var formUrl = null;
var formPinInput = null;
var formNavigationDelayCheck = null;
var formIntranetDomainCheck = null;

var dynamicArea = null;
var userMessage = null;

var responseDynamicArea = null;
window.onload = ()=>{

    headerLogo = document.querySelector(".header_logo"); 
    header = document.querySelector(".header");

    checkButton =  document.querySelector("#checkButton");
    actionForm =  document.querySelector(".action-form");
    availabilityText = document.querySelector(".available");

    formUrl = document.querySelector("#formUrl");
    formPinInput = document.querySelector("#formPinInput");
    formNavigationDelayCheck = document.querySelector("#formNavigationDelayCheck");
    formIntranetDomainCheck = document.querySelector("#formIntranetDomainCheck");
    dynamicArea = document.querySelector("#dynamicArea");
    responseDynamicArea = document.querySelector("#responseDynamicArea");

    searchInput = document.querySelector("#searchInput");
    if (searchInput != null)
    {
        searchInput.addEventListener("keyup", function(event) {
        
            if (event.keyCode === 13) 
            {
              event.preventDefault();
              if(!checkButton.disabled)
                fetchService();
            }
        });
    }

    headerLogo.addEventListener("click", ()=>{
        window.location = "/";
    })

    header.addEventListener("click", ()=>{
        window.location = "/";
    })

}


/* === UI Interactions ===  */

const checkInput = (e) =>{
    setTimeout(()=>{
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
    if(data.code == 200)
    {
        if(data.isAvailable)
        {
            responseDynamicArea.innerHTML = data.msg + '<br>' + '<a target="_blank" href="' + data.issuedDomain + '">' + data.issuedDomain + '</a>' ;
            responseDynamicArea.classList.remove("text_red");
            responseDynamicArea.classList.add("text_green");
        }
        else
        {
            responseDynamicArea.innerHTML = data.msg;
            responseDynamicArea.classList.remove("text_green");
            responseDynamicArea.classList.add("text_red");
        }
    }
    else
    {
        responseDynamicArea.innerHTML = data.msg;
        responseDynamicArea.classList.remove("text_green");
        responseDynamicArea.classList.add("text_red");
    }
}



/* ===  Services === */

const issueService = ()=>{
    event.preventDefault();

    let formData = new FormData();
    formData.append("target_path",searchInput.value);
    formData.append("source_url",formUrl.value);
    formData.append("password",formPinInput.value);
    formData.append("is_intranet_domain", formIntranetDomainCheck.checked);
    if(formNavigationDelayCheck.checked)
    {
        formData.append("delay", 1);
        formData.append("user_message",userMessage.value);
    }
    else
    {
        formData.append("delay", 0);
        formData.append("user_message","");
    }
    
    let request = new XMLHttpRequest();
    request.open('POST', 'issueUrl.service', true);
    request.send(formData);

    request.onload = function() {
        if (this.status == 200) 
            setIssueResponse(JSON.parse(this.response));
        else
            setIssueResponse({'code' : 500 , 'msg': serviceServerError});
    };
    
};

const fetchService = ()=>{
    var request = new XMLHttpRequest();
    request.open('POST', 'isAvailable.service', true);

    request.onload = function() {
        if (this.status == 200) 
        {
            console.log(this.response);
            let data = JSON.parse(this.response);
            availabilityText.innerHTML = data.msg;
            setAvailability(data.isAvailable);

        } 
    };
    let formData = new FormData();
    formData.append("url_name",searchInput.value)
    request.send(formData);
};
