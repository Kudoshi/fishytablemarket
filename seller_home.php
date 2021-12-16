<?php require "resources/conn.php"?>
<?php require "resources/seller_utility.php"?>
<?php
   if (!isset($_SESSION["SellerID"]))
   {
       header("Location: seller_login.php");
       return;
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fishytable Market|Seller Login</title>
    
    <?php require "import_headInfo.php"?>
    <?php require "resources/import_sellerHeadInfo.php"?>
</head>
<body>
    <?php require "header.php"; ?>

    Hello you are logged in. Congratulations.
    <br>
    <a href="seller_login.php">Click here to seller login!</a><br>
    <a href="seller_logic_logout.php">Logout!</a>
    <br>
    This is your seller id: <br>
    <?php
        echo $_SESSION["SellerID"];
    ?>

    <?php require "footer.php";?>
</body>
</html>