<?php require "resources/conn.php"?>
<?php require "resources/seller_utility.php"?>
<?php require "resources/basic_utility.php"?>
<?php
    $sellerID = $_GET["SellerID"];
    $data_seller = sql_retrieveRecord($con, "seller", "SellerID", $sellerID);
    $result_product = sql_retrieveRecord($con, "product", "SellerID", $sellerID, true);

    //Total Item Sold
    $sqlProductCartList = 
    "SELECT * FROM productcartlist 
    INNER JOIN product ON product.ProductID = productcartlist.ProductID
    INNER JOIN cart ON cart.CartID = productcartlist.CartID
    WHERE cart.CartPaid = 1 AND product.SellerID =".$sellerID;
    $result_productCartList = mysqli_query($con, $sqlProductCartList) or die(mysqli_error($con));

    //Reviews
    $sqlReview=
    "SELECT * FROM rating 
    INNER JOIN product ON product.ProductID = rating.ProductID
    WHERE product.SellerID = ".$sellerID;
    $result_review = mysqli_query($con, $sqlReview) or die(mysqli_error($con));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fishytable Market</title>
    
    <?php require "import_headInfo.php"?>
    <?php require "resources/import_sellerHeadInfo.php"?>
</head>
<body>
    <?php require "header.php"; ?>

    
    <div class="container-fluid">
        <div class="row bg-color-black-2 border-bottom border-dark border-1 pb-1">
            <div class="col-md-3 text-center p-4 d-flex align-items-center justify-content-center">
                <img class="border border-2 border-dark shadow" src="<?php echo $data_seller['SellerPhoto'];?>" style="width: 200px; height: 200px;" alt="Picture of seller">
            </div>
            <div class="col-md-8 d-md-flexbox flex-md-column p-0 py-4 ">
                <div class="fs-5 text-gray-3 ps-2">Seller Profile</div>
                <div class="display-5 ps-2 mb-1">
                    <div class="text-gray-1"><?php echo $data_seller['ShopName']?></div>
                </div>
                <div class="spanLineFull-blue p-0 mb-3"></div>
                <div class="text-gray-1 ps-2 mb-2"><?php echo $result_review->num_rows ?> reviews</div>
                <div class="ps-1">
                    <?php echo generate_ratingStar($data_seller["SellerRating"]) ?>
                    <span class="ps-2 text-gray-1 fs-5"> <?php echo $data_seller["SellerRating"] ?> / 5</span>
                    
                </div>
                <div class="text-end text-gray-1 pe-2">Join Date: <?php echo $data_seller["JoinDate"] ?></div>
            </div>
            <div class="col-md-1" ></div>
        </div>
        <div class="bg-color-white-3 row">
            <div class="d-flex flex-column align-items-center justify-content-center d-md-flex flex-md-row align-items-md-start text-white p-4 my-2 bg-secondary">
                <div class="d-flex flex-column bg-color-black-3 align-items-center flex-shrink-0 m-2 text-gray-1 p-4" style="width: 22rem; min-height: 20rem;">
                    <div class="bi bi-handbag-fill display-3 text-info"></div>
                    <br>
                    <div class="display-6 fs-2">Total Item Sold</div>
                    <br>
                    <div class="text-center h1"><?php echo $result_productCartList->num_rows ?></div>
                </div>
                <div class="d-flex flex-column bg-color-black-3 flex-grow-1 align-items-center flex-wrap m-2 text-center p-4" style="min-height: 20rem; min-width: 20rem;">
                    <div class="bi bi-shop-window display-3 text-info"></div> 
                    <br>
                    <div class="display-6 fs-2">About Shop</div>
                    <br>
                    <div class="bg-color-black-3 text-break p-2">
                        <?php echo $data_seller["SellerDescription"] ?>
                    </div>
                </div>
                <div class="d-flex flex-column bg-color-black-3 align-items-center flex-shrink-0 m-2 text-gray-1 p-4" style="width: 22rem; min-height: 20rem;">
                    <div class="bi bi-geo-alt-fill display-3 text-info"></div>
                    <br>
                    <div class="display-6 fs-2">Ships From</div>
                    <br>
                    <div class="text-center">
                        <?php echo $data_seller["SellerAddress"] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-4 py-3 mx-4 mb-4 ">
            <div class="shadow-sm bg-color-white-3 border rounded-3 p-4" style="min-height: 200px;" id="id_orderContainer">
                <div class="text-center p-2">
                    <div class="h1">Products</div>
                    <div class="h6"><?php echo $result_product->num_rows." products" ?></div>
                </div>
                <div class="spanLineFull-sm"></div>
                
                <div class="d-flex flex-wrap ms-auto p-4" id="id_itemContainer">
                    <?php 
                        while ($data_product=mysqli_fetch_array($result_product))
                        {
                            $element = '
                            <div class="card shadow-sm me-4 mb-4 " style="width:250px; height: 370px;">
                                
                                <a href="productInfoPage.php?id='.$data_product["ProductID"].'" class="text-decoration-none on-hover-darken">
                                    <div  class="card-img-top pt-2 text-center "><img src="'.$data_product["ProductPicture"].'" alt="Product image" class="" style="width:230px; height: 230px"></div>
                                    <div class="card-body p-0">
                                        <div class="card-title h6 d-flex align-items-center px-3 pt-2 text-dark" style="height: 60px"><div>'.$data_product["ProductName"].'</div></div>
                                        <div class="spanLine-gray mx-auto"></div>
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-text text-primary px-3 py-3">RM'.$data_product["Price"].'</h4>
                                            <span class="fs-4 px-3 py-3 '.print_categoryIcon($con, $data_product["SubCategoryID"]).'"></span>
                                        </div>
                                    </div>
                                </a>
                            </div>';
                            echo $element;
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>


    <?php require "footer.php";?>
</body>
</html>