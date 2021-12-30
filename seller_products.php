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
        <div class="text-end display-6 bg-color-black-2 text-white row py-4">
            <div class="me-4 pe-4 col-md-11">
                <span class="fs-4 ">View All Products</span>
                <span class="text-primary px-2">|</span>
                <span class="text-gray-2 display-6">Product List</span>
            </div>
            <div class="col-md-1"></div>
        </div>
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
        <div class="row">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-center px-4 py-2 mb-4 bg-color-black-2">
                <div class="w-50 py-2 m-2">
                    <form action="" class="mx-auto d-flex">
                        <label for="id_category" class="text-white fs-5 me-4 pe-4">Category:</label>
                        <select name="input_category" id="id_category" class="form-select" onchange="LoadItemList(value)">
                            <option value="ALL">CATEGORY: All</option>
                            <option value="FISHCA">CATEGORY: Fishery</option>
                            <option value="ORGACA">CATEGORY: Organic</option>
                        </select>
                    </form>
                </div>
                <div class="text-center py-2 m-2">
                    <div class="btn-primary btn "><a href="seller_products_add.php" class=" text-decoration-none text-white">Add New Product</a></div>
                </div>
            </div>
        </div>
        
        <div class="px-4 mx-2 mb-4 mt-2">
            <div class="bg-color-white-3 border rounded-3 p-4 d-flex flex-wrap ms-auto" style="min-height: 800px;" id="id_itemContainer">
                
            </div>
        </div>
    </div>



    <?php require "footer_seller.php";?>

    <script>
        function LoadItemList(category="ALL")
        {
            console.log(category);
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                document.getElementById('id_itemContainer').innerHTML = this.responseText;
            }
            xhttp.open("GET", "resources/logic_seller_viewProduct.php?CategoryID="+category);
            xhttp.send();
        }
        LoadItemList();
    </script>
</body>
</html>