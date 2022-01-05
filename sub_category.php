<?php 
require "resources/conn.php";
$id = strval($_GET['id']);//strval -> convert the value to string (php understand only)
//Retrieving data that ONLY MATCH the product's ID
$product = mysqli_query($con, "SELECT * FROM product INNER JOIN subcategory ON product.SubCategoryID = subcategory.SubCategoryID WHERE product.SubCategoryID='$id'");
$subcategory = mysqli_query($con, "SELECT SubCategoryName FROM subcategory WHERE SubCategoryID ='$id'");
$data = mysqli_fetch_array($subcategory);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product Listing</title>
    <link rel="stylesheet" href="css/scpl.css">
    <?php require "import_headInfo.php"; ?>
</head>
<body>
    <?php require "header.php"; ?>
<section>
    <div class = "products">
            <div class = "sub-cat-product">
                <h1 class = "lg-title"><?php echo $data['SubCategoryName'];?></h1>
                <div class = "product-items">
                    <?php

                    while($row = mysqli_fetch_array($product)){
                    $html_script =
                        '<!-- single product -->
                        <div class = "product">
                            <div class = "product-content">
                                <div class = "product-img">
                                    <img src = "'.$row["ProductPicture"].'" alt = "product image" width="200px" height="200px">
                                </div>
                                <div class = "product-btns">
                                <a href="#.php">
                                <button type = "button" class = "btn-cart"> View
                                        <span><i class = "fas fa-plus"></i></span>
                                    </button>
                                </a>
                                </div>
                            </div>

                            <div class = "product-info">
                                <div class = "product-info-top">
                                </div>
                                <a href = "#" class = "product-name">'.$row["ProductName"].', New Product</a>
                                <p class = "product-price">'.$row["Price"].'</p>
                            </div>
                        </div>
                        <!-- end of single product -->';
                        echo $html_script;
                    }
                        ?>
</section>

    <?php require "footer.php";?>
</body>
</html>