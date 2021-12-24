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
   
    <div class="container-fluid">
        <div class="text-end display-6 bg-color-black-2 text-white row py-4">
            <div class="me-4 pe-4 col-md-11">
                <span class="fs-4 ">Add New Product</span>
                <span class="text-primary px-2">|</span>
                <span class="display-6 text-gray-2">Product List</span>
            </div>
            <div class="col-md-1"> </div>
        </div>
        <div class="row" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
            <div class="col-md-1"></div>
            <form class="col-md-10 d-md-flex flex-md-column bg-color-white-2 px-4 my-4">
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
                    <div class="col-md-6"><input type="file" name="input_picFile" id="id_photo" class="form-control" onchange="displayImg(event)" accept="image/jpg, image/jpeg, image/png" required></div>
                    <div class="col-md-3"></div>

                    <div class="col-md-3"></div>
                    <div class="col-md-9"><small>Recommended: 1:1 image ratio. Only .png, .jpg and .jpeg files allowed<br>Max 2MB size</small></div>
                </div>
                <div class="row mb-4 p-2 px-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 h6 px-2"><label for="id_productName" class="form-label">Product Name:</label></div>
                    <div class="col-md-6 "><input type="text" class="form-control" name="input_productName" id="id_productName" placeholder="Product Name" required></div>
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
                            <input type="text" class="form-control" name="input_price" id="id_price" placeholder="Product Price" required>
                        </div>
                        
                    </div>
                    <div class="col-md-6"></div>

                    <div class="col-md-3"></div>
                    <div class="col-md-9">Input numbers and decimals only without RM <br>E.g. 69.42</div>
                </div>
                <div class="row mb-4 p-2 px-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 h6 px-2"><label for="id_weight" class="form-label">Weight:</label></div>
                    <div class="col-md-3 ">
                        <div class="input-group">
                        
                            <input type="text" class="form-control" name="input_price" id="id_price" placeholder="Product Price" required>
                            <span class="input-group-text">Gram</span>    
                        </div>
                    </div>
                    <div class="col-md-6"></div>

                    <div class="col-md-3"></div>
                    <div class="col-md-9">Weight of product in gram<br>Input numbers only. E.g. 420</div>
                </div>
                <div class="row mb-4 p-2 px-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 h6 px-2"><label for="id_category" class="form-label">Category:</label></div>
                    <div class="col-md-6 ">
                        <select id="id_category" class="form-select" onchange="OnCategorySelect(this.value)" required>
                            <option>Select a category</option>
                            <option value="FISHCA">Fishery</option>
                            <option value="ORGACA">Organic</option>
                        </select>
                    </div>
                    <div class="col-md-3"></div>

                    <div class="col-md-3"></div>
                    <div class="col-md-9"></div>
                </div>
                <div class="row mb-4 p-2 px-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 h6 px-2"><label for="id_subCategory" class="form-label">Sub-Category:</label></div>
                    <div class="col-md-6 ">
                        <select name="input_subCategory" id="id_subCategory" class="form-select" required>
                            <option>Select a sub-category</option>
                            <option value="FISHCA">Fishery</option>
                            <option value="ORGACA">Organic</option>
                        </select>
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
                            <option>Select a shipping method</option>
                            <option value="FISHCA">Seller self-delivery</option>
                            <option value="ORGACA">Third-party delivery</option>
                        </select>
                    </div>
                    <div class="col-md-3"></div>

                    <div class="col-md-3"></div>
                    <div class="col-md-9">You can change the shipping method later if needed</div>
                </div>
                <div class="row mb-4 p-2 px-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 h6 px-2"><label for="id_productDescription" class="form-label">Product Description:</label></div>
                    <div class="col-md-6 ">
                        <textarea name="input_productDescription" id="id_productDescription" class="form-control" placeholder="Product Description..."></textarea>
                    </div>
                    <div class="col-md-3"></div>

                    <div class="col-md-3"></div>
                    <div class="col-md-9">Max 1200 characters</div>
                </div>
                <div class="row mb-4 p-2 px-4 text-center">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"><input type="submit" class="btn btn-primary" value="Create Product"></div>
                    <div class="col-md-4"></div>
                </div>

            </form>
            <div class="col-md-1"></div>
        </div>

    </div>


    <?php require "footer_seller.php";?>

    <script>
        function displayImg(event){
            var image = document.getElementById('id_picPlaceHolder');
            console.log(image);
            try{
                image.src = URL.createObjectURL(event.target.files[0]);
            }
            catch(err){
                image.src = "image/emptyPic.png";
            }
        }

        function OnCategorySelect(caller){
            console.log(caller);
        }
    </script>
</body>
</html>