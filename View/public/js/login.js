 
let form = document.querySelector("#firstForm")
let next = document.querySelector("#login")
let mail = document.querySelector("#email");
let pw = document.querySelector("#password")
mail.addEventListener("input", function(){
    if(
    !confemail(mail)){
        addError(mail)
    }
    else{
        removeError(mail)
    }
})
pw.addEventListener("input", function () { 
    if(!confpassword(pw)){
        addError(pw)
    }
    else{
        removeError(pw)
    }
 })

 next.addEventListener("click", function(){
    if(    confemail(mail) &&     confpassword(pw)){
        let element;
        if(element =document.querySelector("#error")){
            element.remove();

        }
        let xhr = new XMLHttpRequest();
        xhr.open("POST","login", true);
        //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        let param={
            email : mail.value,
            password :pw.value
        }
        xhr.send(JSON.stringify(param))
        xhr.onreadystatechange = function(){
            if(xhr.readyState === 4 ){
                try{

                
                let resp = xhr.response;
 
                console.log(resp);
                if(xhr.status ===200){
    

                    window.location.href = ""
 
                    
 
                }
                else if(xhr.status ===401){
                    let error = document.createElement("p")
                    error.innerText = "You are forbidden from accessing to your account, please contact support";
                    error.id="error"
                    next.insertAdjacentElement("beforebegin", error) 
                }
                else if(xhr.status===406){

                        let error = document.createElement("p")
                        error.innerText = "Mail or Password is incorret";
                        error.id="error"
                        next.insertAdjacentElement("beforebegin", error) 
                    
                }
                else if(xhr.status ===403){
                    let error = document.createElement("p")
                    error.innerText = "Dont change pre defined name attributes";
                    error.id="error"
                    next.insertAdjacentElement("beforebegin", error) 
                }
                else if(xhr.status === 503){
                    let error = document.createElement("p")
                    error.id="error"
                    error.innerText = "Servers are down please try again in a few minutes";
                    next.insertAdjacentElement("beforebegin", error)
                }
            }
            catch(err){
                errorPopUp(err);
            }
  
            }
        }
    }
    else{
        mail.dispatchEvent(new Event("input"));
        pw.dispatchEvent(new  Event("input"))
    }
 })
