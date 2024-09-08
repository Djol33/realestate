let datalist = document.querySelector("#city");
function addCityForSearch(element, e){
let datalist = document.querySelector("#city");
let selectedCitiesData = document.querySelector("#selectedCities");

    if(element.value.length == 5){


        if(e.keyCode == 13 ){
            let el = document.querySelector("option[value='" + element.value +"']");
            if(el){
                filter.city.push(el.value)
                let newcity = document.createElement("div")
                let span = document.createElement("span")
                let icon = document.createElement("span")
                icon.classList.add("fa-solid","fa-xmark", "icon")
                span.innerText = el.innerText;
                newcity.appendChild(span)
                newcity.appendChild(icon)
                newcity.setAttribute("data-city-id", el.value);
                newcity.setAttribute("data-city-name", el.innerText );
                selectedCitiesData.appendChild(newcity);
                newcity.addEventListener("click", function(){
                
                    let itembacktodatalist = document.createElement("option")
                    itembacktodatalist.innerText = this.getAttribute("data-city-name");
                    itembacktodatalist.value = this.getAttribute("data-city-id");
                    datalist.appendChild(itembacktodatalist)
                    filter.city.splice(filter.typeOfObject.indexOf(this.getAttribute("data-city-id")),1 );
                    this.remove()
                    filter.page=0;
                    getAllApartments()

                })
                el.remove()
                element.value=""
            }
        }
    }

}
let cityconsole = document.querySelector("#cityconsole");
cityconsole.addEventListener("keydown", function(e){
    addCityForSearch(this, e);
})
 
 
datalist.addEventListener("blur",function(e){
 
    addCityForSearch(this, e);
})
window.addEventListener("load", getAllApartments)