
    window.addEventListener("load", function(){
        let xhr = new XMLHttpRequest();
        xhr.open("GET",'header', true);
        xhr.setRequestHeader("Content-type", "application/json");
        xhr.send()
 
            let header = document.createElement("header");
            let footer = document.createElement("footer");

            let ul = document.createElement("ul")
            let ul2footer = document.createElement("ul");
            
            xhr.onreadystatechange = function(){
                if(xhr.readyState ===   XMLHttpRequest.DONE){
                    if(xhr.status ===200){
                        let result = xhr.responseText;
                        if(result !== "error"){
                        result = (JSON.parse(result))

                        for (let key in result) {
                            if (result.hasOwnProperty(key)) {
            
                                if(! ( /^child[\d]+$/.test(key))){
            
                
                                    for(let a in result[key]){
                                        
                                    let x = document.createElement("a");
                                        let li = document.createElement("li");
                                        x.innerHTML = result[key][a].title
                                        x.href = result[key][a].href;
                                        li.id ='parent' +key
                                            
                                    li.appendChild(x)
                                    
                                    ul.appendChild(li);
                                    }
            
            
                                }
                            }
            
                        }

                        for(let key in result){
                            if (result.hasOwnProperty(key)) {
            
                                if(! ( /^child[\d]+$/.test(key))){


                                    for(let a in result[key]){
                                        if(result[key][a].title == "Account") continue;
                                    let x = document.createElement("a");
                                        let li = document.createElement("li");
                                        x.innerHTML = result[key][a].title
                                        x.href = result[key][a].href;
                                        li.id ='parent' +key
                                            
                                    li.appendChild(x)
                                    
                                    ul2footer.appendChild(li);
                                    }
            
            
                                }
                            }
                        }
                        
                        let body = document.querySelector("body");
                        body.insertAdjacentElement("afterbegin", header)
                        body.insertAdjacentElement("beforeend", footer)
                        let i = document.createElement("i")
                        i.classList.add("fa-solid","fa-bars", "toggle")
 
                        header.appendChild(ul)
                        header.appendChild(i)
                        i.addEventListener("click", function(){
                            ul.classList.toggle("d-flex")
                        })
                        footer.appendChild(ul2footer)
 
 
            
                        for(let key in result){
                            if(/^child[\d]+$/.test(key)){
                                let id = /[\d]+$/
                                id = id.exec(key)
                                
                                id.forEach((element )=>{
                                    let parent = document.querySelector(`#parent${element}`)
                                    
                                    if(!parent.querySelector("ul")){
                                        var ul_child = document.createElement("ul")
                                        parent.appendChild(ul_child)
                                    }
            
                                    for(let b in result[key]){
                                        let li = document.createElement("li");
                                        let a = document.createElement("a")
                                        a.href = result[key][b]["href"]
                                        a.innerText = result[key][b]["title"];
                                        li.appendChild(a)
                                        ul_child.appendChild(li)
                                    }
                                    
                                    parent.addEventListener("mouseover", function(){
                                        let child_ul = this.querySelector("ul")
                                        child_ul.style.display = "flex"
                                    })
                                    parent.addEventListener("mouseout", function(){
                                        let child_ul = this.querySelector("ul")
                                        child_ul.style.display = "none"
                                    })
                                })
                        
                            }
                        }
                        let xhrLogged = new XMLHttpRequest();
                        xhrLogged.open("GET", "loggedIcon");
                        xhrLogged.setRequestHeader("Content-type", "application/json");
                        xhrLogged.onreadystatechange = function(){
                            if(xhrLogged.status == 500 && xhrLogged.readyState ==4){
 
                                let res =  JSON.parse(xhrLogged.responseText)
                                if(!res["err"]){
                                    let header = document.querySelector("header");
                                    let a = document.createElement("a")
                                    a.href= `/userProfile`
                                    a.id="user";
                                    a.innerHTML = res["f_name"] + " " + res["l_name"];
                                    header.appendChild(a);
                                }
 

 
                              
                            }else{
                               
                            }
         
                        }
                        xhrLogged.send(); 
                        
                        }
         
            
            
            
            
            
                    
                    
             
                    }
                }
            
            }
            
            
            
            
            
             
         
        
         
       
    })
