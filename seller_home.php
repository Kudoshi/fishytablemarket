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
        <div class="row">
            <div class="col-md-3 bg-primary"><img src="image/<?php echo "Testing Shop_211216223105.png";?>" style="max-width: 600px;" alt="Picture of seller"></div>
            <div class="col-md-9 bg-warning">hi</div>
        </div>
    </div>


    <?php require "footer_seller.php";?>
</body>
</html>