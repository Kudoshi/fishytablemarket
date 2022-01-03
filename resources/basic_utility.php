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


?>