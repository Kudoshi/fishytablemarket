<?php
    require "conn.php";

    $categoryID = $_GET["CategoryID"];
    if (!isset($_GET["SubCategoryID"])) // Subcategory not found
    {
        $sql = "SELECT * FROM subcategory WHERE CategoryID = '$categoryID'";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        $statement = '<select name="input_subCategory" id="id_subCategory" class="form-select" required>';
        while ($row=mysqli_fetch_array($result))
        {
            
            $statement .= "<option value='".$row["SubCategoryID"]."'>".$row["SubCategoryName"]."</option>";
        }
        $statement .= "</select>";
    }
    else //Subcategory found
    {
        $subCategoryID = $_GET["SubCategoryID"];

        $sql = "SELECT * FROM subcategory WHERE CategoryID = '$categoryID'";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    
        $statement = '<select name="input_subCategory" id="id_subCategory" class="form-select" required>';
        while ($row=mysqli_fetch_array($result))
        {
            if ($row["SubCategoryID"] == $subCategoryID)
            {
                $statement .= "<option selected value='".$row["SubCategoryID"]."'>".$row["SubCategoryName"]."</option>";
            }
            else{
                $statement .= "<option value='".$row["SubCategoryID"]."'>".$row["SubCategoryName"]."</option>";
            }
        }
        $statement .= "</select>";
    
        
    }
    echo $statement;
?>