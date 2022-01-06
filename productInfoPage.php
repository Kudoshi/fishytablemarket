<?php 
  require "resources/conn.php";
  $id = intval($_GET['id']);

  // Fetch product + seller data that ONLY MATCH the product's ID
  $result_product = mysqli_query($con, "SELECT * FROM product INNER JOIN seller ON product.SellerID = seller.SellerID WHERE product.ProductID=$id");
  $data = mysqli_fetch_array($result_product);

  // Fetch customer rating individually, that ONLY MATCH the product's ID. Fetch 2 times, 2nd time is to enable it to be used in while loop
  $result_rating = mysqli_query($con, "SELECT * FROM rating INNER JOIN customer ON rating.CustID = customer.CustID WHERE ProductID = $id");
  $result_rating2 = mysqli_query($con, "SELECT * FROM rating INNER JOIN customer ON rating.CustID = customer.CustID WHERE ProductID = $id");
  $data2 = mysqli_fetch_array($result_rating);

  // Get the number of ratings that the products possess
  $numOfRating = mysqli_num_rows($result_rating);

  // A function that convert rating value into stars
  function fafaStar($type_of_rating, $size, $row) {
    $rating = intval($row[$type_of_rating]);

    for ($i = 0; $i < $rating; $i++) {
      echo '<span class="fa fa-star checked '.$size.'"></span>';
    }

    $uncheck = '<span class="fa fa-star '.$size.'"></span>';
    
    if ($rating == 0) {
      for ($i=0; $i < 5; $i++) {
        echo $uncheck;
      }
    }
    elseif($rating == 1){
      for ($i = 0; $i < 4; $i++) {
        echo $uncheck;
      }
    }
    elseif ($rating == 2){
      for ($i = 0; $i < 3; $i++) {
        echo $uncheck;
      }
    }
    elseif ($rating == 3){
      for ($i = 0; $i < 2; $i++) {
        echo $uncheck;
      }
    }
    elseif ($rating == 4){
        echo $uncheck;
    }
  }

?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "import_headInfo.php"; ?>
    <link rel="stylesheet" href="css/ml_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Fishytable | Product Information Page</title>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
</head>
<body>
<?php require "header.php";?>

<!-- Content -->
<div class="flex-container-row bg-color-blue-3">
  <div class="main-product-img mt-2" style="width:30%;">
      <img src="<?php echo $data["ProductPicture"];?>" alt="Product_Pic" style="width:500px;height:500px;">
  </div>
  <div class="flex-container-column p-4 ms-4" style="width:800px;">
    <?php echo '<div class="mt-3"><h4>'.$data["ShopName"].' | <b>'.$data["ProductName"].'</b></h4><br></div>';?>
    <div class="flex-container-row product-info mt-4 mb-5 text-dark" style="border:3px solid black;">
      <div class="flex-container-column some-margin">
        <div>
          <h5><b>RM <?php echo $data["Price"];?></b></h5>
        </div>
        <div class="flex-container-row">
          <div>
            <?php fafaStar("ProductRating","fa-1x",$data);?>
          </div>
          <div style="margin-left:10px;"><h5> <?php echo $data["ProductRating"];?> / 5 </h5></div>
        </div>
        <br>
        <div><?php echo $numOfRating;?> Rating/+s</div>
      </div>
      <div class="vl"></div>
      <div class="flex-container-column some-margin">
        <div>
          <table cellspacing="1" cellpadding="3">
            <tr>
              <td><b>Shipping Method</b></td>
              <td>:</td>
              <td><?php echo $data["ShippingMethod"];?></td>
            </tr>
            <tr>
              <!-- Fixed part -->
              <td><b>Shipping Fee</b></td>
              <td>:</td>
              <td>RM 10</td>
            </tr>
            <tr>
              <td><b>Weight (g)</b></td>
              <td>:</td>
              <td><?php echo $data["Weight"];?>g</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div class="flex-container-row" style="margin-bottom:30px;">
      <div class="flex-container-row">
        <?php
        if (isset($_SESSION["CustID"])) {
          echo 
          '<form id="add-to-cart" class="was-validated">
            <div class="quantity mt-5 mb-5" style="margin-top:8px;">
              <label class="me-3 mt-2" style="align-items:center;"><h3>Quantity:</h3></label>
              <button type="button" class="btn btn-primary minus-btn" style="width:37px">-</button>
              <input min="1" name="quantity" value="1" pattern="[0-9]{1,}">
              <button  type="button" class="btn btn-primary plus-btn" style="width:37px">+</button>
              <input type="hidden" value="'.$id.'" name="productID">
              <button type="submit" class="btn btn-secondary ms-4"><h5>Add to Cart</h5></button>
            </div>
        </form>';
        }
        else {
          echo '<div class="quantity mt-5 mb-5" style="margin-top:8px;" class="was-validated">
          <label class="me-3 mt-2" style="align-items:center;"><h3>Quantity:</h3></label>
          <button type="button" class="btn btn-primary minus-btn" style="width:37px">-</button>
          <input min="1" name="quantity" value="1" pattern="[0-9]{1,}">
          <button  type="button" class="btn btn-primary plus-btn" style="width:37px">+</button></div>
          <a href="customer_login.php" class="btn btn-secondary ms-4">Login Before Purchase :)</a>';
        }
          
        ?>
        <script>
          // Using JSON, fetch & then to handle the front end
          const addToCartForm = document.querySelector("#add-to-cart");
          addToCartForm.addEventListener("submit",function(event){
            event.preventDefault();//dont allow refresh
            
            // take value and name from the form, and turn it into js object (json)
            const formData = Object.fromEntries(new FormData(event.target).entries());

            // 'fetch api' to send data to insertcart.php
            fetch("insertCart.php", {
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
                    text: "Added to cart"
                  })

                  let cartQty = document.querySelector("#cartQty");
                  if(!cartQty){
                    cartQty = document.createElement('span');
                    cartQty.id = "cartQty";
                    cartQty.setAttribute("class", "position-absolute top-0 start-100 translate-middle badge bg-warning rounded-pill text-dark");
                    document.querySelector("#cartLink").append(cartQty);
                  }
                  cartQty.innerText = response.cartQty;
                  // notes: below will causes performance slower as this is another request
                  // var xmlhttp = new XMLHttpRequest();
                  // xmlhttp.onreadystatechange = function() {
                  //   if (this.readyState == 4 && this.status == 200) {
                  //       document.getElementById("cartIcon").innerHTML = this.responseText;
                  //   }
                  // }
                  // xmlhttp.open("GET" , "cartIcon.php");
                  // xmlhttp.send();
                } 
                else {
                  Swal.fire({
                    title: "Oops...",
                    icon: "error",
                    text: response.error
                  }) 
                }
              })
          });
        </script>
      </div>
    </div>
  </div>
