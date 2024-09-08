function toggleWishlist(atr,elem){
    let xhrWishlist = new XMLHttpRequest()
    xhrWishlist.open("POST", "wishlist", true)
    xhrWishlist.setRequestHeader("Content-Type", "application/json");
    let body1;
    body1 = {"id_post": atr}
 
 

    xhrWishlist.onreadystatechange = function(){
        if(xhrWishlist.readyState == 4 && xhrWishlist.status== 200){
            elem.classList.toggle("fa-solid")
            elem.classList.toggle("fa-regular")
            
            elem.classList.toggle("active")
            

        }
    }
    try{
        xhrWishlist.send(JSON.stringify(body1))
 
    }catch(e){
        errorPopUp("error occured please try again later")
    }

}


window.addEventListener("load", function(){
    try{
    let wishlist = document.querySelector("#wishlist");
    wishlist.addEventListener("click", function(){
        attr = this.getAttribute("data-id");
        toggleWishlist(attr,this)
 
    })
}
catch(e){

}
 
})

