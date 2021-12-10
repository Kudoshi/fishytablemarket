'use strict';

function e_turnOnOffDisplay(arrId){

    
    for (const id of arrId)
    {
        let caller = document.getElementById(id);
        if (caller.classList.contains("displayOn"))
        {
            caller.classList.remove("displayOn");
            caller.classList.add("d-none");
        }
        else{
            caller.classList.add("displayOn");
            caller.classList.remove("d-none")
        }
    }
    


}




function fadeLeft(caller, mSec, posX){
    
    let pos = caller.style.position;
    let x = 0;
    let animation = setInterval(startAnimation, 1000)

    function startAnimation()
    {
    
        alert(pos);
        x += 1;
    }

}