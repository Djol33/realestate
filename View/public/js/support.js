let form = document.querySelector("#firstForm");
form.addEventListener("submit", function(e){

    let fname, lname, email, error=0;
    
    try{
         fname = document.querySelector("#fName");
         error += confName(fname)?0:1;
         lname = document.querySelector("#lName");
         error += confName(lname)?0:1;
         email = document.querySelector("#email");
        email+= confemail(email)?0:1;
    
    }catch(error){
 
    }finally{
        console.log(error);
        
        let title = document.querySelector("#titleSupport");
        error+= opis(title, 5)?0:1;
        let content = document.querySelector("#contentSupport");
        error+= opis(title, 13)?0:1
        if(!error){
 
        }else{
            e.preventDefault();
            const fields = form.querySelectorAll('input');
            fields.forEach(field => {
                field.dispatchEvent(new Event('blur'));
            });
        }
    }


})

window.addEventListener("load", function(){
    try{
        let fname = document.querySelector("#fName");
        
        let lname = document.querySelector("#lName");
        let email = document.querySelector("#email");
        let array = [fname, lname]
        array.forEach(e=>{
        
            e.addEventListener("blur", function(){
                if(confName(this)){
                    removeError(this);
                }
                else{
                    addError(this)
                }
            })
        })
        email.addEventListener("blur", function(){
            if(confemail(this)){
                removeError(this);
            }
            else{
                addError(this)
            }
        })
    
    }catch(error){
 
    }

    let title = document.querySelector("#titleSupport");
    let content = document.querySelector("#contentSupport");
    let niz2 = [title, content]
    niz2.forEach( (e,x)=>{
        e.addEventListener("blur", function(){
            if(opis(e, (x==0)?5:13)){
                removeError(this);
            }
            else{
                addError(this)
            }
        })
    })
})