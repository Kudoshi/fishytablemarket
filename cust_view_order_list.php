<?php require "resources/conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Items Order</title>
    <link rel="stylesheet" href="css/cvol.css">
    
    <?php require "import_headInfo.php"; ?>
    <!-- More stuff can be put below here -->
</head>
<body>
    <?php require "header.php"; 
    $id = intval($_SESSION["CustID"]);
    $cart=mysqli_query($con,"SELECT * FROM cart INNER JOIN productcartlist ON cart.CartID = productcartlist.CartID INNER JOIN 
    product ON productcartlist.ProductID = product.ProductID WHERE CustID = '$id'");
    $cartData=mysqli_fetch_array($cart);
    ?>

<section>
<br><br><br>
    <div class="view-order">
        <h1>Items Order</h1>
    </div>
    <div class="view-order-top">
        <table class="table table-striped table-bordered ordertable" style="width: 100%">
            <thread>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                </tr>
            </thread>
        </table>
    </div>

    <?php

while($row = mysqli_fetch_array($cart)){ 
$html_script =
    '
    <table class="table table-striped table-bordered ordertable" style="width: 100%">
    <thread>
        <tr>
            <th>'.$row["ProductName"].'</th>
            <th>'.$row["Quantity"].'</th>
            <th>'.$row["UnitPrice"].'</th>
        </tr>
    </thread>
    </table>';
    echo $html_script;
}
    ?>
<br><br><br>
            

    <?php require "footer.php";?>
</body>
</html>