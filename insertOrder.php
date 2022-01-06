<?php

    if(!isset($_POST))
    return;

    require("resources/conn.php");

    // Read the input stream, decode the JSON object into PHP object
    $body = json_decode(file_get_contents("php://input"), true);
    $response = [];

    // $dayYear = getdate(date("U"));
    // $month = gmdate("m");
    // $date = $dayYear["year"] . "-" . $month . "-" . $dayYear["mday"];

    // more efficient way to get date :)
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date("y-m-d");

    $recipientAddress = htmlspecialchars($body['recipientAddress']);
    
    $sql = "INSERT INTO orders (RecipientName, RecipientAddress, RecipientTelephone, OrderDate, CartID, totalprice)
    VALUES ('$body[recipientName]','$recipientAddress','$body[recipientPhone]', '$date', '$body[CartID]','$body[totalPrice]')";
    if (!mysqli_query($con, $sql)) {
        $response["error"] = 'Error:'.mysqli_error($con);
    }

    $sqlUpdate = "UPDATE cart SET CartPaid = 1 WHERE CartID = ".$body['CartID']."";
    if (mysqli_query($con, $sqlUpdate)) {
        $sqlNewCart = "INSERT INTO cart (CartPaid, CustID) VALUES (0, ".$_SESSION["CustID"].")";
        if (!mysqli_query($con, $sqlNewCart)) {
            $response["error"] = 'Error:'.mysqli_error($con);
        }
    } 
    // send back to front end
    echo json_encode($response);
?>