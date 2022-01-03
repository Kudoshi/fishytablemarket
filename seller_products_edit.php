<?php require "resources/conn.php"?>
<?php require "resources/seller_utility.php"?>
<?php require "resources/seller_security.php"?>
<?php

    // print_r($_POST);
   if (isset($_POST["updateBtn"])) //Processing the input
   {
        // die("hello");
       $errorMsg = "";
       $productName = sanitizeInput($_POST["input_productName"], "string");
       $shippingMethod = sanitizeInput($_POST["input_shippingMethod"], "string");
       $price = $_POST["input_price"];
       $productSpecification = sanitizeInput($_POST["input_productSpecification"], "string");
       $weight = $_POST["input_weight"];
       $sellerID = $_SESSION["SellerData"]["SellerID"];
       $productID = $_POST["input_productID"];
       $subCategoryID = sanitizeInput($_POST["input_subCategory"], "string");

       
       
        if (!validateInputLength($productName,5,60))
        {
            $errorMsg .= "<br>* Product name is too long/short";
        }
        if (!($shippingMethod === "Seller self-delivery" || $shippingMethod === "Third-party delivery"))
        {
            $errorMsg .= "<br>* Invalid shipping method";
        }
        if (!is_numeric($price) || !is_float($price+0))
        {
            $errorMsg .= "<br>* Price inserted isn't a decimal number";
        }
        if (strlen((string)(int)$price)>8 || strlen((string)(int)$price)<1)
        {
            $errorMsg .= "<br>* Price inserted is too large/short";
        }
        if (!validateInputLength($productSpecification, 1,1200))
        {
            $errorMsg .= "<br>* Product specification is too long";
        }
        if (!is_numeric($weight) || $weight <= 0)
        {
            $errorMsg .= "<br>* Weight inserted isn't a valid integer number";
        }
        if (strlen((string)(int)$weight)>8 || strlen((string)(int)$weight)<1)
        {
            $errorMsg .= "<br>* Weight inserted is too much/less";
        }
        if (!db_checkIfValueExist($con, "subcategory", "SubCategoryID", $subCategoryID))
        {
            $errorMsg .= "<br>* Invalid subcategory inserted";
        }
        
        if ($errorMsg === "" && $_FILES["input_picFile"]["tmp_name"] !== "")
        {
            $PicName = uploadImg($_FILES["input_picFile"]);
            
            if ($PicName === False)
            {
                $errorMsg .= "<br>* Unable to upload image";
            }
        }

        if ($errorMsg === "")
        {
            // CHANGE

            $sql = 
            "UPDATE product
            SET ProductName = '$productName', ShippingMethod = '$shippingMethod', Price = '$price', ProductSpecification = '$productSpecification',
            Weight = '$weight', SubCategoryID = '$subCategoryID'";

            if (isset($PicName))
            {
                $sql .= ", ProductPicture = '$PicName'";
            }

            $sql .= "WHERE ProductID = '$productID' AND SellerID = '".$_SESSION["SellerData"]['SellerID']."'";
            
            if (!mysqli_query($con, $sql))
            {
                $errorMsg .= "<br>Error adding new product <br>.".mysqli_error($con)." <br>".$sql;
            }
        }

        // Control Redirect
        if ($errorMsg === "") //SUCCESS
        {
            $_SESSION["Message"] = "Product Updated";
            header("Location: seller_products_info.php?ProductID=".$productID);
            return;
        }
        else //ERROR
        {
            $_SESSION["Message"] = $errorMsg;

            header("Location: seller_products_edit.php?ProductID=".$productID);
            return;
        }
   }
   else if (isset($_POST["DeleteBtn"]))
   {
        $productID = $_POST["input_productID"];
        $sqlGetData = "SELECT SellerID FROM product WHERE product.ProductID = $productID";
        $resultGetData = mysqli_query($con, $sqlGetData) or die(mysqli_error($con));
        $data = mysqli_fetch_array($resultGetData);

        if ($data["SellerID"] != $_SESSION["SellerData"]["SellerID"])
        {
            die("Unauthorized action performed. You do not have the permission to perform the action");
        }
        
        $sqlDelete = 
        "
        DELETE FROM product
        WHERE ProductID = $productID
        ";

        mysqli_query($con, $sqlDelete) or die(mysqli_error($con));

        $_SESSION["Message"] = "Product Deleted";
        header("Location: seller_products.php?ProductID=".$productID);
        return;

   }
   
   //Normal load
   $productID = $_GET["ProductID"];
   $sql = "SELECT * FROM product INNER JOIN subcategory ON product.SubCategoryID = subcategory.SubCategoryID WHERE product.ProductID = $productID";
   $result = mysqli_query($con, $sql) or die(mysqli_error($con));
   $data = mysqli_fetch_array($result);
   
   //Reviews
   //Ratings




   //Prevent seller from accessing product they do not own
   if ($data["SellerID"] != $_SESSION["SellerData"]["SellerID"])
   {
        header("Location: seller_products.php");
   }
        
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
        <!-- Banner -->
        <div class="text-end display-6 bg-color-black-2 text-white row py-4">
            <div class="me-4 pe-4 col-md-11">
                <span class="fs-4 ">Edit Product</span>
                <span class="text-primary px-2">|</span>
                <span class="display-6 text-gray-2">Product List</span>
            </div>
            <div class="col-md-1"> </div>
        </div>
        <!-- Flash message -->
        <div class="bg-success text-white row">
            <div class="text-center">
                <?php 
                if (isset($_SESSION["SuccessMessage"])) 
                { 
                    echo "<br>".$_SESSION["SuccessMessage"]."<br><br>";
                    unset($_SESSION["SuccessMessage"]);
                }
                ?>
            </div>
        </div>

        <!-- Content -->
        <form id="form_editProduct" class="row" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" onsubmit="return CheckImage()" >
            <div class="col-md-1"></div>
            <div class="col-md-10 d-md-flex flex-md-column bg-color-white-2 px-4 my-4">

                <!-- Flash error message -->
                <div class="text-center text-danger h6">
                    <?php 
                    if (isset($_SESSION["Message"])) 
                    { 
                        echo "<br>".$_SESSION["Message"]."<br><br>";
                        unset($_SESSION["Message"]);
                    }
                    ?>
                </div>
                
                <input type="text" name="input_productID" id="id_productID" value="<?php echo $productID; ?>" hidden>

                <div class="row my-4 p-2">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 px-4 text-center">
                        <img id="id_picPlaceHolder" src="<?php echo $data['ProductPicture']?>" class="text-center bg-color-white-4 border border-5" style="width: 12rem; height:12rem;">
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="text-center mb-4 p-2 px-4 display-6 text-wrap">
                    <?php echo $data['ProductName'];?>
                </div>
                <div class="row mb-4 p-2 px-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 h6 px-2"><label for="id_photo" class="form-label">Product Photo:</label></div>
                    <div class="col-md-6 mb-2">
                        <input type="file" name="input_picFile" id="id_photo" class="form-control" onchange="displayImg(event)" accept="image/jpg, image/jpeg, image/png" style="display: none;">
                        <label for="id_photo" class="btn btn-primary">Upload new image</label>
                        <div id="id_photoErrorMsg" class="text-danger mt-2"></div>
                    </div>
                    
                    <div class="col-md-3"></div>
                    <div class="col-md-3"></div>
                    <div class="col-md-9 mt-2"><small>Recommended: 1:1 image ratio. Only .png, .jpg and .jpeg files allowed<br>Max 2MB size</small></div>
                </div>
                <div class="row mb-4 p-2 px-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 h6 px-2"><label for="id_productName" class="form-label">Product Name:</label></div>
                    <div class="col-md-6 "><input type="text" class="form-control" name="input_productName" id="id_productName" placeholder="Product Name" value="<?php echo $data['ProductName'];?>" required></div>
                    <div class="col-md-3"></div>

                    <div class="col-md-3"></div>
                    <div class="col-md-9"></div>
                </div>
                <div class="row mb-4 p-2 px-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 h6 px-2"><label for="id_price" class="form-label">Product Price:</label></div>
                    <div class="col-md-3 ">
                        <div class="input-group">
                            <span class="input-group-text">RM</span>
                            <input type="text" class="form-control" name="input_price" id="id_price" placeholder="0.00" onblur="SetDecimalFloatValue(this.id,2, this.value, '0.00')" value="<?php echo $data['Price']?>" required>
                        </div>
                        
                    </div>
                    <div class="col-md-6"></div>

                    <div class="col-md-3"></div>
                    <div class="col-md-9">Input 2 points decimals only without RM <br>E.g. 69.42</div>
                </div>
                <div class="row mb-4 p-2 px-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 h6 px-2"><label for="id_weight" class="form-label">Weight:</label></div>
                    <div class="col-md-3 ">
                        <div class="input-group">
                        
                            <input type="text" class="form-control" name="input_weight" id="id_weight" placeholder="in gram" value="<?php echo $data['Weight']?>" onblur="SetDecimalFloatValue(this.id,0, this.value, '0')" required>
                            <span class="input-group-text">g</span>    
                        </div>
                    </div>
                    <div class="col-md-6"></div>

                    <div class="col-md-3"></div>
                    <div class="col-md-9">Weight of product in gram<br>Input max 8 digit numbers only<br>E.g. 420</div>
                </div>
                <div class="row mb-4 p-2 px-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 h6 px-2"><label for="id_category" class="form-label">Category:</label></div>
                    <div class="col-md-6 ">
                        <select id="id_category" class="form-select" onchange="OnCategorySelect(this.value)" required>
                            <?php
                                if ($data['CategoryID'] == "FISHCA")
                                {
                                    echo '
                                    <option value="FISHCA" selected>Fishery</option>
                                    <option value="ORGACA">Organic</option>
                                    ';
                                }
                                else if ($data['CategoryID'] == "ORGACA")
                                {
                                    echo '
                                    <option value="FISHCA">Fishery</option>
                                    <option value="ORGACA" selected>Organic</option>
                                    ';
                                }
                                else{
                                    echo '
                                    <option selected hidden value>Select a category</option>
                                    <option value="FISHCA">Fishery</option>
                                    <option value="ORGACA">Organic</option>
                                    ';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3"></div>

                    <div class="col-md-3"></div>
                    <div class="col-md-9"></div>
                </div>
                <div class="row mb-4 p-2 px-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 h6 px-2"><label for="id_subCategory" class="form-label">Sub-Category:</label></div>
                    <div class="col-md-6 " id="div_subCategory">
                        * Select a category first
                        <!-- Script is run below -->
                    </div>
                    <div class="col-md-3"></div>

                    <div class="col-md-3"></div>
                    <div class="col-md-9"></div>
                </div>
                <div class="row mb-4 p-2 px-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 h6 px-2"><label for="id_shippingMethod" class="form-label">Shipping Method:</label></div>
                    <div class="col-md-6 ">
                        <select name="input_shippingMethod" id="id_shippingMethod" class="form-select" onchange="" required>
                            <?php
                                if ($data['ShippingMethod'] == "Seller self-delivery")
                                {
                                    echo '
                                    <option selected value="Seller self-delivery">Seller self-delivery</option>
                                    <option value="Third-party delivery">Third-party delivery</option>
                                    ';
                                }
                                else if ($data['ShippingMethod'] == "Third-party delivery")
                                {
                                    echo '
                                    <option value="Seller self-delivery">Seller self-delivery</option>
                                    <option selected value="Third-party delivery">Third-party delivery</option>
                                    ';
                                }
                                else{
                                    echo '
                                    <option selected hidden value>Select a shipping method</option>
                                    <option value="Seller self-delivery">Seller self-delivery</option>
                                    <option value="Third-party delivery">Third-party delivery</option>
                                    ';
                                }
                            ?>
                        
                        
                        </select>
                    </div>
                    <div class="col-md-3"></div>

                    <div class="col-md-3"></div>
                    <div class="col-md-9"></div>
                </div>
                <div class="row mb-4 p-2 px-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 h6 px-2"><label for="id_productSpecification" class="form-label">Product Specification:</label></div>
                    <div class="col-md-6 ">
                        <textarea name="input_productSpecification" id="id_productSpecification" class="form-control" placeholder="Product Specification..."><?php echo $data['ProductSpecification'] ?></textarea>
                    </div>
                    <div class="col-md-3"></div>

                    <div class="col-md-3"></div>
                    <div class="col-md-9">Max 1200 characters</div>
                </div>
                <div class="row mb-4 p-2 px-4 text-center">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"><input type="submit" class="btn btn-primary" name="updateBtn" value="Update Product" ></div>
                    <div class="col-md-4">
                        <!-- <input type="submit" class="btn btn-outline-danger" name="DeleteBtn" value="Delete Product" formnovalidate> -->
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#id_confirmDelete">
                            Delete Product
                        </button>
                    </div>
                </div>
                <br>
            </div>
            <div class="col-md-1"></div>
        </form> 
    </div>

    <!-- Modal For Delete Confirmation -->
    <div class="modal" id="id_confirmDelete">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-white">DELETE PRODUCT</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body text-center">
                    <div class="h4 text-danger">WARNING</div>
                    <div>You are attempting to delete product:</div><br><br>
                    <div class="display-6 fs-4"><?php echo $data["ProductName"] ?></div><br>
                </div>

                <!-- Modal footer -->
                <div class="spanLineFull-gray mx-auto"></div>
                <div class="row py-4">
                    <div class="col-md-4 "></div>
                    <div class="col-md-4 text-center">
                        <input type="submit" form="form_editProduct" class="btn btn-danger" name="DeleteBtn" value="Delete Product" formnovalidate>
                    </div>
                    <div class="col-md-4 text-center">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require "footer_seller.php";?>       

    

    <script>

        function displayImg(event){
            var image = document.getElementById('id_picPlaceHolder');
            var originalImage = image.src;
            try{
                fileFormat = event.target.files[0].name.substring(event.target.files[0].name.lastIndexOf('.')+1, event.target.files[0].name.length);
                
                if (fileFormat != "jpg" && fileFormat != "png" && fileFormat != "jpeg")
                {
                    throw("<b>*Invalid File Format</b>");
                }
                image.src = URL.createObjectURL(event.target.files[0]);

                var errorMsg = document.getElementById("id_photoErrorMsg");
                errorMsg.innerHTML = "";
            }
            catch(err){
                var errorMsg = document.getElementById("id_photoErrorMsg");
                errorMsg.innerHTML = err;
                image.src = originalImage;
            }
        }

        function CheckImage(){
            var errorMsg = document.getElementById("id_photoErrorMsg");
            console.log(errorMsg.innerHTML);
            if (errorMsg.innerHTML.trim() != "")
            {
                alert("Invalid image format uploaded \n Only jpg, png and jpeg files are allowed");
                return false;
            }
            else{
                return true;
            }
        }

        function OnCategorySelect(category, subCategory = null){
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                document.getElementById("div_subCategory").innerHTML = this.responseText;
            }
            if (subCategory === null)
            {
                xhttp.open("GET", "resources/logic_seller_addProduct.php?CategoryID="+category);
            }
            else{
                xhttp.open("GET", "resources/logic_seller_addProduct.php?CategoryID="+category+"&SubCategoryID="+subCategory);
            }
            xhttp.send();
        }

        
    </script>
    <?php 
        //Change sub-category dropdown menu
        js_RunScript("OnCategorySelect('".$data['CategoryID']."','".$data['SubCategoryID']."');");
    ?>
</body>
</html>