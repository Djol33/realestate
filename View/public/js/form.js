
let form = document.querySelector("#firstForm")
let next = document.querySelector("#next")
var mapIdFunc = new Map();
function savedRegister(){
    for(let [x,y] of mapIdFunc.entries()){
        let el = document.querySelector(`#${x}`)

        if(el && localStorage.getItem(x)){
            el.value = localStorage.getItem(x)
 
        }
        
    }
}
function checkAllFields(){
    for(let [key, value] of mapIdFunc.entries()){
 
    }
}
function formEngine(){
    var fName = document.querySelector("#fName")
    var lName = document.querySelector("#lName")
    var email = document.querySelector("#email")
    var password = document.querySelector("#password")
    var confPassword = document.querySelector("#confPassword")

    let arrayOfElements = [fName,lName,email,password,confPassword]


    mapIdFunc.set(String(fName.id), confName(fName))
    mapIdFunc.set(String(lName.id), confName(lName))
    mapIdFunc.set(String(email.id), confemail(email))
    mapIdFunc.set(String(password.id),confpassword(password))
    mapIdFunc.set(String(confPassword.id), confpassword(confPassword))

    arrayOfElements.forEach((element)=>{
        if(localStorage.getItem(element.id)) {
            element.innerHTML = localStorage.getItem(element.id)
        }
        element.addEventListener('input', function(){
            try{
            localStorage.setItem(this.id, this.value)
            }
            catch(err){
                console.log("Turn on your localstorage")
            }
            if(!mapIdFunc.get(this.id)){
                addError(this)
            }
            else{
                removeError(this)
            }

        })
 
})  
}
window.addEventListener("load", function(){

    formEngine()
    savedRegister() 
    

    


})

next.addEventListener("click", function(){
    for(let [key, value] of mapIdFunc.entries()){
        if(!value) break;

    }
    let password = document.querySelector("#password")
    let confPassword = document.querySelector("#confPassword")
    if(!passwordsEquals(password,confPassword)) {
        if(!document.querySelector("#password_error")){
        let error = document.createElement("p")
        error.innerText = "Passwords doesnt match"
        error.id = "password_error"
        let parent = this.parentElement
        parent.insertAdjacentElement("beforebegin", error)
        }
    }
    else{
        if(document.querySelector("#password_error")){
            document.querySelector("#password_error").remove();
        }

    }
    try{
    let obj = new XMLHttpRequest()
    obj.open("POST", 'register', true)
    obj.setRequestHeader("Content-type", "application/json");
    let data = {
        fname : fName.value,
        lname :lName.value,
        email : email.value,
        password : password.value,
        passwordConf: confPassword.value
        
    }

    obj.send(JSON.stringify(data))
    obj.onreadystatechange = function () {
        
        if (obj.readyState === XMLHttpRequest.DONE) {
 
            var error = document.createElement("p");
            error.id = "error"
            if(x = document.querySelector("#error")){
                x.remove()
            }
            if (obj.status === 201) {
                localStorage.clear();
                window.location.replace("login") 
            }
            else if(obj.status === 503){
                error.innerText = "Our servers are currently down, try aggain in a few minutes";
             }
            else if(obj.status === 409){

                error.innerText = "Passwords doesnt match or someone is already using that mail already";
             }
            else if(obj.status === 403){

                error.innerText = "Dont change pre defined name attributes";

            }
            else if(obj.status === 406){

                error.innerText = "Fill your fields per our requirements";

            }
            form.insertAdjacentElement("beforeend", error);
        }

}
    }catch(err){
        console.log(err)
    }
})
form.addEventListener("input", function(){
    formEngine()
})

 