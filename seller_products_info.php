<?php require "resources/conn.php"?>
<?php require "resources/seller_utility.php"?>
<?php require "resources/seller_security.php"?>
<?php require "resources/basic_utility.php"?>
<?php
    $productID = $_GET["ProductID"];
    $data_product = sql_retrieveRecord($con, "product", "ProductID", $productID);
    
        //Prevent seller from accessing product they do not own
    if ($data_product["SellerID"] != $_SESSION["SellerData"]["SellerID"])
    {
        header("Location: seller_products.php");
    }

    $data_subCategory = subcategory_getData($con, $data_product["SubCategoryID"]);


    $sql_review = 
    "SELECT rating.RatingID, rating.Rating, rating.FeedbackHeader, rating.Feedback, rating.DateWritten, customer.CustID, customer.CustName, rating.ProductID
    FROM rating INNER JOIN customer ON customer.CustID = rating.CustID
    WHERE rating.ProductID = '".$productID."'
    ORDER BY rating.DateWritten DESC
    ";
    $result_review = mysqli_query($con, $sql_review) or die(mysqli_error($con));

    $sql_productcart =
    "SELECT * 
    FROM productcartlist 
    INNER JOIN cart ON cart.CartID = productcartlist.CartID
    WHERE cart.CartPaid = 1 AND productcartlist.ProductID = ".$productID;
    $result_productcart = mysqli_query($con, $sql_productcart) or die(mysqli_error($con));

?>
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
        <div class="text-end display-6 bg-color-black-2 text-white row py-4">
            <div class="me-4 pe-4 col-md-11">
                <span class="fs-4 ">Product Information</span>
                <span class="text-primary px-2">|</span>
                <span class="text-gray-2 display-6">Product List</span>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="pb-1 bg-primary row"></div>
        <div class="bg-success text-white row">
            <div class="text-center">
                <?php 
                if (isset($_SESSION["Message"])) 
                { 
                    echo "<br>".$_SESSION["Message"]."<br><br>";
                    unset($_SESSION["Message"]);
                }
                ?>
            </div>
        </div>
        <div class="row bg-color-black-2 px-4">
            <div class="row mx-auto px-4 pb-1">
                <div class="col-lg-4 text-center p-4 d-flex align-items-center justify-content-center">
                    <img class="border border-2 border-dark shadow" src="<?php echo $data_product['ProductPicture'];?>" style="width: 250px; height: 250px;" alt="Picture of seller">
                </div>
                <div class="col-lg-7 d-md-flexbox flex-md-column p-0 py-4 ">
                    <div class="d-flex">
                        <div class="fs-5 text-gray-3 ps-2"><?php
                            echo $data_subCategory["CategoryName"]." > ". $data_subCategory["SubCategoryName"];?>
                        </div>
                        
                    </div>
                    <div class="display-5 ps-2 mb-1">
                            <div class="text-gray-1"><?php echo $data_product['ProductName']?></div>
                    </div>
                    
                    <div class="spanLineFull-blue p-0 mb-3"></div>
                    <div class="ps-2">
                        <span class="h1 text-gray-1 ">RM <?php echo $data_product["Price"] ?></span>
                    </div>
                    <div class="px-2 pt-3">
                        <div class="col-1"></div>
                        <div class="col-10 d-flex flex-column align-items-start text-white">
                            <div><span class="h6">Weight:</span> <?php echo $data_product["Weight"] ?> g</div>
                            <div><span class="h6">Shipping Method:</span> <?php echo $data_product["ShippingMethod"] ?></div>
                            <div><span class="h6">Date Added:</span> <?php echo $data_product["DateAdded"] ?></div>
                        </div>
                        <div class="col-1"></div>
                    </div>
                
                </div>
                <div class="col-lg-1" ></div>
                <div class="col-lg-1"></div>
                <div class="col-lg-10 mx-auto mx-4 p-4" style="min-height: 200px;">
                    <div class="bg-color-white-4 border border-1 rounded rounded-3 border-dark p-4">
                        <div class="h4 text-center mb-1">Product Specification</div>
                        <hr>
                        <div class="px-2">
                            <?php echo $data_product["ProductSpecification"]; ?>
                        </div>
                    </div>    
                    
                </div>
                <div class="col-lg-1"></div>

            </div>
        </div>
        
        <div class="p-4 d-flex flex-column d-md-flex flex-md-row justify-content-evenly">
            
            <div class="pb-4" style="min-height:250px; min-width: 400px;">
                <div class="mx-3 bg-color-white-2 border border-1 rounded rounded-3 shadow-sm p-4 h-100">
                    <div class="text-center display-6 p-2">Total Order</div>
                    <hr class="">
                    <div class="text-center pt-4 my-4 display-5">
                        <?php echo $result_productcart->num_rows ?>
                    </div>
                </div>
            </div>
            <div class="pb-4" style="min-height:250px;min-width: 400px;">
                <div class="mx-3 bg-color-white-2 border border-1 rounded rounded-3 shadow-sm p-4 h-100">
                    <div class="text-center display-6 p-2">Manage Product</div>
                    <hr class="">
                    <div class="text-center pt-1 h6">Edit Product | Delete Product</div>
                    <div class="text-center pt-3 my-4">
                        <a class="btn btn-primary" href="seller_products_edit.php?ProductID=<?php echo $productID ?>">Edit Product</a>
                    </div>
                </div>
            </div>
            <div class="pb-4" style="min-height:250px; min-width: 400px;">
                <div class="mx-3 bg-color-white-2 border border-1 rounded rounded-3 shadow-sm p-4 h-100">
                    <div class="text-center display-6 p-2">Ratings</div>
                    <hr class="">
                    <div class="text-center pt-1">
                            <div class="mb-4 text-center h6"><?php echo $result_review->num_rows ?> reviews</div>
                            <div class="ps-1 text-center mb-3">
                                <?php echo generate_ratingStar($data_product["ProductRating"]) ?>
                            </div>
                            <div class="ps-2 fs-5 text-nowrap "> <?php echo $data_product["ProductRating"] ?> / 5</div>

                            
                    </div>
                </div>
            </div>
        </div>
        <div class="px-4 mb-4 mx-auto">
            <div class="mx-4 bg-color-white-2 border border-1 rounded rounded-3 shadow-sm p-1">
                <div class="text-center display-6 p-2">Reviews</div>
                <div class="text-center h6 p-1"><?php echo $result_review->num_rows ?> review</div>
                <hr class="">
                <div class="px-4 ">
                <?php
                    while ($row = mysqli_fetch_array($result_review))
                    {
                        $element = 
                        '
                                <div class="p-4 m-2 bg-color-white-4 shadow-sm d-flex flex-column d-md-flex flex-md-row">
                                    <div class="px-4 py-2 text-center" style="min-width: 250px">
                                        <div class="text-break">'.$row["CustName"].'</div>
                                        <br>
                                        <div class="">'.generate_ratingStar($row["Rating"]).'</div>
                                        <div>5 / 5</div>
                                    </div>
                                    <div class="bg-color-black-4 pe-1"></div>
                                    <div class="mx-4 flex-grow-1">
                                        <div class="px-2 py-1 h6">'.$row["FeedbackHeader"].'</div>
                                        <hr class="m-0">
                                        <div class="p-2">
                                        '.$row["Feedback"].'
                                        </div>
                                    </div>    
                                </div>
                            
                        ';
                        echo $element;
                    }
                ?>
                </div>
            </div>
        </div>

    </div>
    <?php require "footer_seller.php";?>       

</body>
</html>