window.addEventListener("load",function(){
    let title=this.document.querySelector("title").innerText;
 
    localStorage.setItem("titleClicked", title);
    let img = this.document.querySelector(".main")
    let img_src= this.getComputedStyle(img).backgroundImage
    let href=this.window.location.href;
 
    this.localStorage.setItem("href", href);
 
    img_src = img_src.substring(5, img_src.length - 2)
    
    this.localStorage.setItem("img_srcClicked", img_src)
    let price = this.document.querySelector("#textprice").innerText;
    this.localStorage.setItem("priceClicked", price)
    
})