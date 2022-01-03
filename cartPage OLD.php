<?php require "resources/conn.php";
$sql = mysqli_query($con, "SELECT * FROM (((productcartlist INNER JOIN cart ON productcartlist.CartID = cart.CartID) INNER JOIN product ON productcartlist.ProductID =product.ProductID) INNER JOIN seller ON product.SellerID = seller.SellerID) INNER JOIN customer ON cart.CustID = customer.CustID WHERE cart.CustID = ".$_SESSION['CustID']." AND cart.CartPaid = 0");
// $sql = mysqli_query($con, "SELECT * FROM (((productcartlist INNER JOIN cart ON productcartlist.CartID = cart.CartID) INNER JOIN product ON productcartlist.ProductID =product.ProductID) INNER JOIN seller ON product.SellerID = seller.SellerID) INNER JOIN customer ON cart.CustID = customer.CustID WHERE cart.CustID = 3");
$numOfCart = mysqli_num_rows($sql);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Fishytable | Cart Page</title>        
        <link rel="stylesheet" href="css/ml_css">
        <?php require "import_headInfo.php"; ?>
    </head>
    <body>
        <?php require "header.php"; ?>
        <!-- Content -->
        <div class="right-side-title">
            <h1 class="title-text">FishyTable Market | Cart</h1>
        </div>
        <br><br>
        <div class="flex-container-column">
        <!-- Cart content -->
        <?php 
            
            while ($data = mysqli_fetch_array($sql)) {
                $i = 0;
                $cartData = '
                    <div class="flex-container-row" style="background-color:rgba(113, 255, 255, 0.204); width:70%; border-radius:10px;">
                        <!-- image -->
                        <div class="card some-margin border-dark" style="width:300px; height: auto;">
                            <a href="productInfoPage.php?id='.$data["ProductID"].'">
                                <img class="card-img-top" src="'.$data["ProductPicture"].'" alt="Product image" style="width:100%">
                                <div class="card-body">
                                    <h4 class="card-title text-center">'.$data["ProductName"].'</h4>
                                </div>
                            </a>
                        </div>
                        <!-- detail -->
                        <div class="flex-container-column box" style="width: 600px;">
                            <input type="hidden" value="'.$data["ProductCartListID"].'">
                            <div class="shop-title mb-5" style="text-align:center; padding:20px;">
                                <h4>Shop: '.$data["ShopName"].'</h4>
                            </div>
                            <div class="mb-2" style="margin-top:10px;">
                                <h2>PRICE: RM <span>'.$data["Price"].'</span></h2>
                            </div>
                            <div class="quantity mb-5" style="margin-top:8px;">
                                <label class="me-3"><h3>Quantity:</h3></label>
                                <button type="button" class="btn btn-primary minus-btn" style="width:37px">-</button> 
                                <input type="number" value="'.$data["Quantity"].'" min="1">
                                <button  type="button" class="btn btn-primary plus-btn" style="width:37px">+</button>
                            </div>
                            <div class="flex-container-row justify-content-between mb-4">    
                                <div>
                                    <a href="delete.php?id="'.$data["CartID"].'" onclick="return confirm(\'Delete '.$data['ProductName'].' record?\') ;">
                                        <img src="image/lapsap_icon.png" alt="delete_icon" class="btn-img-icon ms-5">
                                    </a>
                                </div>
                                 
                                <div>
                                    <input type="checkbox" class="form-check-input" name="check" id="SelectItem" value="SelectItem" style="width:30px; height:30px;">
                                </div>
                            </div>
                        </div>
                    </div> 
                    <br>
                    <hr>
                    <br>
                    ';
                echo $cartData;
                $i++;
            }
        ?>
        </div>
            <br>
            <br>
        <div class="flex-container-column some-margin">
            <div><h4 style="color:grey">Find More?</h4></div>
            <div><a href="homePage.php"><h3>Let's Shopping!</h3></a></div>
        </div>
            <br>
            <br>

        <!-- "buy now" div (fixed-bottom) -->
        <div class="no-center-div-row fixed-bottom some-padding bg-dark text-white" style="width:100%; background-color:white;">
            <div class="flex-container-row" style="width:30%;">
                <div><input type="checkbox" class="form-check-input" id="check-all" value="Select All" onclick="selectAll(this)" style="width:30px; height:30px;"></div>
                <div style="margin-right:20px;"></div>
                <div style="margin-top:5px;"><label class="form-check-label" for="check-all"><h4>Select All</h4></label></div>
            </div>
            <div style="width:35%;"></div>
            <div style="margin-top:10px; width:20%">
                <h4>TOTAL:  RM <h3 id="total_price"></h3></h4>
            </div>

            <div style="margin-top:5px; width:15%;">
                <button type="button" class="btn btn-warning"><h5>BUY NOW</h5></button>
            </div>
        </div>
        <script src="js/ml_js.js"></script>
        <?php require "footer.php";?>
        <script>
            // PLUS & MINUS Button
            // ----------------------
            // cite: https://www.youtube.com/watch?v=2purijiQrf4
            var plusButton = document.getElementsByClassName('plus-btn');
            var minusButton = document.getElementsByClassName('minus-btn');
                // console.log(plusButton, minusButton)

            for (var i = 0; i < plusButton.length; i++) {
                var button = plusButton[i];
                button.addEventListener('click', function(event) {
                    var buttonClicked = event.target;
                        // console.log(buttonClicked);
                    var input = buttonClicked.parentElement.children[2];
                        // console.log(input); 
                    var inputValue = input.value;
                        // console.log(inputValue);
                    var newValue = parseInt(inputValue)+1;
                        // console.log(newValue);

                    // Getting productcartlist ID
                    var findID = buttonClicked.parentElement.parentElement.children[0].value;
                        console.log(findID);
                    //update quantity into database and show it
                    updateQty(newValue,findID);
                    input.value = newValue;
                })
            }

            for (var i = 0; i < minusButton.length; i++) {
                var button = minusButton[i];
                button.addEventListener('click', function(event) {
                    var buttonClicked = event.target;
                        // console.log(buttonClicked);
                    var input = buttonClicked.parentElement.children[2];
                        // console.log(input);
                    var inputValue = input.value;
                        // console.log(inputValue);

                    // set condition to prevent quantity become negative
                    if (inputValue <= 1) {
                        input.setAttribute("disabled","disabled");
                    }
                    else if (inputValue > 1) {
                        var newValue = parseInt(inputValue)-1;
                            // console.log(newValue);

                        // Getting productcartlist ID
                        var findID = buttonClicked.parentElement.parentElement.children[0].value;
                        console.log(findID);

                        //update quantity into database and show it
                        updateQty(newValue,findID);
                        input.value = newValue;
                    }
                })
            }

            function updateQty(newValue, idValue) {
                var xmlhttp = new XMLHttpRequest(); //no need refresh entire page, only a part

                // xmlhttp.onreadystatechange = function() {
                //     if (this.readyState == 4 && this.status == 200) {
                        
                //     }
                // }

                xmlhttp.open("GET", "updateQty.php?quantity=" + newValue + "&id=" + idValue, true);
                xmlhttp.send();
            }
        </script>
    </body>
</html>