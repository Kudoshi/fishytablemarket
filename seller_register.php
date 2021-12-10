<?php require "resources/seller_db_util.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Header/footer usage</title>

    <?php require "import_headInfo.php"; ?>
    <?php require "resources/import_sellerHeadInfo.php"?>
</head>
<body>
    <?php require "header.php"; ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Left Side -->
            <div class="d-sm-flex flex-sm-column align-items-center col-sm-4 bg-primary pb-2">
                <div class="row pt-4 px-4">
                    <a class="col-2 col-sm-2 mt-2" href="seller_login.php"><img src="image/arrow.png" alt="Back Button" style="width:80%; height: auto; max-width: 30px;"></a>
                    <p class="col-8 display-6 col-sm-8 text-center" style="font-size: 200%;">Register Seller Account</p>
                    <div class="col-2 col-sm-2"></div>
                </div>
                <div class="spanLine mx-auto mb-4"></div>
                <div class="w-100 px-4 text-sm-end text-center d-sm-flex flex-sm-column d-flex flex-column">
                    <a class="text-decoration-none mb-2 text-dark ">Seller Information</a>
                    <a class="text-decoration-none mb-2 text-dark ">Shop Information</a>
                </div>
                
            </div>
            <!-- Right Side -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="needs-validation col-sm-8 bg-color-w2 flex-grow-1 p-4 d-flex flex-column align-items-center">   
                
                <div class="display-6 text-center py-4">Seller Information</div><br>
                <div class="row w-100 pb-4">
                    <div class="col-sm-3 h6"><label for="nameBox" class="form-label">Full Name:</label></div>
                    <div class="col-sm-6 input-group-sm px-4"><input type="text" class="form-control" name="Name" placeholder="Full Name" id="nameBox" required></div>
                    <div class="col-sm-3"><small>Your full name on official documents</small></div>
                </div>
                <div class="row w-100 pb-4">
                    <div class="col-sm-3 h6"><label for="emailBox" class="form-label">Email:</label></div>
                    <div class="col-sm-6 input-group-sm px-4"><input type="email" class="form-control" name="Email" id="emailBox" placeholder="Email" required></div>
                    <div class="col-sm-3"><small>Email of the seller</small></div>
                </div>
                <div class="row w-100 pb-4">
                    <div class="col-sm-3 h6"><label for="passwordBox" class="form-label">Password:</label></div>
                    <div class="col-sm-6 input-group-sm px-4"><input type="password" class="form-control" name="Password" id="passwordBox" placeholder="Password" required></div>
                    <div class="col-sm-3"><small>8 characters or more</small></div>
                </div>
                <div class="row w-100 pb-4">
                    <div class="col-sm-3 h6"><label for="telephoneBox" class="form-label">Telephone Number:</label></div>
                    <div class="col-sm-6 input-group-sm px-4"><input type="text" class="form-control" name="TelephoneNo" id="telephoneBox" placeholder="Telehpone Number" required></div>
                    <div class="col-sm-3"><small>Valid Malaysian phone number without country code. <br>Format: 0129999999</small></div>
                </div>
                <div class="row w-100 pb-4">
                    <div class="col-sm-3 h6"><label for="addressBox" class="form-label">Address:</label></div>
                    <div class="col-sm-6 input-group-sm px-4"><textarea class="form-control" name="Address" id="addressBox" placeholder="Address" rows="3" required></textarea></div>
                    <div class="col-sm-3"><small>Address of the shop or farm.</small></div>
                </div>
                <br>
                <!-- SHOP INFORMATION SECTION -->
                <div class="display-6 text-center py-4">Shop Information</div><br>
                <div class="row w-100 pb-4">
                    <div class="col-sm-3 h6"><label for="shopNameBox" class="form-label">Shop Name:</label></div>
                    <div class="col-sm-6 input-group-sm px-4"><input type="text" class="form-control" name="ShopName" id="shopNameBox" placeholder="Shop Name" required></div>
                    <div class="col-sm-3"><small>Name that will be shown to the customer</small></div>
                </div>
                <div class="row w-100 pb-4">
                    <div class="col-sm-3 h6"><label for="shopDescriptionBox" class="form-label">Shop Description:</label></div>
                    <div class="col-sm-6 input-group-sm px-4"><textarea class="form-control" name="ShopDescription" id="shopDescriptionBox" placeholder="Shop Description" rows="5" required></textarea></div>
                    <div class="col-sm-3"><small>Max 150 characters</small></div>
                </div>
                <div class="row w-100 pb-4">
                    <div class="col-sm-3 h6"><label for="shopPhotoBox" class="form-label">Shop Photo:</label></div>
                    <div class="col-sm-6 input-group-sm px-4"><textarea class="form-control" name="ShopPhoto" id="shopPhotoBox" placeholder="Shop photo" rows="5" required></textarea></div>
                    <div class="col-sm-3"><small>Max 150 characters</small></div>
                </div>
                <div>
                    <br><br>
                    <!-- TODO: JS and PHP validation -->
                    <input type="submit" class="btn btn-primary" name="registerBtn">
                </div>
                
            </form>
           
       


        </div>
        <?php require "footer.php";?>
    </div>
</body>
</html>