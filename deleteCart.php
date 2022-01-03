<?php
    // if(!isset($_POST))
    // return;

    require("resources/conn.php");

    // $body = json_decode(file_get_contents("php://input"), true);
    // $response = [];
    $productcartID = intval($_GET['id']);

    $result = mysqli_query($con, "DELETE FROM productcartlist WHERE ProductCartListID=$productcartID");
    mysqli_close($con);
    header('Location: cartPage.php');
?>