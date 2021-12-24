<?php require "resources/conn.php";?>
<!DOCTYPE html>
<html>
    <head>
        <title>Fishytable | Checkout Page</title>        
        <link rel="stylesheet" href="css/ml_css">
        <?php require "import_headInfo.php"; ?>
    </head>
    <body>
        <?php require "header.php"; 
        ?>
        
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
            <div class="flex-container-column bg-light text-dark pt-3 pb-3" style="width:90%">
                <div style="width:80%">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Recipient's Name">
                        <label for="floatingInput">Recipient's Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="floatingInput" placeholder="Phone Number">
                        <label for="floatingInput">Phone Number</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Recipient address" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Address</label>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="display-5">PRODUCT ORDERED</div>
            <br>
            <div class="flex-container-col" style="width:90%">
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
                        <tr>
                            <td>
                                <div class="flex-container-row mt-1 mb-1" style="justify-content:start; align-items:start;">
                                    <div>
                                        <img src="image/indian_treadfin.jpg" alt="indian treadfin" style="width:150px; height: 150px;">
                                    </div>
                                    <div style="margin-left:10px;">
                                        200lb CAT FISH <br>                                    
                                        <img src="image/shop_icon.png" alt="shop_icon" class="mt-1">
                                        @UncleBigFish_FM 
                                    </div>    
                                </div>
                            </td>
                            <td>30</td>
                            <td>2</td>
                            <td>60</td>
                        </tr>
                    </tbody>
                    <tfoot class="table-dark">
                        <td colspan="2">Shopping Fee: RM10</td>
                        <td>Total Change:</td>
                        <td>RM 60</td>
                    </tfoot>
                </table>
            </div>
            <div><h3>PAYMENT METHOD</h3></div>
            <br><button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#payment" >CREDIT / DEBIT CARD</button>

            <div class="modal fade" id="payment" tabindex="-1" aria-labelledby="payment" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="payment">CREDIT / DEBIT CARD</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-floating mb-3">
                                    <input type="text" placeholder="Name on Card" class="form-control" id="name-on-card">
                                    <label for="floatingInput">Name on Card</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="tel" pattern="\d*" maxlength="19" placeholder="Card Number" class="form-control" id="card-number">
                                    <label for="floatingInput">Card Number</label>
                                </div>
                                <div class="flex-container-row" style="align-items:flex-start;">
                                    <div class="form-group" id="expiration-date" style="width:50%">
                                        <label>Expiration Date</label><br>
                                        <select style="width:50%;">
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
                                        <select style="width:40%;">
                                            <option value="16"> 2016</option>
                                            <option value="17"> 2017</option>
                                            <option value="18"> 2018</option>
                                            <option value="19"> 2019</option>
                                            <option value="20"> 2020</option>
                                            <option value="21"> 2021</option>
                                        </select>
                                    </div>

                                    <div class="form-floating mb-3" style="width:50%">
                                        <input type="tel" pattern="\d*" maxlength="4" placeholder="CVC" class="form-control" id="cvv">
                                        <label for="floatingInput">CVV</label>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="billing address" placeholder="Billing Address" style="height:100px;"></textarea>
                                    <label for="floatingInput">Billing Address</label>
                                </div>

                                <div class="form-group" id="credit_cards">
                                    <img src="image/visa.jpg" id="visa">
                                    <img src="image/mastercard.jpg" id="mastercard">
                                    <img src="image/amex.jpg" id="amex">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="flex-container-row some-margin">
                <a href="cartPage.php"><button type="button" class="btn btn-secondary btn-lg">Edit Cart</button></a>
                <div style="margin-right:30px;"></div>
                <button type="button" class="btn btn-primary btn-lg">Place Order</button>
            </div>
        </div>
        <?php require "footer.php";?>
    </body>
</html>