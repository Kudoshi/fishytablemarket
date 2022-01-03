<?php
    require "resources/conn.php";

    // if (isset($_SESSION["CustID"])) {
    //     $cart = mysqli_query($con,"SELECT ProductCartListID, CustID FROM productcartlist INNER JOIN cart ON ProductCartList.CartID = cart.CartID WHERE cart.CustID = ".$_SESSION["CustID"]." AND cart.CartPaid = 0");
    //     $numOfCart = mysqli_num_rows($cart);
    //     echo '<li id="cartIcon" class="nav-item"> <a href="cartPage.php" method="post" class="nav-link position-relative"> <img src="image/cart2.png" width="20px",height="20px">';
    //     if ($numOfCart > 0) {
    //         echo '<span class="position-absolute top-0 start-100 translate-middle badge bg-warning rounded-pill text-dark">'.$numOfCart.'</span> ';
    //     }
    //     echo '</a> </li>';
    // }
    if (isset($_SESSION["CustID"])) {
        $cart = mysqli_query($con,"SELECT ProductCartListID, CustID FROM productcartlist INNER JOIN cart ON ProductCartList.CartID = cart.CartID WHERE cart.CustID = ".$_SESSION["CustID"]." AND cart.CartPaid = 0");
        $numOfCart = mysqli_num_rows($cart);
        echo '<li id="cartIcon" class="nav-item"> <a id="cartLink" href="cartPage.php" method="post" class="nav-link position-relative"> <img src="image/cart2.png" width="20px",height="20px">';
        if ($numOfCart > 0) {
            echo '<span id="cartQty" class="position-absolute top-0 start-100 translate-middle badge bg-warning rounded-pill text-dark">'.$numOfCart.'</span> ';
        }
        echo '</a> </li>';
    }
?>