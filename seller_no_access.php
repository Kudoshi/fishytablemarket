<?php require "resources/conn.php"?>
<?php require "resources/seller_utility.php"?>

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
        <div class="text-center display-6 bg-color-black-2 text-white row py-4">
            <div class="me-4 pe-4 col-md-11">
                <span class="display-6">Error</span>
                <span class="text-primary px-2">|</span>
                <span class="fs-4 text-gray-2">Unable to access page</span>
            </div>
            <div class="col-md-1"> </div>
        </div>
          
    </div>
    <?php require "footer_seller.php";?>   
</body>
</html>