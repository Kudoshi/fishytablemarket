<?php


function generate_ratingStar($rating, $additionalClass = "fs-5 text-primary ") 
{
    $e_rating = "";
    $temp_rating = 0;
    for ($i=0; $i < 5; $i++) { 
        if ($temp_rating < $rating)
        {
            $e_rating .= '<span class="'.$additionalClass.' pe-1 fa fa-star"></span>';
        }
        else
        {
            $e_rating .= '<span class="'.$additionalClass.' pe-1 far fa-star"></span>';
        }
        
        js_ConsoleLog($temp_rating);
        $temp_rating ++;
    }
    return $e_rating;
}

// Returns the category fa icon element
function print_categoryIcon($con, $subCategoryID)
{    
    $sql = "SELECT CategoryID FROM subcategory 
    WHERE SubCategoryID = '".$subCategoryID."'";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    $data =  mysqli_fetch_array($result);
    if ($data["CategoryID"] == "ORGACA")
    {
        return "fas fa-leaf text-success";
    }
    else
    {
        return "fas fa-fish text-primary";
    }
}

?>