const loginsec=document.querySelector('.login-section')
const loginlink=document.querySelector('.login-link')
const registerlink=document.querySelector('.register-link')
registerlink.addEventListener('click',()=>{
    var div = document.getElementById("div-form");
    div.style.display =
        "block";
    loginsec.classList.add('active')
})
loginlink.addEventListener('click',()=>{
    var div = document.getElementById("div-form");
    div.style.display =
    "none";
    loginsec.classList.remove('active')
})