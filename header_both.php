<?php
    if (isset($_SESSION["SellerData"]))
    {
        require "header_seller.php";
    }
    else{
        require "header.php";
    }
?>