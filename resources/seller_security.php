<!-- Run at the very start of the page -->
<!-- For logging out sellers automatically if they did not logged in properly -->

<?php
    if (!isset($_SESSION["SellerData"]))
    {
        header("Location: seller_logic_logout.php");
        return;
    }
?>