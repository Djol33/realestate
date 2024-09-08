let retrived;
const filter = {
    city:[],
    search:"",
    typeOfObject:[],
    orderby:0,
    page:0,
    max_pages:0

}

    let xhrApartment = new XMLHttpRequest()
    xhrApartment.open("GET", "getApartmentsJS")
    xhrApartment.onreadystatechange = function(){
        if(xhrApartment.status ==200 && xhrApartment.readyState==4){
            try{
                var allApartments = JSON.parse(xhrApartment.responseText);
                retrived = allApartments;
                filter.max_pages = Math.ceil(allApartments.length/20);


                addApartmentToList(allApartments);

                paginationSet(retrived)

            }catch(e){
                errorPopUp(e)
            }


        }
    }
    xhrApartment.send();
    function addApartmentToList(res){
        let apartmentList = document.querySelector("#apartments")
        apartmentList.innerHTML="";


        if(!res.length) {
            apartmentList.innerText = "We couldnt find anything"
        }else{
                    filter.max_pages = Math.ceil( res.length / 20);

        }
        for(let i = filter.page * 20 , j =filter.page*20+20;   (i  )<j && i<res.length ; i++){

 
            let apartmentone = document.createElement("a");
            apartmentone.classList.add("blockApartment")
            apartmentone.href = `openApartment?id=${res[i].id}`;
            let col1 = document.createElement("div");
            col1.id="image";
            col1.style.backgroundImage = `url('${res[i].img_url}')`;


            let col2 = document.createElement("div")
            col2.id = "col2";
            let col3 = document.createElement("div");
            col3.id = "col3";
            //naslov
            let title = document.createElement("h1");
            title.innerText = res[i].title
            //adresa
            let adress = document.createElement("p")
            adress.classList.add("adress")
            adress.innerText = res[i].adress


            //number of rooms
            let numberOfRooms = document.createElement("p")
            numberOfRooms.classList.add("numberOfRooms")
            numberOfRooms.innerHTML = "number of rooms: " + res[i].numberOfRooms
            let city=document.createElement("p")
            city.classList.add("city")
            city.innerHTML=res[i].city.cityname

            //area

            let area = document.createElement("p");
            area.classList.add("area")
            area.innerHTML = res[i].area + "m<sup>2</sup>";
            
            //area num of rooms holder
            let areaRoomDiv = document.createElement("div")
            areaRoomDiv.classList.add("areaRoomDiv")

            areaRoomDiv.appendChild(area)
            areaRoomDiv.appendChild(numberOfRooms);


            //price
            let price= document.createElement("p")
            price.classList.add("price")
            price.innerHTML = `${res[i].price}&euro;`
            //price sq/m
            let priceSQM = document.createElement("p")
            priceSQM.classList.add("priceSqm")
            priceSQM.innerHTML = Math.round(res[i].price / res[i].area) +" &euro;/m<sup>2</sup>"
            col3.appendChild(priceSQM)
            col3.appendChild(price);
            col2.appendChild(title)
                            col2.appendChild(city)
            col2.appendChild(adress)
            
            col2.appendChild(areaRoomDiv)
            apartmentone.appendChild(col1)
            apartmentone.appendChild(col2)
            apartmentone.appendChild(col3)

            apartmentList.appendChild(apartmentone)
        }
    }

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
                            filter.city.splice(filter.city.indexOf(this.getAttribute("data-city-id")),1 );
                            this.remove()
                            filterAll()
 
         
                        })
                        el.remove()
                        element.value=""
                    }
                    filterAll()
                }
            }
        
        }

        window.addEventListener("load", function(){
            let city = document.querySelector("#cityconsole");
            city.addEventListener("keydown", function(e){
        addCityForSearch(this, e);
        filterAll()
    })
    let datalist = document.querySelector("#city");
    datalist.addEventListener("blur",function(e){
 
        addCityForSearch(this, e);
        filterAll()
    })

    let select = document.getElementsByName("tipObjekta");
    select.forEach(e=>{
        e.addEventListener("click", function (ex) {
            if(this.checked){
                filter.typeOfObject.push(this.value)
            }
            else{
                let index = filter.typeOfObject.indexOf(this.value);
        if (index !== -1) {
      filter.typeOfObject.splice(index, 1);
        }
            }
            filterAll();
          })
    })
    

let search = document.querySelector("#search")
search.addEventListener("input", function(){
    filter.search=this.value;
    filterAll();
})
let orderby = document.querySelector("#orderby")
orderby.addEventListener("change", function(){
    filter.orderby = this.value;
    filterAll()
})




        })


function filterAll(){
    var newArray = retrived;
    if(filter.city.length){
        newArray = newArray.filter((e)=>{ return filter.city.includes(String(e.city.citycode))
       })
 

    }  
    if(filter.typeOfObject.length){
 
        newArray = newArray.filter((e)=>{
            return filter.typeOfObject.includes( String(e.typeObject.typeObject))
        })
    }
    if(filter.search!=""){
        let reg = new RegExp(filter.search.toLowerCase())
        newArray = newArray.filter((e)=>{
            return reg.test(e.title.toLowerCase())})
    }
    if(Number(filter.orderby)){
        if(filter.orderby==1){
              newArray.sort((a, b) => a.price - b.price);
        }
        else if(filter.orderby==2){
            newArray.sort((a, b) => b.price - a.price);
        }
        else if(filter.orderby==3){
            newArray.sort((a, b) => a.id - b.id);
        }
        else if(filter.orderby==4){
            newArray.sort((a, b) => b.id - a.id);
        }
    }
    filter.page=0;
    filter.max_pages = Math.ceil(newArray.length/20)



    addApartmentToList(newArray);
    paginationSet(newArray);
}

function paginationSet(res){
 
    let pagination = document.querySelector("#pagination");
    pagination.innerHTML=""

    if(filter.page < 4){
        for(let i =0; i<6 && i<filter.max_pages ;i++){
            let span = document.createElement("span");
            span.innerHTML = i+1
            span.setAttribute("data-page", i);
            if(filter.page == span.getAttribute("data-page")){
                span.classList.add("active");
            }
            span.addEventListener("click", function(){
                filter.page = this.getAttribute("data-page");
                addApartmentToList(res)
                paginationSet(retrived)
 
            })
            pagination.appendChild(span)
        }
    }
    else{
        for(let i =filter.page-3, j = 1; j<7 &&  i<filter.max_pages ; j++,i++){
            let span = document.createElement("span");
            span.innerHTML = i+1
            span.setAttribute("data-page", i);
            if(filter.page == span.getAttribute("data-page") ){
                span.classList.add("active");
            }
            span.addEventListener("click", function(){
                paginationSet(retrived)
                addApartmentToList(res);
                filter.page = this.getAttribute("data-page");
               
                //getAllApartments()
            })
            pagination.appendChild(span)

        }  
    }

}