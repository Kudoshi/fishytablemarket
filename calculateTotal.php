<?php
    require("resources/conn.php");
    $id = $_GET['cartID'];
    $sql = "SELECT productcartlist.Quantity, product.Price FROM product INNER JOIN productcartlist ON product.ProductID = productcartlist.ProductID WHERE productcartlist.CartID = $id";
    $result = mysqli_query($con, $sql);
    $total = 0;

    while ($data = mysqli_fetch_array($result)) {
        $qty = $data["Quantity"];
        $price = $data["Price"];
        $total += $qty * $price;
    }
    echo number_format($total,2);

?>