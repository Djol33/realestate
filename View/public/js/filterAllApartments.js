const filter = {
    city:[],
    typeOfObject:"",
    search:"",
    page:0

}
let typeOfObject = document.querySelector("#tipObjekta")
typeOfObject.addEventListener("change", function(){
    filter.typeOfObject = this.value
    filter.page=0;
    getAllApartments()
})
let sub = document.querySelector("#submit")
    let filtersForm = document.querySelector("#filters");
        filtersForm.addEventListener("input",function(e){
            e.preventDefault()
            sub.removeAttribute("disabled")
          
    
    })
    filtersForm.addEventListener("submit", function(e){
        e.preventDefault()
        //sub.setAttribute("disabled","disabled")
    })


     async function getAllApartments(){
        url = new URL(window.location.origin+"/FilterAllApartments");
    const searchParams = new URLSearchParams();
     Object.keys(filter).forEach( e=>{
        if(Array.isArray(e)){
            e.forEach(x=>{

                searchParams.append(e, x);
            })
        }
        else{
            searchParams.append(e, filter[e])
        }
     } )
    
     url.search = searchParams;
 
      let req = new XMLHttpRequest()
     req.open("GET",url.href)

     req.send()
     req.onreadystatechange=function(){
        if(req.status==200 && req.readyState==4){
            try{
                res = JSON.parse(req.responseText)
 
                let apartmentList = document.querySelector("#apartments")
                apartmentList.innerHTML = "";
                
                for(let i = 0; i < res["pages"].length; i++){
                    let apartmentone = document.createElement("a");
                    apartmentone.classList.add("blockApartment")
                    apartmentone.href = `openApartment?id=${res["pages"][i].id}`;
                    let col1 = document.createElement("div");
                    col1.id="image";
                    col1.style.backgroundImage = `url('${res["pages"][i].img_url}')`;
    
    
                    let col2 = document.createElement("div")
                    col2.id = "col2";
                    let col3 = document.createElement("div");
                    col3.id = "col3";
                    //naslov
                    let title = document.createElement("h1");
                    title.innerText = res["pages"][i].title
                    //adresa
                    let adress = document.createElement("p")
                    adress.classList.add("adress")
                    adress.innerText = res["pages"][i].adress
    
    
                    //number of rooms
                    let numberOfRooms = document.createElement("p")
                    numberOfRooms.classList.add("numberOfRooms")
                    numberOfRooms.innerHTML = "number of rooms: " + res["pages"][i].numberOfRooms
                    let city=document.createElement("p")
                    city.classList.add("city")
                    city.innerHTML=res["pages"][i].city_name
    
                    //area
    
                    let area = document.createElement("p");
                    area.classList.add("area")
                    area.innerHTML = res["pages"][i].area + "m<sup>2</sup>";
                    
                    //area num of rooms holder
                    let areaRoomDiv = document.createElement("div")
                    areaRoomDiv.classList.add("areaRoomDiv")
     
                    areaRoomDiv.appendChild(area)
                    areaRoomDiv.appendChild(numberOfRooms);
    
    
                    //price
                    let price= document.createElement("p")
                    price.classList.add("price")
                    price.innerHTML = `${res["pages"][i].price}&euro;`
                    //price sq/m
                    let priceSQM = document.createElement("p")
                    priceSQM.classList.add("priceSqm")
                    priceSQM.innerHTML = Math.round(res["pages"][i].price / res["pages"][i].area) +" &euro;/m<sup>2</sup>"
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
                let pagination = document.querySelector("#pagination");
                pagination.innerHTML=""
                if(!res["pages"].length){
                    let message = document.createElement("p")
                    message.innerHTML = "We couldnt find anything";
                    message.classList.add("message");
                    apartmentList.appendChild(message)
                }
                if(filter.page < 4){
                    for(let i =0; i<6 && i<res["num_pages"] ;i++){
                        let span = document.createElement("span");
                        span.innerHTML = i+1
                        span.setAttribute("data-page", i);
                        if(filter.page == span.getAttribute("data-page")){
                            span.classList.add("active");
                        }
                        span.addEventListener("click", function(){
                            filter.page = this.getAttribute("data-page");
    
                            getAllApartments()
                        })
                        pagination.appendChild(span)
                    }
                }
                else{
                    for(let i =filter.page-3, j = 1; j<7 &&  i<res["num_pages"] ; j++,i++){
                        let span = document.createElement("span");
                        span.innerHTML = i+1
                        span.setAttribute("data-page", i);
                        if(filter.page == span.getAttribute("data-page") ){
                            span.classList.add("active");
                        }
                        span.addEventListener("click", function(){
    
                            filter.page = this.getAttribute("data-page");
                           
                            getAllApartments()
                        })
                        pagination.appendChild(span)
    
                    }  
                }
            }catch(e){
                errorPopUp("Error occured please try again later")
            }
            

        }

     }
 
    }









sub.addEventListener("click", function(e){
    e.preventDefault()
    getAllApartments();


})



let filterSearch = document.querySelector("#search")
filterSearch.addEventListener("input", function(){
    filter.search = this.value;
    filter.page=0;
    getAllApartments();
})

