<?php require "resources/conn.php";
    if (!isset($_SESSION["CustID"])) {
        die("Please login before you access.");
    }
    $sql = mysqli_query($con, "SELECT * FROM (((productcartlist INNER JOIN cart ON productcartlist.CartID = cart.CartID) INNER JOIN product ON productcartlist.ProductID =product.ProductID) INNER JOIN seller ON product.SellerID = seller.SellerID) INNER JOIN customer ON cart.CustID = customer.CustID WHERE cart.CustID = ".$_SESSION['CustID']." AND cart.CartPaid = 0");
    $numOfCart = mysqli_num_rows($sql);
    if ($numOfCart == 0) {
        echo '<script>alert("No item in cart");
        window.location.href="cartPage.php";</script>';
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Fishytable | Checkout Page</title>        
        <link rel="stylesheet" href="css/ml_css">
        <?php require "import_headInfo.php"; ?>
    </head>
    <body>
        <?php require "header.php";?>
        
        <div class="right-side-title">
            <h1 class="title-text">FishyTable Market | Checkout</h1>
        </div>
        <div class="flex-container-column" style="width:100%;">
            <br>
            <div class="flex-container-row w-90">
                <img src="image/location_icon.png" alt="location icon" style="width:30px; height:35px;">
                <div class="display-5">DELIVERY ADDRESS DETAIL</div>
            </div>
                <br>
            <!-- <form action="insertOrder.php" method="post" id="form1" class="flex-container-column bg-light pt-3 pb-3 was-validated" style="width:90%"> -->
            <form id="form1" class="flex-container-column bg-light pt-3 pb-3 was-validated" style="width:90%">
                <div style="width:80%">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="recipientName" placeholder="Recipient's Name" pattern="[a-zA-Z][a-zA-Z ]{5,}" required>
                        <label class="text-secondary" for="floatingInput">Recipient's Name</label>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field with valid input.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="floatingInput" placeholder="Phone Number" name="recipientPhone" pattern="^(\+?6?01)[0-46-9]-*[0-9]{7,8}$" required>
                        <label class="text-secondary" for="floatingInput">Phone Number 01xxxxxxxx/+x</label>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field with valid input.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Recipient address" id="floatingTextarea2" name="recipientAddress" style="height: 100px" required ></textarea>
                        <label class="text-secondary" for="floatingTextarea2">Address</label>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field with valid input.</div>
                    </div>
                </div>
                <br><br>
                <div class="bg-white flex-container-column" style="width:100%;">
                    <div class="display-5">PRODUCT ORDERED</div>
                    <br>
                    <div class="flex-container-column" style="width:90%">
                        <table class="table table-hover h5">
                            <thead class="table-light">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Unit Price (RM)</th>
                                    <th>Quantity</th>
                                    <th>Item Subtotal (RM)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                while ($data = mysqli_fetch_array($sql)) {
                                    $cartID = $data["CartID"];
                                    $price = $data["Price"];
                                    $qty = $data["Quantity"];
                                    $subtotal = $price * $qty;
                                    $subtotal = number_format($subtotal,2);
                                    $total += $subtotal;
                                    $cartData ='<tr>
                                        <td>
                                            <div class="flex-container-row mt-1 mb-1 w-100" style="justify-content:start; align-items:start;">
                                                <div class="w-30">
                                                    <img src="'.$data["ProductPicture"].'" alt="indian treadfin" style="width:150px; height: 150px; border-radius:20px;">
                                                </div>
                                                <div class="w-70 ms-3">
                                                    '.$data["ProductName"].' <br><br>                                    
                                                    <img src="image/shop_icon.png" alt="shop_icon" style="width:20px;height:20px;">
                                                    '.$data["ShopName"].'
                                                </div>    
                                            </div>
                                        </td>
                                        <td>'.$price.'</td>
                                        <td>'.$qty.'</td>
                                        <td>'.$subtotal.'</td>
                                    </tr>';
                                    echo $cartData;
                                }
                                ?>                            
                                
                            </tbody>
                            <tfoot class="table-dark">
                                <td colspan="2">Shipping Fee: RM10</td>
                                <td>Total Change:</td>
                                <td> RM<?php echo $totalPrice = number_format($total+10,2); //add shipping fee?></td>
                            </tfoot>
                        </table>
                    </div>
                    <div class="display-5">PAYMENT METHOD</div><br>
                    <div class="display-6">CREDIT / DEBIT CARD</div><br>
                </div>
                <div style="width:80%">
                <br>
                    <div class="form-floating mb-3">
                        <input type="hidden" name="CartID" value="<?php echo $cartID;?>">
                        <input type="hidden" name="totalPrice" value="<?php echo $totalPrice;?>">
                        <input type="text" placeholder="Name on Card" class="form-control" id="name-on-card" pattern="[a-zA-Z][a-zA-Z ]{5,}" required>
                        <label for="floatingInput">Name on Card</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="tel" placeholder="Card Number" class="form-control" id="card-number" pattern="[0-9]{13,16}" required>
                        <label for="floatingInput">Card Number</label>
                    </div>
                    <div class="flex-container-row">
                        <div style="width:50%;">
                            <label>Expiration Date</label><br>
                            <select class="form-select" required>
                                <option value="" selected disabled>Month</option>
                                <option value="01">January</option>
                                <option value="02">February </option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid month.
                            </div>
                            <br>
                        </div>
                        <div style="width:50%;">
                            <br>
                            <select class="form-select" required>
                                <option value="" selected disabled>Year</option>
                                <option value="16"> 2016</option>
                                <option value="17"> 2017</option>
                                <option value="18"> 2018</option>
                                <option value="19"> 2019</option>
                                <option value="20"> 2020</option>
                                <option value="21"> 2021</option>
                                <option value="22"> 2022</option>
                                <option value="23"> 2023</option>
                                <option value="24"> 2024</option>

                            </select>
                            <div class="invalid-feedback">
                                Please select a valid year.
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="form-floating mb-3 w-20">
                        <input type="tel" pattern="\d*" maxlength="4" placeholder="CVC" class="form-control" id="cvv" required>
                        <label for="floatingInput">CVV</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="billing address" placeholder="Billing Address" style="height:100px;" required></textarea>
                        <label for="floatingInput">Billing Address</label>
                    </div>

                    <div class="form-group justify-center" id="credit_cards">
                        <img src="image/visa.jpg" id="visa">
                        <img src="image/mastercard.jpg" id="mastercard">
                        <img src="image/amex.jpg" id="amex">
                    </div>
                </div>
            </form>

            <br><br>
            <div class="flex-container-row some-padding">
                <a href="cartPage.php"><button type="button" class="btn btn-secondary btn-lg">Edit Cart</button></a>
                <div style="margin-right:30px;"></div>
                <button class="btn btn-primary btn-lg" form="form1" type="submit">Place Order</button>
            </div>
            <script>
                const insertOrderForm = document.getElementById("form1");
                insertOrderForm.addEventListener("submit",function(event){
                    event.preventDefault();//dont allow refresh
                    
                    // take value and name from the form, and turn it into js object (json)
                    const formData = Object.fromEntries(new FormData(event.target).entries());

                    // 'fetch api' to send data to insertcart.php
                    fetch("insertOrder.php", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formData) //pass the formData, turn json into string (can't submit object, php can't read)
                    })
                    .then(function(res){ //wait the result come back
                        return res.json()  //get response value, return to next .then
                    })
                    .then(function(response){
                        // console.log(response)
                        // Check if got error, and display a nice alert box.
                        if(!response.error){
                        Swal.fire({
                            title: "Completed",
                            icon: "success",
                            text: "Purchase successfully"
                        }).then(function(){
                            window.location.href = "cartPage.php";
                            });
                        } 
                        else {
                        Swal.fire({
                            title: "Oops...Purchase failed.",
                            icon: "error",
                            text: response.error
                        }) 
                        }
                    });
                });
            </script>
        </div>
        <?php require "footer.php";?>
    </body>
</html>