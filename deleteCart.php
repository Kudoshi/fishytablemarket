<?php
    if(!isset($_POST))
    return;

    require("resources/conn.php");

    $body = json_decode(file_get_contents("php://input"), true);
    $response = [];

    // $productcartID = intval($_GET['id']);
    $productcartID = intval($body['productID']);
    $deleteSql = "DELETE FROM productcartlist WHERE ProductCartListID=$productcartID";
    // echo $deleteSql;

    if (!mysqli_query($con, $deleteSql)){
        $response["error"] = 'Error:'.mysqli_error($con);
    }
    
    mysqli_close($con);
    // header('Location: cartPage.php');

    echo json_encode($response);
?>