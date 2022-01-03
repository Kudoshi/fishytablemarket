<?php

    require("resources/conn.php");
    $quantity = $_GET['quantity'];
    $id = $_GET['id'];

    $sql = "UPDATE productcartlist 
    SET Quantity = $quantity
    WHERE ProductCartListID = $id";

    if (mysqli_query($con, $sql)) {
        mysqli_close($con);
        header('Location: cartPage.php');
    }

?>