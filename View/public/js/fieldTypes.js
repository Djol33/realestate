function createButtons(number){
    let divfield = document.querySelector("#fields");
    divfield.innerHTML="";

    for(let i = 0;i<number;i++){

        let div = document.createElement("div")
        div.classList.add("holder-item")
        let inp= document.createElement("input");
        inp.type="text";
        inp.name = "answers[]";
        let label  = document.createElement("label");
        label.style.marginTop="20px"
        label.innerHTML="Add value";
        let x = document.createElement("i")
        x.classList.add("fa-solid","fa-xmark");

        div.appendChild(label)
        div.appendChild(inp)
        divfield.appendChild(div);
    
    }


}   
let xhrFields = new XMLHttpRequest();
xhrFields.open("GET","FieldType")
xhrFields.onreadystatechange = function () {
    if(xhrFields.status==200 && xhrFields.readyState ==4){
 
        let res = JSON.parse(xhrFields.responseText);
        if(!res["err"]){
        
        let dd = document.querySelector("#selectTypeResp");
        res.forEach(element => {
 
            let opt = document.createElement("option")
            opt.innerText = element.type;
            opt.value = element.id;
            dd.appendChild(opt)
        });
        dd.addEventListener("change", function(){
            if(this.value==1){
                let divfield = document.querySelector("#fields");
                divfield.innerHTML="";

            }
            else {
                createButtons(5);
            }
        })
        dd.dispatchEvent(new Event("change"));
    }else{
        errorPopUp("Error occured")
    }
    }
 
  }

  xhrFields.send();