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
            caller.classList.remove("d-none");
        }
    }
}