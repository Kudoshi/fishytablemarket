<?php require "resources/conn.php";
if (!isset($_SESSION["CustID"])) {
    die("Please login before you access.");
}
$sql = mysqli_query($con, "SELECT * FROM (((productcartlist INNER JOIN cart ON productcartlist.CartID = cart.CartID) INNER JOIN product ON productcartlist.ProductID =product.ProductID) INNER JOIN seller ON product.SellerID = seller.SellerID) INNER JOIN customer ON cart.CustID = customer.CustID WHERE cart.CustID = ".$_SESSION['CustID']." AND cart.CartPaid = 0");
// $numOfCart = mysqli_num_rows($sql);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Fishytable | Cart Page</title>        
        <link rel="stylesheet" href="css/ml_css">
        <?php require "import_headInfo.php"; ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
            //temp
            $cartID = 0;
            // Using WHILE LOOP to print every cartlist
            while ($data = mysqli_fetch_array($sql)) {
                $cartID = $data["CartID"];
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
                                <input type="number" value="'.$data["Quantity"].'" min="1" disabled>
                                <button  type="button" class="btn btn-primary plus-btn" style="width:37px">+</button>
                            </div>
                            <div class="flex-container-row justify-content-end mb-4">    
                                <form class="delete-item">
                                    <input type="hidden" name="productID" value="'.$data["ProductCartListID"].'">
                                    <button type="submit" class="btn-light">DELETE<img src="image/lapsap_icon.png" alt="delete_icon" class="btn-img-icon ms-5" title="Delete this item?" data-bs-toggle="popover" data-bs-trigger="hover"></button>
                                </form>
                            </div>
                        </div>
                    </div> 
                    <br>
                    <hr>
                    <br>
                    ';
                    
                    // <a href = "" class="deleteBtn" id="'.$data["ProductID"].'">
                    //     <img src="image/lapsap_icon.png" alt="delete_icon" class="btn-img-icon ms-5" title="Delete this item?" data-bs-toggle="popover" data-bs-trigger="hover">
                    // </a>
                    
                echo $cartData;
            }
        ?>

        <script>
            function deleteCart(event) {
                event.preventDefault();//dont allow refresh
            
                // take value and name from the form, and turn it into js object (json)
                const formData = Object.fromEntries(new FormData(event.target).entries());
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you wanna delete the selected item?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((result) => {
                    if (!result.isConfirmed) {
                        return;
                    }
                    // 'fetch api' to send data to insertcart.php
                    fetch("deleteCart.php", {
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
                                title: "Deleted",
                                icon: "success",
                                text: "The product has been deleted from your cart."
                            })
                            .then(function(){
                                window.location.reload();
                            });
                        } 
                        else {
                            Swal.fire({
                                title: "Oops...Delete action failed.",
                                icon: "error",
                                text: response.error
                            }) 
                        }
                    });

                })
            }
            const deleteCartItems = document.querySelectorAll(".delete-item"); //array
            deleteCartItems.forEach(function(deleteItem){
                deleteItem.addEventListener("submit",deleteCart)
            })
        </script>

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
            <div style="width:3%;"></div>
            <div style="margin-top:10px; width:27%">
                <h4 >TOTAL:  RM <span id="totalPrice"> </span></h4>
            </div>
            <div style="width: 60%"></div>
            <div style="margin-top:5px; width:10%;">
                <a href="checkoutPage.php" type="button" class="btn btn-warning"><h5>BUY NOW</h5></a>
            </div>
        </div>

        <?php require "footer.php";?>
        <script>
            // PLUS & MINUS Button (With update quantity using ajax)
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
                
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        <?php echo 'calculateTotal('.$cartID.')'; ?>
                    }
                }

                xmlhttp.open("GET", "updateQty.php?quantity=" + newValue + "&id=" + idValue, true);
                xmlhttp.send();
            }

            function calculateTotal(cartID) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("totalPrice").innerHTML = this.responseText;
                    }
                }
                xmlhttp.open("GET", "calculateTotal.php?cartID=" + cartID);
                xmlhttp.send();
            }

            <?php echo 'calculateTotal('.$cartID.')'; ?>

        </script>
    </body>
</html>