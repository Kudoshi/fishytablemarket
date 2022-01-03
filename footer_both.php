<?php
    if (isset($_SESSION["SellerData"]))
    {
        require "footer_seller.php";
    }
    else{
        require "footer.php";
    }
?>