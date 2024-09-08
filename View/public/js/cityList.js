
window.addEventListener("DOMContentLoaded",function(){
let xhr = new XMLHttpRequest();
xhr.open("GET", 'city', true);
xhr.send();
xhr.onreadystatechange = function () { 
    if(xhr.readyState === 4){
        try{
            let select= document.querySelector("#city")
            if(xhr.status === 200){
    
                let json = JSON.parse(xhr.responseText);
    
                    json.forEach(element => {
                        let opt = document.createElement("option")
                        opt.value = element.zip;
                        opt.innerText = element.city;
                        select.appendChild(opt)
                    }) 
            }
            else if(xhr.status === 503){
                window.location.reload();
            }
        }catch(err){
            errorPopUp("We couldnt load cities please try again later")
        }
         

    }
 }

})