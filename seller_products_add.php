<?php require "resources/conn.php"?>
<?php require "resources/seller_utility.php"?>
<?php require "resources/seller_security.php"?>
<?php
    
   if (isset($_POST["createBtn"]))
   {
       $errorMsg = "";
       $productName = sanitizeInput($_POST["input_productName"], "string");
       $shippingMethod = sanitizeInput($_POST["input_shippingMethod"], "string");
       $price = $_POST["input_price"];
       $productSpecification = sanitizeInput($_POST["input_productSpecification"], "string");
       $weight = $_POST["input_weight"];
       date_default_timezone_set("Asia/Kuala_Lumpur");
       $dateAdded = date("y-m-d");
       $sellerID = $_SESSION["SellerData"]["SellerID"];
       $subCategoryID = sanitizeInput($_POST["input_subCategory"], "string");
       $productPicture = $_FILES["input_picFile"];
       
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
        if ($errorMsg === "")
        {
            $PicName = uploadImg($productPicture);
            if ($PicName === False)
            {
                $errorMsg .= "<br>* Unable to upload image";
            }
        }
        if ($errorMsg === "")
        {
            $sql = "INSERT INTO product (ProductName,ShippingMethod, Price, ProductSpecification, ProductPicture, Weight, DateAdded, SellerID,
            SubCategoryID, ProductRating) 
            VALUES
            ('$productName', '$shippingMethod', '$price', '$productSpecification', '$PicName', '$weight', '$dateAdded', '$sellerID', '$subCategoryID', 0)";
            if (!mysqli_query($con, $sql))
            {
                $errorMsg .= "<br>Error adding new product <br>.".mysqli_error($con)." <br>".$sql;
            }
        }

        // Control Redirect
        if ($errorMsg === "") //SUCCESS
        {
            $_SESSION["Message"] = "New product successfully added";
            header("Location: seller_products.php");
            return;
        }
        else //ERROR
        {
            $_SESSION["Message"] = $errorMsg;

            $formData["input_productName"] = sanitizeInput($_POST["input_productName"], "string");
            $formData["input_shippingMethod"] = sanitizeInput($_POST["input_shippingMethod"], "string");
            $formData["input_price"] = sanitizeInput($_POST["input_price"], "string");
            $formData["input_productSpecification"] = sanitizeInput($_POST["input_productSpecification"], "string");
            $formData["input_weight"] = sanitizeInput($_POST["input_weight"], "string");
            $formData["input_subCategoryID"] = sanitizeInput($_POST["input_subCategory"], "string");
            $_SESSION["FormData"] = $formData;
            header("Location: seller_products_add.php");
            return;
        }
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
    <?php 
        if (isset($_SESSION["FormData"]))
        {
            $formData = $_SESSION["FormData"];
            $_productName = $formData["input_productName"];
            $_shippingMethod = $formData["input_shippingMethod"];
            $_price = $formData["input_price"];
            $_productSpecification = $formData["input_productSpecification"];
            $_weight = $formData["input_weight"];
            $_subCategoryID = $formData["input_subCategoryID"];
            $_categoryID = sql_retrieveRecord($con, "subcategory", "SubCategoryID", $_subCategoryID)["CategoryID"];

            unset($_SESSION["FormData"]);
        }
        else{ // Declare blank var
            $formData = "";
            $_productName = "";
            $_shippingMethod = "";
            $_price = "";
            $_productSpecification = "";
            $_weight = "";
            $_subCategoryID = "";
            $_categoryID = "";
        }
    ?>


    <?php require "header_seller.php"; ?>
   
    <div class="container-fluid">
        <div class="text-end display-6 bg-color-black-2 text-white row py-4">
            <div class="me-4 pe-4 col-md-11">
                <span class="fs-4 ">Add New Product</span>
                <span class="text-primary px-2">|</span>
                <span class="display-6 text-gray-2">Product List</span>
            </div>
            <div class="col-md-1"> </div>
        </div>
        

        <form class="row" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" onsubmit="return CheckImage()">
            
        
            <div class="col-md-1"></div>
            <div class="col-md-10 d-md-flex flex-md-column bg-color-white-2 px-4 my-4">
                <div class="text-center text-danger h6">
                    <?php 
                    if (isset($_SESSION["Message"])) 
                    { 
                        echo "<br>".$_SESSION["Message"]."<br><br>";
                        unset($_SESSION["Message"]);
                    }
                    ?>
                </div>
                <div class="row my-4 p-2">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 px-4 text-center">
                        <img id="id_picPlaceHolder" class="text-center bg-color-white-4 border border-5" style="width: 12rem; height:12rem;">
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row mb-4 p-2 px-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 h6 px-2"><label for="id_photo" class="form-label">Product Photo:</label></div>
                    <div class="col-md-6"><input type="file" name="input_picFile" id="id_photo" class="form-control" onchange="displayImg(event)" accept="image/jpg, image/jpeg, image/png" required>
                        <div id="id_photoErrorMsg" class="text-danger mt-2"></div>
                    </div>
                    <div class="col-md-3"></div>

                    <div class="col-md-3"></div>
                    <div class="col-md-9"><small>Recommended: 1:1 image ratio. Only .png, .jpg and .jpeg files allowed<br>Max 2MB size</small></div>
                </div>
                <div class="row mb-4 p-2 px-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 h6 px-2"><label for="id_productName" class="form-label">Product Name:</label></div>
                    <div class="col-md-6 "><input type="text" class="form-control" name="input_productName" id="id_productName" placeholder="Product Name"  required></div>
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
                            <input type="text" class="form-control" name="input_price" id="id_price" placeholder="0.00" onblur="SetDecimalFloatValue(this.id,2, this.value, '0.00')" value="<?php echo $_price?>" required>
                        </div>
                        
                    </div>
                    <div class="col-md-6"></div>

                    <div class="col-md-3"></div>
                    <div class="col-md-9">Input 2 points decimals only without RM<br>Maximum price 10 Million ringgit<br>E.g. 69.42</div>
                </div>
                <div class="row mb-4 p-2 px-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 h6 px-2"><label for="id_weight" class="form-label">Weight:</label></div>
                    <div class="col-md-3 ">
                        <div class="input-group">
                        
                            <input type="text" class="form-control" name="input_weight" id="id_weight" placeholder="in gram" value="<?php echo $_weight?>" onblur="SetDecimalFloatValue(this.id,0, this.value, '0')" required>
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
                                if ($_categoryID == "FISHCA")
                                {
                                    echo '
                                    <option value="FISHCA" selected>Fishery</option>
                                    <option value="ORGACA">Organic</option>
                                    ';
                                }
                                else if ($_categoryID == "ORGACA")
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
                                if ($_shippingMethod == "Seller self-delivery")
                                {
                                    echo '
                                    <option selected value="Seller self-delivery">Seller self-delivery</option>
                                    <option value="Third-party delivery">Third-party delivery</option>
                                    ';
                                }
                                else if ($_shippingMethod == "Third-party delivery")
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
                    <div class="col-md-9">You can change the shipping method later if needed</div>
                </div>
                <div class="row mb-4 p-2 px-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 h6 px-2"><label for="id_productSpecification" class="form-label">Product Specification:</label></div>
                    <div class="col-md-6 ">
                        <textarea name="input_productSpecification" id="id_productSpecification" class="form-control" placeholder="Product Specification..." required><?php echo $_productSpecification ?></textarea>
                    </div>
                    <div class="col-md-3"></div>

                    <div class="col-md-3"></div>
                    <div class="col-md-9">Max 1200 characters</div>
                </div>
                <div class="row mb-4 p-2 px-4 text-center">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"><input type="submit" class="btn btn-primary" name="createBtn" value="Create Product"></div>
                    <div class="col-md-4"></div>
                </div>
                <br>
            </div>
            <div class="col-md-1"></div>
        </form>
    </div>
    <?php require "footer_seller.php";?>       

    

    <script>
        function displayImg(event){
            var image = document.getElementById('id_picPlaceHolder');
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
                image.src = "image/emptyPic.png";
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
        if ($_subCategoryID !== "")
        {
            js_RunScript("OnCategorySelect('$_categoryID','$_subCategoryID');");
        }
                        
    ?>
</body>
</html>