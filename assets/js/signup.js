const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input");

form.onsubmit = (event)=>{
    event.preventDefault();
}

continueBtn.onclick = ()=>{
    // starting ajax
    let xhr = new XMLHttpRequest //creating xml object

    xhr.open("POST", "php/signup.php"); // takes many parameters but i use only pass method, url and async
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response; //this response is come from php file without reloading page
                console.log(data);
            }
        }
    }
    // send the form data through ajax to php
    let formData = new FormData(form);// creating new formData object
    xhr.send(formData); //sending the form data to php
}