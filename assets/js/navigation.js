var userMessageText = null;
var timeLeftText = null;
var timeLeft = null;
var navigateFlag = false;
window.onload = ()=>{
    timeLeft = navigationDelay;
    timeLeftText =  document.querySelector("#timeLeftText");
    userMessageText =  document.querySelector("#userMessageText");
    setTimeout(setInterval(countDown, 900),100);
}

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
