<?php require "resources/conn.php"?>
<?php require "resources/seller_utility.php"?>
<?php
    if (isset($_POST["registerBtn"])){
        $errorMsg = "";
        $fullName= sanitizeInput($_POST["Name"], "string");
        $email= sanitizeInput($_POST["Email"], "email");
        $password = sanitizeInput($_POST["Password"], "string");
        $telephoneNo = sanitizeInput($_POST["TelephoneNo"],"string");
        $address = sanitizeInput($_POST["Address"],"string");
        $shopName = sanitizeInput($_POST["ShopName"],"string");
        $shopDescription = sanitizeInput($_POST["ShopDescription"], "string");
        $shopPic = $_FILES["PicFile"];
        
        if (!validateInputLength($fullName, 3, 60))
        {
            $errorMsg .= "<br>* Name is too long";
        }
        if (!validateInputLength($email, 3, 255) && filter_var($email, FILTER_VALIDATE_EMAIL) === false)
        {
            $errorMsg .= "<br>* Incorrect email format";
        }
        if (!validateInputLength($password, 8, 128))
        {
            $errorMsg .= "<br>* Incorrect password length";
        }
        if (!is_numeric($telephoneNo) && !validateInputLength($telephoneNo,8,12))
        {
            $errorMsg .= "<br>* Incorrect telephone number format";
        }
        if (!validateInputLength($address, 5, 255))
        {
            $errorMsg .= "<br>* Incorrect address length";
        }
        if (!validateInputLength($shopName, 4, 60))
        {
            $errorMsg .= "<br>* Incorrect shop length format";
        }
        if (!validateInputLength($shopDescription, 1, 150))
        {
            $errorMsg .= "<br>* Shop description is too long";
        }
        if (!validateImg($shopPic))
        {
            $errorMsg .= "<br>* Invalid file format uploaded";
        }
        
        //Upload pic
        if ($errorMsg ==="") 
        { 
            $PicName = uploadImg($shopName, $shopPic);
            if($PicName === False)
            {
                $$errorMsg .= "<br>* Unable to upload image";
            }
        }

        //Send confirmation message
        if ($errorMsg === "")
        {
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $date = date("y-m-d");
            $sql = "INSERT INTO seller (SellerName, SellerEmail, SellerPassword, SellerTelephone, SellerPhoto, ShopName, 
            SellerAddress, SellerDescription, JoinDate)
            VALUES
            ('$fullName', '$email', '$password', '$telephoneNo', '$PicName', '$shopName', '$address', '$shopDescription', '$date')";
            if (!mysqli_query($con,$sql))
            {
                $errorMsg .= "<br>Error creating an account";
            }
        }
        if ($errorMsg === "")
        {
            $_SESSION["Message"] = "Account successfully created";
            header("Location: seller_login.php");
            return;
        }
        else //Error
        {
            $_SESSION["Message"] = $errorMsg;

            //Sets the form data back
            $formData["Name"]= sanitizeInput($_POST["Name"], "string");
            $formData["Email"]= sanitizeInput($_POST["Email"], "email");
            $formData["Password"] = sanitizeInput($_POST["Password"], "string");
            $formData["TelephoneNo"] = sanitizeInput($_POST["TelephoneNo"],"string");
            $formData["Address"] = sanitizeInput($_POST["Address"],"string");
            $formData["ShopName"] = sanitizeInput($_POST["ShopName"],"string");
            $formData["ShopDescription"] = sanitizeInput($_POST["ShopDescription"], "string");
            $_SESSION["FormData"] = $formData;

            header("Location: seller_register.php");
            return;
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Header/footer usage</title>

    <?php require "import_headInfo.php"; ?>
    <?php require "resources/import_sellerHeadInfo.php"?>
</head>
<body>
    <?php
        //Prevent user from registering when logged in
        if (isset($_SESSION["CustomerID"])) 
        {
            header("Location: seller_home.php");
            return;
        }
        //Insert previously entered form data
        if (isset($_SESSION["FormData"]))
        {  
            $formData = $_SESSION["FormData"];  
            $fullName= $formData["Name"];
            $email= $formData["Email"];
            $password = $formData["Password"];
            $telephoneNo = $formData["TelephoneNo"];
            $address = $formData["Address"];
            $shopName = $formData["ShopName"];
            $shopDescription = $formData["ShopDescription"];
            
            unset($_SESSION["FormData"]);
        }
        else{
            //Declare blank var
            $fullName="";
            $email= "";
            $password = "";
            $telephoneNo = "";
            $address = "";
            $shopName = "";
            $shopDescription = "";
        }
    ?>



    <?php require "header.php"; ?>
    <div class="container-fluid">
        <div class="row">
            <!-- Left Side -->
            <div class="d-sm-flex flex-sm-column align-items-center col-sm-4 bg-primary pb-2" >
                <div class="row pt-4 px-4">
                    <a class="col-2 col-sm-2 mt-2" href="seller_login.php"><img src="image/arrow.png" alt="Back Button" style="width:80%; height: auto; max-width: 30px;"></a>
                    <p class="col-8 display-6 col-sm-8 text-center" style="font-size: 200%;">Register Seller Account</p>
                    <div class="col-2 col-sm-2"></div>
                </div>
                <div class="spanLine mx-auto mb-4"></div>
                <div class="w-100 px-4 text-sm-end text-center d-sm-flex flex-sm-column d-flex flex-column">
                    <a class="text-decoration-none mb-3 text-dark h6" href="#SellerInformation">Seller Information -</a>
                    <a class="text-decoration-none mb-3 text-dark h6" href="#ShopInformation">Shop Information -</a>
                </div>
                
            </div>
            <!-- Right Side -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" class="needs-validation col-sm-8 bg-color-w2 flex-grow-1 p-4 d-flex flex-column align-items-center">   
                <div class="text-center text-danger h6">
                    <?php if (isset($_SESSION["Message"])) 
                    { 
                        echo $_SESSION["Message"];
                        unset($_SESSION["Message"]);
                    }?>
                </div>
                <div class="display-6 text-center py-4" id="SellerInformation">Seller Information</div><br>
                <div class="row w-100 pb-4">
                    <div class="col-sm-3 h6"><label for="nameBox" class="form-label">Full Name:</label></div>
                    <div class="col-sm-6 input-group-sm px-4"><input type="text" class="form-control" name="Name" placeholder="Full Name" value="<?php echo $fullName?>" id="nameBox" required></div>
                    <div class="col-sm-3"><small>Your full name on official documents</small></div>
                </div>
                <div class="row w-100 pb-4">
                    <div class="col-sm-3 h6"><label for="emailBox" class="form-label">Email:</label></div>
                    <div class="col-sm-6 input-group-sm px-4"><input type="email" class="form-control" name="Email" id="emailBox" placeholder="Email" value="<?php echo $email?>" required></div>
                    <div class="col-sm-3"><small>Email of the seller</small></div>
                </div>
                <div class="row w-100 pb-4">
                    <div class="col-sm-3 h6"><label for="passwordBox" class="form-label">Password:</label></div>
                    <div class="col-sm-6 input-group-sm px-4"><input type="password" class="form-control" name="Password" id="passwordBox" placeholder="Password" value="<?php echo $password?>" required></div>
                    <div class="col-sm-3"><small>8 characters or more.<br>No spaces allowed</small></div>
                </div>
                <div class="row w-100 pb-4">
                    <div class="col-sm-3 h6"><label for="telephoneBox" class="form-label">Telephone Number:</label></div>
                    <div class="col-sm-6 input-group-sm px-4"><input type="text" class="form-control" name="TelephoneNo" id="telephoneBox" placeholder="Telephone Number" value="<?php echo $telephoneNo?>" required></div>
                    <div class="col-sm-3"><small>Valid Malaysian phone number without country code. <br>Format: 0129999999</small></div>
                </div>
                <div class="row w-100 pb-4">
                    <div class="col-sm-3 h6"><label for="addressBox" class="form-label">Address:</label></div>
                    <div class="col-sm-6 input-group-sm px-4"><textarea class="form-control" name="Address" id="addressBox" placeholder="Address" rows="3" required><?php echo $address?></textarea></div>
                    <div class="col-sm-3"><small>Address of the shop or farm.</small></div>
                </div>
                <br>
                <!-- SHOP INFORMATION SECTION -->
                <div class="display-6 text-center py-4" id="ShopInformation">Shop Information</div><br>
                <div class="row w-100 pb-4">
                    <div class="col-sm-3 h6"><label for="shopNameBox" class="form-label">Shop Name:</label></div>
                    <div class="col-sm-6 input-group-sm px-4"><input type="text" class="form-control" name="ShopName" id="shopNameBox" placeholder="Shop Name" value="<?php echo $shopName?>" required></div>
                    <div class="col-sm-3"><small>Name that will be shown to the customer<br>4 - 60 letters long</small></div>
                </div>
                <div class="row w-100 pb-4">
                    <div class="col-sm-3 h6"><label for="shopDescriptionBox" class="form-label">Shop Description:</label></div>
                    <div class="col-sm-6 input-group-sm px-4"><textarea class="form-control" name="ShopDescription" id="shopDescriptionBox" placeholder="Shop Description" rows="5" required><?php echo $shopDescription?></textarea></div>
                    <div class="col-sm-3"><small>Max 150 characters</small></div>
                </div>
                <div class="row w-100 pb-4">
                    <div class="col-md-3 col-sm-3 h6"><label for="shopPhotoBox" class="form-label">Shop Photo:</label></div>
                    <div class="col-md-6 col-sm-9 input-group-sm px-4 "><input type="file" name="PicFile" id="shopPhotoBox" onchange="displayImg(event)" accept="image/jpg, image/jpeg, image/png" required></div>
                    <div class="col-md-3 col-sm-12"><small>Recommended: 1:1 image ratio<br>Only .png, .jpg and .jpeg files allowed<br>Max 2MB size</small></div>
                </div>
                <div class="row w-100 pb-4">
                    <div class="col-sm-3 h6"></div>
                    <div class="col-sm-6 input-group-sm px-4 text-center">
                        <img id="picPlaceholder" class="text-center bg-secondary" style="width:20vh;height:20vh;">
                    </div>
                    <div class="col-sm-3"></div>
                </div>

                <div>
                    <br><br>
                    <!-- TODO: JS and PHP validation -->
                    <input type="submit" class="btn btn-primary" name="registerBtn">
                </div>
                
            </form>
           
            <?php require "footer.php";?>
        </div>
    </div>

    <script>
        function displayImg(event){
            var image = document.getElementById('picPlaceholder')
            try{
                image.src = URL.createObjectURL(event.target.files[0]);
            }
            catch(err){
                image.src = "#";
            }
        }
    </script>
</body>
</html>

