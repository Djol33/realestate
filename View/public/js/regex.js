function confName(el){
    let reg = /^[A-Z]{1}[a-z]{1,9}$/
 
    return reg.test(el.value)
}
function confemail(e){
    let reg = /[\w\d\_\-\+\.]\@[\w\.]+$/
    return reg.test(e.value)
}
function confpassword(el){
    let len = (el.value.length > 8)? true:false;
    let digit = /[\d]/.test(el.value);
    let letters = /[\w]/.test(el.value);
    if(len && digit && letters) return true;
    return false;
}
function titleconf(el){
    if(el.value.length>2){
        return true;
    }
    return false;
}
function kvadratura(el){
    if(el.value >=1){
        return true;
        
    }
    return false;
}
function selectValidacija(el){
    if(el.value != 0){
        return true;

    }
    return false;
}
function priceCheck(el){
    if(el.value>0){
        return true;
    }
    return false;
}
function adresa(el){
    if(el.value.length >3){
        return true;
    }
    return false;
}
function radioconf(el){
    for(let x of el){
        if(x.checked){
            return true;
        }
        
    }
    return false;
}

function opis(el, len=15){
    if(el.value.length > len){
        return true;
    }
    return false;
}


function sobe(el){
    if(el.value >=0.5 && el.value <=10){
        return true;
        
    }
    return false;
}

function passwordsEquals(x, y){
    return x.value == y.value

}
function addError(x){
    let name_error = x.id + '_error'
    if(document.querySelector(`#${name_error}`)){

    }
    else{
        let elementP = document.createElement("p")
        elementP.id = name_error;
        if(x.hasAttribute("data-error")){
            elementP.innerText = x.getAttribute("data-error");
        }
        else{
            elementP.innerText = "This field is mandatory"
        }
        elementP.classList.add("error")
        x.insertAdjacentElement('afterend',elementP);
    }
}
function removeError(x){
    let name_error = x.id + '_error'

    let errorP = document.getElementById(`${name_error}`)
    if(errorP) errorP.remove()
}