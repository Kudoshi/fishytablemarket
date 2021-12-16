<?php
declare(strict_types=1);

function generateUniqueHash(){
    date_default_timezone_set("Asia/Kuala_Lumpur");
    return date("ymdHis");
}

function validateImg($image)
{
    $uploadOk = True;
   
    //Check file size
    if ($image["size"] > 2097152) //Reject if more than 2 mb
    {
        $uploadOk= "Image size is too big";
    }

    //Check extension type
    $imageFileType = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") //Files other than these types are rejected
    {
        $uploadOk = "Unsupported image format";
    }

    return $uploadOk === True ? True: $uploadOk;
}

function uploadImg($fileHeader, $image){
    //Generate name
    $imageFileType = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
    $f_Location = "image/submittedImage/".$fileHeader."_".generateUniqueHash().".".$imageFileType;
    if (move_uploaded_file($image["tmp_name"],$f_Location)){
        return $f_Location;
    }
    else{
        return False;
    }
}


function sanitizeInput($input, $filterTag)
{
    $hasError = False;
    if ($filterTag == "email")
    {
        $filterElement = FILTER_SANITIZE_EMAIL;
    }
    else if ($filterTag == "string")
    {
        $filterElement = FILTER_SANITIZE_STRING;
    }
    else if ($filterTag == "integer")
    {
        $filterElement = FILTER_SANITIZE_NUMBER_INT;
    }
    else{
        throw new Exception("Filter tag not found in validation function!");
        return;
    }
    return trim(filter_var($input, $filterElement));
}

function validateInputLength($input, $minLength, $maxLength)
{
    if (strlen($input)>=$minLength && strlen($input) <= $maxLength)
    {
        return True;
    }
    else
    {
        return False;
    }
}

    function session_unsetAll(&$session)
    {
        $sellerID = "";
        
        if (isset($session["sellerID"]))
        {
            $sellerID = $session["sellerID"];
        }

        unset($session);
    
        //If re-set back seller id
        if ($sellerID !== "")
        {
            $session["SellerID"] = $sellerID;
        }
    }

    function input_echoSetValue($value)
    {
        if (isset($value))
        {
            echo "value='".$value."'";
        }
    }
?>