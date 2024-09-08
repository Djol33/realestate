let obj  = {
    added:[],
    remove:[]
}

async function dohvatiSlike(id){
    try{

    
    await fetch(`LoadImages?id=${id}` )
    .then(res=>res.json())
    .then(res=>{

        res.forEach(e=>{
            obj.added.push(e)
        })
        if(obj.added.length){
            carousel(obj.added)
        }else{
            errorPopUp("No images found")
        }

    });
}catch(err){
    errorPopUp(err)
}
}
async function posaljiSlikeZaBrisanje(array){
    await fetch("RemoveImagesRE", {
        method: "POST", 
        mode: "cors", 
        cache: "no-cache",  
        credentials: "same-origin",
        redirect: "follow",
        referrerPolicy: "no-referrer", 
 
        body:JSON.stringify(array),

    })
    .then(res=>{
        if(res.status==200){
            
            errorPopUp("Success, Reloading soon")
            setTimeout(function(){ window.location.reload()}, 2000)
        }
        else{
            errorPopUp("Error occured")
        }
    })
        
    
}

function carousel(images){
    let array = images;
    let x = document.createElement("i");
    let overlay = document.createElement("div")
    overlay.classList.add("overlay")
    let left = document.createElement("span");
    let current_image = 0

    let trash = document.createElement("i")
    overlay.appendChild(trash)
    trash.classList.add("fa-solid", "fa-trash")
    trash.addEventListener("click", function(){
     if(!this.classList.contains("deleted")){
         this.classList.toggle("deleted");
         obj.remove.push(obj.added[current_image]);
     }
     else{
         this.classList.toggle("deleted");
         let index  = obj.remove.findIndex(x=>x.id == obj.added[current_image].id )
         obj.remove.splice(index,1);
     }
    })

    left.innerText="<";
    left.classList.add("left")
    left.addEventListener("click", function(){
        current_image--;
        if(current_image<0)
        {
            current_image = array.length 
            img.src = obj.added[current_image-1].location;
            current_image = current_image-1;
        }else{
            img.src = obj.added[current_image].location;
        }

 
        if(obj.remove.findIndex(obj1 => obj1.id === array[current_image].id) === -1){
            trash.classList.remove("deleted")
        }
        else{
            trash.classList.add("deleted")
        }

    })

    let right = document.createElement("span");
    right.addEventListener("click", function(){
        
        current_image++;
        if(current_image > obj.added.length-1 ){
            current_image = 0;
            img.src = array[current_image].location;
        }else{
        img.src = array[current_image].location;
        }
        if(obj.remove.findIndex(obj1 => obj1.id === array[current_image].id) === -1){
            trash.classList.remove("deleted")
        }
        else{
            trash.classList.add("deleted")
        }

   
    })
    right.classList.add("right")
    right.innerText = ">"

    x.classList.add("fa-solid", "fa-xmark", "x");

    let form = document.createElement("form")
    form.classList.add("imgholder");
    let img_holder = document.createElement("div");
    //img_holder.classList.add("imgholder", "img_holder")
    let img = document.createElement("img")
    img.src = array[current_image].location
    //img_holder.appendChild(left);
    form.appendChild(img);
    form.appendChild(left)
    form.appendChild(right);
    overlay.appendChild(x);
 
    overlay.appendChild(form)
    let body = document.querySelector("body");
    body.appendChild(overlay)
   x.addEventListener("click", function(){
    overlay.remove();
   })
   let psub = document.createElement("p")
   psub.innerHTML = "Submit"
   psub.id = "submit";
   overlay.appendChild(psub)
   psub.addEventListener("click",function(){
    if(obj.remove.length){
        posaljiSlikeZaBrisanje(obj.remove);
    }else{
        errorPopUp("Please remove images before submitting form")
    }

   })

} 

let pa1 = document.querySelector("#img_db");
pa1.addEventListener("click", function(){
    console.log(this)
    dohvatiSlike(this.getAttribute("data-id"));
})