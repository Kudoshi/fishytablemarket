<?php require "resources/conn.php"?>
<?php require "resources/seller_utility.php"?>
<?php require "resources/seller_security.php"?>
<?php

   //Retrieve Info

    $sql = 
    "SELECT DISTINCT orders.OrderID, orders.RecipientName, orders.RecipientAddress, orders.RecipientTelephone,orders.OrderDate, orders.TotalPrice,
    cart.CartID,cart.CustID,
    customer.CustName, customer.CustEmail
    FROM orders
    INNER JOIN cart ON cart.CartID = orders.CartID 
    INNER JOIN productcartlist ON productcartlist.CartID = cart.CartID
    INNER JOIN product ON productcartlist.ProductID =product.ProductID
    INNER JOIN customer ON cart.CustID = customer.CustID 
    WHERE product.SellerID = ".$_SESSION["SellerData"]["SellerID"]." AND cart.CartPaid = 1
    ORDER BY orders.OrderID DESC";

    $result = mysqli_query($con, $sql) or die(mysqli_error($con));


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fishytable Market</title>
    
    <?php require "import_headInfo.php"?>
    <?php require "resources/import_sellerHeadInfo.php"?>
</head>
<body>
    <?php require "header_seller.php"; ?>
   
    <div class="container-fluid">
        <div class="text-end display-6 bg-color-black-2 text-white row py-4">
            <div class="me-4 pe-4 col-md-11">
                <span class="fs-4 ">View All Orders</span>
                <span class="text-primary px-2">|</span>
                <span class="text-gray-2 display-6">Orders</span>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="px-4 mx-4 mt-3">
            <div class="shadow-sm bg-color-black-3 border rounded-3 p-4 d-flex justify-content-center text-shadow-edge">
                <div class="fs-5 text-white text-center px-4"><?php echo $_SESSION["SellerData"]["ShopName"] ?></div>
                <span class="fs-5 text-primary">|</span>
                <div class="fs-5 text-white text-center px-4">Total Order: <?php echo $result->num_rows; ?></div>
            </div>
        </div>
        <!-- Container -->
        <div class=" px-4 py-3 mx-4 mb-4 ">
            <div class="shadow-sm bg-color-white-3 border rounded-3 p-4" style="min-height: 600px;" id="id_orderContainer">
                <!-- Chunk -->
                <?php 
                    $element = "";
                    $orderCounter = $result->num_rows + 1;
                    while ($row=mysqli_fetch_array($result))
                    {
                        $orderCounter--;
                        // TO DO: Order Counter
                        $element = '
                            <div class="bg-color-white-1 p-4 mb-4 shadow-sm" style="min-height: 400px;">
                                <div class="ps-2 h5"><span class="badge rounded-pill bg-color-blue-1 px-3 py-2">Order | '.$orderCounter.' </span></div>
                                
                                <div class="d-flex flex-column d-flex-md flex-md-row px-2 pb-1 justify-content-between ">
                                    <div>Customer | '.$row["CustName"].'</div>
                                    <div>Date Purchased | '.$row["OrderDate"].'</div>
                                </div>
                                
                                <div class="spanLineFull"></div>
                                <div class="table-responsive-md">
                                    <table class="table text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Unit Price</th>
                                                <th scope="col">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                        $sqlRecords = 
                        'SELECT * 
                        FROM productcartlist
                        INNER JOIN product ON product.ProductID = productcartlist.ProductID
                        WHERE productcartlist.CartID = '.$row["CartID"];

                        $resultRecords = mysqli_query($con, $sqlRecords) or die(mysqli_error($con));
                        
                        $totalPrice = 0;
                        $totalQuantity = 0;
                        while ($record =mysqli_fetch_array($resultRecords))
                        {
                            $totalQuantity ++;
                            $element .=
                            '<tr>
                                <td><img src="'.$record["ProductPicture"].'" style="width: 100px; height: 100px;"></td>
                                <td>'.$record["ProductName"].'</td>
                                <td>'.$record["Quantity"].'</td>
                                <td>RM '.number_format($record["UnitPrice"], 2).'</td>
                                <td>RM '.number_format($record["Quantity"]*$record["UnitPrice"], 2).'</td>
                            </tr>';
                        }
                        $element .= 
                        '    
                                    <tfoot></tfoot>
                                    </table>
                                    <table class="table table-borderless text-center">
                                        <tbody>
                                            <tr>
                                                <td style="width: 75%;"></td>
                                                <th>Total Quantity</td>
                                                <th style="width: 11%;">Total Price</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>'.$totalQuantity.'</td>
                                                <td>RM '.number_format($row["TotalPrice"], 2).'</td>
                                            </tr>
                                        </tbody>    
                                    
                                    </table>
                                    <div class="spanLineFull-sm m-0 p-0"></div>
                                </div>
                                
                                <div class="p-4 mt-3">
                                    <div class="d-flex flex-column d-sm-fex flex-sm-row mb-3">
                                        <div class="me-4 " style="min-width:150px">
                                            <b>Date Purchased</b>
                                        </div>
                                        <div class="ms-4">
                                            '.$row["OrderDate"].'
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column d-sm-fex flex-sm-row mb-3" >
                                        <div class="me-4" style="min-width:150px">
                                            <b>Customer Name</b>
                                        </div>
                                        <div class="ms-4">
                                            '.$row["CustName"].'
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column d-sm-fex flex-sm-row mb-3" >
                                        <div class="me-4" style="min-width:150px">
                                            <b>Customer Email</b>
                                        </div>
                                        <div class="ms-4">
                                            '.$row["CustEmail"].'
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column d-sm-fex flex-sm-row mb-3" >
                                        <div class="me-4" style="min-width:150px">
                                            <b>Recipient Name</b>
                                        </div>
                                        <div class="ms-4">
                                            '.$row["RecipientName"].'
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column d-sm-fex flex-sm-row mb-3" >
                                        <div class="me-4" style="min-width:150px">
                                            <b>Recipient Tel. No</b>
                                        </div>
                                        <div class="ms-4">
                                            '.$row["RecipientTelephone"].'
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column d-sm-fex flex-sm-row mb-3" >
                                        <div class="me-4" style="min-width:150px">
                                            <b>Recipient Address</b>
                                        </div>
                                        <div class="ms-4">
                                            '.$row["RecipientAddress"].'
                                        </div>
                                    </div>
                                    
                                </div>
                                    <div class="spanLineFull m-0 p-0"></div>
                            </div>
                            ';
                        
                                            
                        echo $element;
                    }
                    
                ?>


                
            </div>
        </div>


        

    </div>
    <?php require "footer_seller.php";?>
</body>
</html>