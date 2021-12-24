<?php 
  require "resources/conn.php";
  $id = intval($_GET['id']);
  // Fetching product, seller, rating, and customer data that ONLY MATCH the product's ID
  $result_product = mysqli_query($con, "SELECT * FROM product INNER JOIN seller ON product.SellerID = seller.SellerID WHERE product.ProductID=$id");
  $result_rating = mysqli_query($con, "SELECT * FROM rating INNER JOIN customer ON rating.CustID = customer.CustID WHERE ProductID = $id");
  $result_rating2 = mysqli_query($con, "SELECT * FROM rating INNER JOIN customer ON rating.CustID = customer.CustID WHERE ProductID = $id");
  $data = mysqli_fetch_array($result_product);
  $data2 = mysqli_fetch_array($result_rating);
  $numOfRating = mysqli_num_rows($result_rating);
  function fafaStar($type_of_rating, $size, $data) {
    global $data2;
    if ($type_of_rating == "Rating") {
      $rating = intval($data2[$type_of_rating]);
    }

    else {
      $rating = intval($data[$type_of_rating]);
    }

    for ($i = 0; $i < $rating; $i++) {
      echo '<span class="fa fa-star checked '.$size.'"></span>';
    }
    if ($rating == 1){
      for ($i = 0; $i < 4; $i++) {
        echo '<span class="fa fa-star '.$size.'"></span>';
      }
    }
    elseif ($rating == 2){
      for ($i = 0; $i < 3; $i++) {
        echo '<span class="fa fa-star '.$size.'"></span>';
      }
    }
    elseif ($rating == 3){
      for ($i = 0; $i < 2; $i++) {
        echo '<span class="fa fa-star '.$size.'"></span>';
      }
    }
    elseif ($rating == 4){
        echo '<span class="fa fa-star '.$size.'"></span>';
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
</head>
<body>
<?php require "header.php";?>

<!-- Content -->
<div class="flex-container-row bg-color-black-4 text-white">
  <div class="main-product-img" style="some-margin" style="width:30%;">
      <img src="<?php echo $data["ProductPicture"];?>" alt="Product_Pic" >
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
        <!-- need insert into the cart_product and create new cart record for specific customer -->
        <div class="quantity mt-5 mb-5" style="margin-top:8px;">
            <label class="me-3 mt-2" style="align-items:center;"><h3>Quantity:</h3></label>
            <button type="button" class="btn btn-primary minus-btn" style="width:37px">-</button>
            <input type="number" value="1" min="0">
            <button  type="button" class="btn btn-primary plus-btn" style="width:37px">+</button>
        </div>
        <div>
          <button type="button" class="btn btn-secondary ms-4"><h5>Add to Cart</h5></button>
        </div>
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
        <img src="<?php echo $data["SellerPhoto"];?>" alt="profile picture" width="50px" height="50px">
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
        <button type="submit" class="btn btn-warning"><h5>View Shop</h5></button>
      </div>
    </div>
  </div>
  <!-- background-color: rgba(4, 119, 4, 0.312); -->
  <div class="flex-container-column w-100 bg-color-green-3" style=" width:100%;">
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



  <script src="js/ml_js.js"></script>
  <?php require "footer.php";?>
</body>
</html>