</div>
<div class="flex-container-column">
  <div class="flex-container-column w-100 bg-color-white-1">
    <div class="some-margin">
      <h2>Product Specification</h2>
    </div>
    <div class="product-info bg-color-white-2" style="width:80%; height:auto;">
      <p style="padding:40px; " class="h-auto">
        <?php echo $data["ProductSpecification"];?>
      </p>
    </div>
    <div class="flex-container-row" style="width:80%; margin-bottom:10px;">
      <div>
        <img src="<?php echo $data["SellerPhoto"];?>" alt="profile picture" class="rounded-circle" width="50px" height="50px">
      </div>
      <div> 
        <h5 style="padding:5px; margin-right:50px;">@ <?php echo $data["ShopName"];?></h5>
      </div>
      <div class="vl" style="height:30px;"></div>
      <div class="some-padding" style="padding-right:0px;"><h4>Shop Ratings</h4></div>
      <div class="some-margin">
      <?php fafaStar("SellerRating","fa-3x",$data);?>
      </div>
      <h4> <?php echo $data["SellerRating"];?> / 5 </h4>
      <div class="btn">
        <a href="seller_profile.php?SellerID=<?php echo $data['SellerID'];?>" class="btn btn-warning"><h5>View Shop</h5></a>
      </div>
    </div>
  </div>
  <!-- background-color: rgba(4, 119, 4, 0.312); -->
  <div class="flex-container-column w-100 bg-color-blue-3" style=" width:100%;">
    <div class="some-margin">
      <h2 class="some-white-some">Reviews</h2>
    </div>
    <div class="flex-container-row">
      <div style="margin:20px; margin-top:0px;">
      <?php fafaStar("ProductRating","fa-3x",$data);?>
        <br> 
      </div>
      <div><h4> <?php echo $data["ProductRating"];?> / 5 </h4></div>
    </div>
    <!-- Comment Part -->
    <?php
      while ($data3 = mysqli_fetch_array($result_rating2)) {
        $review = 
        '<div class="some-padding review-comment no-center-div-row " style="height:auto;">
          <div class="flex-container-column" style="margin-right:70px;">
            <div>
              <h5>'.$data3["CustName"].'</h5>
            </div>
            <div class="flex-container-row">
              <div style="margin:10px;">';
        echo $review;
                fafaStar("Rating","fa-1x", $data2);
        $review2 = '<br>
              </div>
              <div><h5> '.$data3["Rating"].' / 5 </h5></div>
            </div>
          </div>
          <div class="vl"></div>
          <div class="no-center-div-col" style="padding: 20px;">
            <div><h4>'.$data3["FeedbackHeader"].' </h4></div>
            <div><p>'.$data3["Feedback"].'</p></div>
          </div>
        </div>';
        echo $review2;
      }
    ?>
  <br>
  </div>
</div>



  <!-- <script src="js/ml_js.js"></script> -->
  <?php require "footer.php";?>
  <script>
    // // PLUS & MINUS Button
    // // ----------------------
    // // cite: https://www.youtube.com/watch?v=2purijiQrf4
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
              if (inputValue == "") {
                inputValue = 0;
              }
            var newValue = parseInt(inputValue)+1;
                // console.log(newValue);

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
                if (inputValue == "") {
                inputValue = 0;
              }
            // set condition to prevent quantity become negative
            // if (inputValue <= 1) {
            //     input.setAttribute("disabled","disabled");
            // }
            // else 
            if (inputValue > 1) {
                var newValue = parseInt(inputValue)-1;
                    // console.log(newValue);

                input.value = newValue;
            }
        })
    }
  </script>
</body>
</html>