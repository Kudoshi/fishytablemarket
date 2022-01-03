<?php require "resources/conn.php"?>
<?php require "resources/seller_utility.php"?>
<?php require "resources/seller_security.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fishytable Market</title>
    
    <?php require "import_headInfo.php"?>
    <?php require "resources/import_sellerHeadInfo.php"?>
</head>
<body>
    <?php require "header_seller.php"; ?>
   
    <div class="container-fluid">
        <div class="row bg-color-black-2 border-bottom border-dark border-1 pb-1">
            <div class="col-md-3 text-center p-4 d-flex align-items-center justify-content-center">
                <img class="border border-2 border-dark shadow" src="<?php echo $_SESSION['SellerData']['SellerPhoto'];?>" style="width: 12vw; height: 12vw;" alt="Picture of seller">
            </div>
            <div class="col-md-8 d-md-flexbox flex-md-column p-0 ">
                <div class="h4 ps-2 pt-4 text-gray-3"><small><?php echo $_SESSION['SellerData']['SellerName']?></small></div>
                <div class="display-5 ps-2 pb-2 row">
                    <div class="col-md-9 text-gray-1"><?php echo $_SESSION['SellerData']['ShopName']?></div>
                    <div class="col-md-2 text-center text-gray-1"><a href="seller_view_profile.php" class="btn btn-primary">View Shop</a></div>
                </div>
                <div class="spanLineFull-blue p-0 mb-2"></div>
                <div class=""><p class="p-2 my-3 me-4 ms-2 text-gray-3"><?php echo $_SESSION['SellerData']['SellerDescription']?></p></div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="bg-color-white-3 row">
            <div class="d-flex justify-content-evenly flex-wrap text-white p-4 my-2" >
                <div class="d-flex flex-column bg-color-black-3 align-items-center flex-wrap m-2" style="width: 25rem; height: 25rem;">
                    <div class="h2 align-items-center m-4 p-3">ORDERS</div><br>
                    <div class="flex-fill flex-grow-1 mx-4 mt-4 px-1 pt-4 flex-grow-1 text-center">View the product orders your customers placed. Check the orders information, customers details and what items they bought from your shop.</div>
                    <a href="seller_orders.php" class="mb-3 p-2 text-gray-2 fs-1" ><i class="bi bi-arrow-right-square-fill"></i></a>
                </div>
                <div class="d-flex flex-column bg-color-black-3 align-items-center flex-wrap m-2" style="width: 25rem; height: 25rem;">
                    <div class="h2 align-items-center m-4 p-3">PRODUCTS</div><br>
                    <div class="flex-fill flex-grow-1 mx-4 mt-4 px-1 pt-4 flex-grow-1 text-center">View all the products you sell in your shop. Manage your products, add new product or edit your current listings.</div>
                    <a href="seller_products.php" class="mb-3 p-2 text-gray-2 fs-1" ><i class="bi bi-arrow-right-square-fill"></i></a>
                </div>
            </div>
        </div>
    </div>


    <?php require "footer_seller.php";?>
</body>
</html>