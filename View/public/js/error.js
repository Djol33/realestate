function errorPopUp(message){
    let  body=document.querySelector("body")
    
    let overlay=document.createElement("div")
    
    overlay.classList.add("overlay")
    let x = document.createElement("i")
    x.classList.add("fa-solid", "fa-xmark","x");
    let p = document.createElement("p")
    p.innerHTML=message
    x.addEventListener("click", function(){
        overlay.remove();
    })
    overlay.appendChild(p)
    overlay.appendChild(x)
    body.appendChild(overlay)
    //overlay.innerHTML=message;
    
}