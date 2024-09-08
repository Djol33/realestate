window.addEventListener("load", function(){
    let images = document.querySelectorAll("#images div");
    let image_array = [];
    images.forEach(e=>{
        let link = getComputedStyle(e).backgroundImage;
 
        let imageUrl = link.replace('url("', '').replace('")', '');
        image_array.push(imageUrl);
    })
 
    let images_len = image_array.length;
    let current_image;
    images.forEach((el)=>{
        el.addEventListener("click", function(){
            current_image = Number(this.getAttribute("image-id"));
            let body = document.querySelector("body")
            body.style.overflow="hidden";
            let overlay = document.createElement("div")
            overlay.classList.add("overlay");
            let img = document.createElement("img");
            let imgholder = document.createElement("div");
            imgholder.classList.add("imgholder")
    
            img.src=image_array[current_image]
             //img.alt = this.src;
            imgholder.appendChild(img)

            let x = document.createElement("i");
            let left = document.createElement("span");
            left.innerHTML = ""
            left.classList.add("leftt", "fa-solid", "fa-arrow-left");
            left.addEventListener("click", function(){
                current_image--;
                if(current_image<0)
                {
                    img.src = image_array[images_len-1];
                    current_image = images_len-1;
                }else{
                    img.src = image_array[current_image];
                }

                

            })

            let right = document.createElement("span");
            right.addEventListener("click", function(){
                current_image++;
                if(current_image > images_len-1 ){
                    current_image = 0;
                    img.src = image_array[current_image];
                }else{
                img.src = image_array[current_image];
                }

           
            })
            right.classList.add("rightt", "fa-solid", "fa-arrow-right")
            right.innerHTML = ""
 
            x.classList.add("fa-solid", "fa-xmark");
            imgholder.appendChild(left);
            imgholder.appendChild(right)
            imgholder.appendChild(x);
            overlay.appendChild(imgholder);
  
            
            x.addEventListener("click", function(){
                body.style.overflow="";
                ovly = document.querySelector(".overlay");
                ovly.remove()
            })
            let realestatepost = document.querySelector("#realestatepost")
            realestatepost.insertAdjacentElement("beforeend", overlay);

        })
    })

});