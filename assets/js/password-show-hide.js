let passwordField = document.querySelector(".form input[type='password']");
let toggleBtn = document.querySelector(".form .field i");

function toggle(){
    if(passwordField.type == "password"){
        passwordField.type = "text";
        toggleBtn.classList.add("active");
    }else{
        passwordField.type = "password";
        toggleBtn.classList.remove("active");
    }
}

toggleBtn.addEventListener("click", toggle);
