<?php 
    require "conn.php";
    $category = $_GET["CategoryID"];

    if ($category == "ORGACA" || $category == "FISHCA")
    {
        $sql = 
        "SELECT product.ProductID, product.ProductName, product.Price, product.ProductPicture
        FROM product INNER JOIN subcategory
        ON product.SubCategoryID = subcategory.SubCategoryID
        WHERE subcategory.CategoryID = '$category' AND product.SellerID = '".$_SESSION["SellerData"]['SellerID']."'
        ";
    }
    else
    {
        $sql = 
        "SELECT ProductID, ProductName, Price, ProductPicture
        FROM product WHERE SellerID = '".$_SESSION["SellerData"]['SellerID']."'
        ";
    }
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    
    
    //Default empty element (if empty)

    

    if ($result ->num_rows === 0)
    {
        if ($category != "ALL")
        {
            $element = 
            '<div class="mx-auto my-4 py-2 fs-5 text-center">
                No product under this category<br><br><b>Add a new product here</b>
                <a href="seller_products_add.php">
                    <div class="fs-1 bi bi-plus-square-fill"></div>
                </a>
            </div>
            ';
            
        }
        else{
            $element = 
            '<div class="mx-auto my-4 py-2 fs-5 text-center">
                No product listed yet <br><br><b>Add your first product</b>
                <a href="seller_products_add.php">
                    <div class="fs-1 bi bi-plus-square-fill"></div>
                </a>
            </div>
            ';
        }
        echo $element;
    }
    else{
        while ($row=mysqli_fetch_array($result))
        {
            $element = '
            <div class="card shadow-sm me-4 mb-4 " style="width:250px; height: 370px; min-width:250px"">
                <a href="seller_products_edit.php?ProductID='.$row["ProductID"].'" class="text-decoration-none on-hover-darken">
                    <div  class="card-img-top pt-2 text-center "><img src="'.$row["ProductPicture"].'" alt="Product image" class="" style="width:230px; height: 230px"></div>
                    <div class="card-body p-0">
                        <div class="card-title h6 d-flex align-items-center px-3 pt-2 text-dark" style="height: 60px"><div>'.$row["ProductName"].'</div></div>
                        <div class="spanLine-gray mx-auto"></div>
                        <div class="d-flex justify-content-between">
                            <h4 class="card-text text-primary px-3 py-3">RM'.$row["Price"].'</h4>
                            <span class="fs-4 px-3 py-3 '.print_categoryIcon($con, $data_product["SubCategoryID"]).'"></span>
                        </div>
                    </div>
                </a>
            </div>';
            echo $element;
        }
    }
    

?>