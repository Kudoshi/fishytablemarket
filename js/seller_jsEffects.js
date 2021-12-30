
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

function SetDecimalFloatValue(id, decimalPoint, value, defaultValue="")
{
    element = document.getElementById(id);

    if (isNaN(value))
    {
        element.value = defaultValue;
    }
    else{
        element.value = parseFloat(value).toFixed(decimalPoint);
    }
}
