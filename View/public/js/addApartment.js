 
window.addEventListener("load",function(){
    let xhr_object_type = new XMLHttpRequest();
    xhr_object_type.open("GET", "typeOfRealEstate");
    xhr_object_type.send();
    xhr_object_type.onreadystatechange = function(){
        if(xhr_object_type.readyState === 4){
            if(xhr_object_type.status ===200){
                try{

                
                let select = document.querySelector("#tipObjekta");
 
                let response = JSON.parse(xhr_object_type.response);
                response.forEach(element => {
                    let opt = document.createElement("option")
                    opt.value = element.id;
                    opt.innerText = element.name;
                    select.appendChild(opt);
                });
                
            }catch(err){
                errorPopUp(err);
            }
        }
        }
    }

})
