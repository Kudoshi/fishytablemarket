<?php require "resources/conn.php";
$sql = "SELECT * FROM (((productcartlist INNER JOIN cart ON productcartlist.CartID = cart.CartID) INNER JOIN product ON productcartlist.ProductID =product.ProductID) INNER JOIN seller ON product.SellerID = seller.SellerID) INNER JOIN customer ON cart.CustID = customer.CustID WHERE cart.CustID = ".$_SESSION['CustID']."";
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
        <!-- 1st cart content -->
        <div class="flex-container-column">
            <div class="flex-container-row" style="background-color:rgba(113, 255, 255, 0.204); width:70%;">
                <!-- image -->
                <div class="card some-margin border-dark" style="width:300px; height: auto;">
                    <a href="">
                        <img class="card-img-top" src="image/wangleisellshrimp.jpg" alt="Shirmp image" style="width:100%">
                        <div class="card-body">
                            <h4 class="card-title text-center">200g Wang Shrimp</h4>
                        </div>
                    </a>
                </div>
                <!-- detail -->
                <div class="flex-container-column box" style="width: 600px;">
                    <div class="shop-title mb-5" style="text-align:center; padding:20px;">
                        <h4>Shop: @Wong_Lei</h4>
                    </div>
                    <div class="mb-2" style="margin-top:10px;">
                        <h2>PRICE: RM <span>16.90</span></h2>
                    </div>
                    <div class="quantity mb-5" style="margin-top:8px;">
                        <label class="me-3"><h3>Quantity:</h3></label>
                        <!-- Do onclick call function activate ajax function? -->
                        <button type="button" class="btn btn-primary minus-btn" style="width:37px">-</button> 
                        <input type="number" value="1" min="1">
                        <button  type="button" class="btn btn-primary plus-btn" style="width:37px">+</button>
                    </div>
                    <div class="flex-container-row right-side-btn mb-4">    
                        <div>
                            <button type="button" class="btn">
                                <img src="image/lapsap_icon.png" alt="delete_icon" class="btn-img-icon">
                            </button>
                        </div>
                        <div>
                            <input type="checkbox" class="form-check-input" name="check" id="" value="" style="width:30px; height:30px;">
                        </div>
                    </div>
                </div>
            </div> 
            <br>
            <hr>
            <br>
            <!-- 2nd cart -->
            <div class="flex-container-row" style="background-color:rgba(113, 255, 255, 0.204); width:70%; border-radius:10px;">
                <!-- item name + photo -->
                <div class="card some-margin border-dark" style="width:300px; height:auto;">
                    <a href="">
                        <img class="card-img-top" src="image/indian_treadfin.jpg" alt="Treadfin image" style="width:100%">
                        <div class="card-body">
                            <h4 class="card-title">Indian Threadfin 500g - 100% fresh organic</h4>
                        </div>
                    </a>
                </div>
                <!-- detail -->
                <div class="flex-container-column" style="width:600px;">
                <div class="shop-title mb-5" style="text-align:center; padding:20px;">
                    <h4>Shop: @UncleBigFish_FM</h4>
                </div>
                    <div class="mb-2" style="margin-top:10px;">
                        <h2>PRICE: RM 39.00</h2>
                    </div>
                    <div class="quantity mb-5" style="margin-top:8px;">
                        <label class="me-3"><h3>Quantity:</h3></label>
                        <button type="button" class="btn btn-primary minus-btn" style="width:37px">-</button>
                        <input type="number" value="1" min="1">
                        <button  type="button" class="btn btn-primary plus-btn" style="width:37px">+</button>
                    </div>
                    <div class="flex-container-row right-side-btn mb-4">
                        <div>
                            <button type="button" class="btn">
                                <img src="image/lapsap_icon.png" alt="delete_icon" class="btn-img-icon">
                            </button>
                        </div>
                        <div>
                            <input type="checkbox" class="form-check-input" name="check" id="" value="" style="width:30px; height:30px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <br>
            <br>
        <div class="flex-container-column some-margin">
            <div><h4 style="color:grey">Find More?</h4></div>
            <div><a href="homePage.php"><h3>Let's Shopping!</h3></a></div>
        </div>
            <br>
            <br>

        <!-- buy now div (fixed-bottom) -->
        <div class="no-center-div-row fixed-bottom some-padding bg-dark text-white" style="width:100%; background-color:white;">
            <div class="flex-container-row" style="width:30%;">
                <div><input type="checkbox" class="form-check-input" id="check-all" value="Select All" onclick="selectAll(this)" style="width:30px; height:30px;"></div>
                <div style="margin-right:20px;"></div>
                <div style="margin-top:5px;"><label class="form-check-label" for="check-all"><h4>Select All</h4></label></div>
            </div>
            <div style="width:35%;"></div>
            <div style="margin-top:10px; width:20%">
                <h4 >TOTAL:  RM <h3 id="total_price"></h3></h4>
            </div>

            <div style="margin-top:5px; width:15%;">
                <button type="button" class="btn btn-warning"><h5>BUY NOW</h5></button>
            </div>
        </div>
        <script src="js/ml_js.js"></script>
        <?php require "footer.php";?>
    </body>
</html>