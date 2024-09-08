window.addEventListener("DOMContentLoaded", function(){
    var formaz;
 
 


    let forma = document.getElementById("method")
    formaz = new FormData(forma)

let sub =document.querySelector("#predaj")
    sub.addEventListener("click", function(e){

        for(let x of mapa){

            
            if(!x){

                for(let y of mapa){
                     query = document.querySelector(`#${y[0]}`)
                     let inp = new Event("input");
                     let inp2 = new Event("change");
                     query.dispatchEvent(inp2)
                     query.dispatchEvent(inp)
                     console.log(y)
                }
                return 0;

            }else{
                if(!x[1](document.querySelector(`#${x[0]}`))){
                    for(let y of mapa){
                        query = document.querySelector(`#${y[0]}`)
                        let inp = new Event("input");
                        query.dispatchEvent(inp)
                        console.log(y)
                   }
                   errorPopUp("All fields are mandatory")
                   e.preventDefault();
                    return 0;
                }
            }
            
        }
        let ter = document.getElementsByName("terasa")
        if(!radioconf(ter)){
            errorPopUp("Select value for balcony")
            e.preventDefault();
            return 0;
            
        }
        
        
 
    })
    let title = document.querySelector("#title1");
    let selectCity = document.querySelector("#city");
    let adress = document.querySelector("#adresa");
    let selectTipObjekta = document.querySelector("#tipObjekta");
    let numberRooms = document.querySelector("#numberrooms");
    let terasa = document.getElementsByName("radio")
    let brojKvadrata = document.querySelector("#kvadratura");
    let price = document.querySelector("#cena");
    let description = document.querySelector("#dodatniopis");
    let files = document.querySelector("#images");
 

forma.addEventListener("input", function(){

 formaz = new FormData(this)
 
formaz.append("city", selectCity.value)
formaz.append("objectType", selectTipObjekta.value)
})






/*
    files.addEventListener("input", function(){
        try{


        
        let file = files.files;
 
 

        for (let i = 0; i < file.length; i++) {
            formaz.append("images[]", file[i]);
        }



      
    }catch(
        err
    ){
        console.log(err)
    }


    })*/
    let mapa = new Map();
    mapa.set(title.id ,titleconf  );
    mapa.set(selectCity.id, selectValidacija );
    mapa.set(selectTipObjekta.id,selectValidacija  );
    mapa.set(adress.id , adresa );
    mapa.set(numberRooms.id, sobe  );
    mapa.set(brojKvadrata.id, kvadratura  );
    mapa.set(price.id, priceCheck  );
    mapa.set(description.id, opis  );
    //mapa.set(terasa.id, radioconf)

    mapa.forEach((e,x)=>{
        let obj =document.querySelector(`#${x}`);
        obj.addEventListener("input", function(){
           if(!e(this)){
                addError(this)
           }
           else{
            removeError(this)
           }
        })
    })


    })

 


 