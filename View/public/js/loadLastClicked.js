window.addEventListener("load", function(){
    if(this.localStorage.getItem("titleClicked") 
    && this.localStorage.getItem("img_srcClicked")
&&this.localStorage.getItem("titleClicked")){
        let div = this.document.createElement("a")
        div.href=this.localStorage.getItem("href")
        div.id = "lastClicked";
        let lastApartmant = this.document.createElement("h2")
        lastApartmant.innerText="Lastly seen";

        let img = this.document.createElement("img")

        img.src=this.localStorage.getItem("img_srcClicked")
        img.alt = "lastClicked"
        img.style.width="300px"
        let title = this.document.createElement("h1")
        title.innerHTML=this.localStorage.getItem("titleClicked");
        let price = this.document.createElement("p")
        price.innerHTML = this.localStorage.getItem("priceClicked");
        div.appendChild(lastApartmant)
        div.appendChild(img)
        div.appendChild(title)
        div.appendChild(price)
        let filter = this.document.querySelector("#filter")
        filter.appendChild(div)
    
    }
})