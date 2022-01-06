<?php
    if (!isset($_SESSION["CustID"])) {
        die("Please login before you access.");
    }
    if(!isset($_POST))
        return;

    require("resources/conn.php");

    // Read the input stream, decode the JSON object into PHP object
    $body = json_decode(file_get_contents("php://input"), true);
    $response = [];

    // fetching the cartID
    $cartID = mysqli_query($con, "SELECT CartID FROM cart WHERE CustID = ".$_SESSION['CustID']." AND CartPaid = 0");
    $cartID = mysqli_fetch_array($cartID);
    $cartID = $cartID["CartID"];

    // Fetch productcartlistID that have the productID
    $productCartListID = mysqli_query($con, "SELECT ProductCartListID FROM productcartlist INNER JOIN cart ON productcartlist.CartID = cart.CartID WHERE productcartlist.ProductID = ".$body["productID"]." AND cart.CartPaid=0 AND cart.CustID = ".$_SESSION['CustID']."");
    
    // Fetch record that exist (same productID, and if yes, only will be 1 record exist.)   
    $listrecord = mysqli_num_rows($productCartListID);
    
    // Fetch unitPrice
    
    if ($body["quantity"] > 0)
    {
        $productCartListID = mysqli_fetch_array($productCartListID);
        $productCartListID = $productCartListID["ProductCartListID"];
        if ($listrecord > 0) {
            $sql = "UPDATE productcartlist SET Quantity = Quantity + $body[quantity] WHERE ProductCartListID=$productCartListID";
        }
        else {
            $unitPrice = mysqli_query($con, "SELECT Price FROM Product WHERE ProductID = $body[productID]");
            $unitPrice = mysqli_fetch_array($unitPrice);
            $unitPrice = $unitPrice["Price"];

            $sql = "INSERT INTO productcartlist (Quantity, UnitPrice, CartID, ProductID)
            VALUES('$body[quantity]', '$unitPrice', '$cartID', '$body[productID]')";
        }
        
        if (!mysqli_query($con, $sql)) {
            // die('Error:'.mysqli_error($con));
            $response["error"] = 'Error:'.mysqli_error($con);
        }

    }
    
    
    // return back the data (key n value)
    // $response["productID"] = $body["productID"];
    // $response["productcartID"] = $productCartListID;
    $cartQuery = mysqli_query($con,"SELECT ProductCartListID, CustID FROM productcartlist INNER JOIN cart ON ProductCartList.CartID = cart.CartID WHERE cart.CustID = ".$_SESSION["CustID"]." AND cart.CartPaid = 0");
    $cartQty = mysqli_num_rows($cartQuery);
    $response["cartQty"] = $cartQty;
    echo json_encode($response); //convert php object into js object
?>