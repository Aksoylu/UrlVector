var userMessageText = null;
var timeLeftText = null;
var timeLeft = null;
var navigateFlag = false;

const countDown = (e) =>{
    if (navigateFlag)
        return;

    timeLeft -= 1;
    timeLeftText.innerHTML = timeLeft;
    if(timeLeft<1)
    {
        window.location.href = navigationUrl;
        navigateFlag = true;
    }
        
}

const pageDefine = ()=>{
    timeLeft = navigationDelay;
    timeLeftText =  document.querySelector("#timeLeftText");
    userMessageText =  document.querySelector("#userMessageText");
    setInterval(countDown, 900);
}

setTimeout(pageDefine,100);
