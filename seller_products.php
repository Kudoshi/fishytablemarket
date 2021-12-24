<?php require "resources/conn.php"?>
<?php require "resources/seller_utility.php"?>
<?php
   if (!isset($_SESSION["SellerID"]))
   {
       header("Location: seller_login.php");
       return;
   }
   $data = sql_idRetrieveAll($con, "seller", "SellerID", $_SESSION["SellerID"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fishytable Market|Seller Login</title>
    
    <?php require "import_headInfo.php"?>
    <?php require "resources/import_sellerHeadInfo.php"?>
</head>
<body>
    <?php require "header_seller.php"; ?>
   
    <div class="container-fluid p-0">
        <div class="text-end display-6 bg-color-black-2 text-white row py-4">
            <div class="me-4 pe-4 col-md-11">
                <span class="fs-4 ">View All Products</span>
                <span class="text-primary px-2">|</span>
                <span class="text-gray-2 display-6">Product List</span>
            </div>
            <div class="col-md-1"> </div>
        </div>
        <div class="bg-color-black-3 row p-4">
            <div class="bg-color-white-3 col-md-7 mx-auto">
                <div>BOX BOX BOX BOX</div>
                br
                <br><br><br><br><br><br>

                <a href="seller_products_add.php">Add New Product</a>
            </div>
            <div class="bg-color-white-4 col-md-5">ho</div>
        </div>
    </div>



    <?php require "footer_seller.php";?>
</body>
</html>