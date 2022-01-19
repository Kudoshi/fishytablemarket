<?php
declare(strict_types=1);
function generateUniqueHash(){
    date_default_timezone_set("Asia/Kuala_Lumpur");
    return date("ymdHisv").session_id();
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

function uploadImg($image){
    //Generate name
    $imageFileType = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
    $f_name = "image/_".generateUniqueHash().".".$imageFileType;
    $f_Location = "image/"."_".generateUniqueHash().".".$imageFileType;
    if (move_uploaded_file($image["tmp_name"],$f_Location)){
        return $f_name;
    }
    else{
        return False;
    }
}

function sanitizeInput($input, $filterTag)
{
    if ($filterTag == "email")
    {
        $filterElement = FILTER_SANITIZE_EMAIL;
    }
    else if ($filterTag == "string")
    {
        $filterElement = FILTER_SANITIZE_STRING;
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

function js_ConsoleLog($string)
{
    echo "<script>console.log('$string')</script>";
}

function js_RunScript($script)
{
    echo "<script>$script</script>";
}

//Returns data. If returnResult is true, return result instead
function sql_retrieveRecord($con, $table, $idColName, $idData, $returnResult = false)
{
    $sql = "SELECT * FROM $table WHERE $idColName = '$idData'";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

    return $returnResult == false ? mysqli_fetch_array($result) : $result;
}

function db_checkIfValueExist($con, $table, $colName, $value)
{
    $sql = "SELECT * FROM $table WHERE $colName = '$value'";
    
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    

    return $result->num_rows > 0 ? True : False;
}

// Returns data of category+subcategory
function subcategory_getData($con, $subCategoryID)
{
    $sql = "SELECT * FROM subcategory 
    INNER JOIN category ON category.CategoryID = subcategory.CategoryID
    WHERE SubCategoryID = '".$subCategoryID."'";
    
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    return mysqli_fetch_array($result);
}

?>