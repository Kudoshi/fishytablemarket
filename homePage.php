<?php require "resources/conn.php"; require "resources/basic_utility.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "import_headInfo.php"; ?>
    <link rel="stylesheet" href="css/ml_css.css">
    <script src="js/ml_js.js"></script>
    <title>Fishytable | Home Page</title>
</head>
<body>
  <?php require "header.php"; 
  // Fetch products + seller
  $result_product = mysqli_query($con, "SELECT * FROM product INNER JOIN seller ON product.SellerID = seller.SellerID");
  // Fetch subcategory data
  $subcategory = mysqli_query($con, "SELECT * FROM subcategory");
  // $data_sub = mysqli_fetch_array($subcategory);
  ?>

  <div id="home" class="flex-container-column">
    <div class="flex-container-column" style="width:100%">
      <div style="padding:25px;">
        <img src="image/Original_Fishtable_Logo.png" alt="FishyTable Logo" width="200px" height="200px">
      </div>
      <div>
        <h1>Fishytable Market</h1>
      </div>
      <div>
        <h1><b>We bring the market to your home.</b></h1>
        <br>
      </div>
    </div>
    <!-- Carousel -->
    <div class="flex-container-column" id="content-main" style="width:100%">
      <div id="carousel1" class="carousel carousel" data-bs-ride="carousel" style="width:100%;height:500px;">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carousel1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carousel1" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carousel1" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="10000">
            <img src="image/hpage_1" class="d-block w-100" alt="Organic pic" style="width:90%;height:500px;">
            <div class="carousel-caption d-none d-md-block">
              <h5>100% Fresh Organic Products</h5>
              <p>Over hundred local Organic Seller.</p>
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <img src="image/hpage_2" class="d-block w-100" alt="Fishery pic" style="width:90%;height:500px;">
            <div class="carousel-caption d-none d-md-block">
              <h5>100% Fresh Fishery Products</h5>
              <p>Over hundred local Fishery Seller.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="image/hpage_3" class="d-block w-100" alt="Some pic" style="width:90%;height:500px;">
            <div class="carousel-caption d-none d-md-block">
              <h5>We are FishyTable Market</h5>
              <p>A wonderful place to buy / sell your organic & fishery goods.</p>
            </div>
          </div>
        </div>
      
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel1" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel1" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
      <br>

      
      <!-- Category -->
      <div style="text-align:center;">
        <h2>CATEGORY</h2>
      </div>
      <div class="flex-container-row">
        <div class="flex-container-column some-padding">
          <div class="container-cate">
            <div class="cate-effect" onclick="category('organic')">
              <img src="image/organic_main.jpg" alt="Organic Product" width="400px" class="img-style">
              <div class="middle">
                <div class="text">ORGANIC</div>
              </div>
              <h3 style="text-align:center;">ORGANIC</h3>
            </div>
          </div>        
        </div>

        <div class="flex-container-column some-padding">
          <div class="container-cate">
            <div class="cate-effect" onclick="category('fishery')">
              <img src="image/fishery_main.jpg" alt="Fishery Product" width="400px" class="img-style">
              <div class="middle">
                <div class="text">FISHERY</div>
              </div>
              <h3 style="text-align:center;">FISHERY</h3>
            </div>
          </div>
        </div> 
      </div>
    </div>

    <!-- Organic subcate content -->
    <div id="organic">
      <div class="flex-container-column">
        <div><h2>ORGANIC PRODUCTS</h2></div>
        <!-- Organic Vege, Fruit, Mushroom, Bean & Nut, Chicken -->
      </div>
      <div class="flex-container-row">
        <div class="flex-container-column some-padding">
          <div class="cate-effect" onclick="window.location='sub_category.php?id=VEG';">
            <div class="zoomIn">
              <img src="image/vege.jpg" alt="Sub-Organic">
            </div>
            <h3 style="text-align:center;">Vegetable</h3>
          </div>
        </div>
        <div class="flex-container-column some-padding">
          <div class="cate-effect" onclick="window.location='sub_category.php?id=FRU';">
            <div class="zoomIn">
              <img src="image/fruit.jpg" alt="Sub-Organic">
            </div>
            <h3 style="text-align:center;">Fruit</h3>
          </div>
        </div>
      </div>
      <div class="flex-container-row">
        <div class="flex-container-column some-padding">
          <div class="cate-effect" onclick="window.location='sub_category.php?id=MUS';">
            <div class="zoomIn">
              <img src="image/mushroom.jpg" alt="Sub-Organic">
            </div>
            <h3 style="text-align:center;">Mushroom</h3>
          </div>
        </div>
        <div class="flex-container-column some-padding">
          <div class="cate-effect" onclick="window.location='sub_category.php?id=BEA';">
            <div class="zoomIn">
              <img src="image/bean.jpg" alt="Sub-Organic">
            </div>
            <h3 style="text-align:center;">Bean & Nut</h3>
          </div>
        </div>
        <div class="flex-container-column some-padding">
          <div class="cate-effect" onclick="window.location='sub_category.php?id=MEA';">
            <div class="zoomIn">
              <img src="image/chicken.jpg" alt="Sub-Organic">
            </div>
            <h3 style="text-align:center;">Meat</h3>
          </div>
        </div>
        
      </div>
    </div>

    <!-- Fishery subcate content -->
    <div id="fishery">
      <div class="flex-container-column">
        <div><h2>FISHERY PRODUCTS</h2></div>
      </div>
      <div class="flex-container-row">
        <!-- Fish, Prawn, Squid & Octopus, Shell Fish, Lobster & Crab -->
        <div class="flex-container-column some-padding">
          <div class="cate-effect" onclick="window.location='sub_category.php?id=FIS';">
            <div class="zoomIn">
              <img src="image/fish.jpg" alt="Sub-Fishery">
            </div>
            <h3 style="text-align:center;">Fish</h3>
          </div>
        </div>
        <div class="flex-container-column some-padding">
          <div class="cate-effect" onclick="window.location='sub_category.php?id=PRN';">
            <div class="zoomIn">
              <img src="image/prawn.jpg" alt="Sub-Fishery">
            </div>
            <h3 style="text-align:center;">Prawn</h3>
          </div>
        </div>
      </div>
      <div class="flex-container-row">
        <div class="flex-container-column some-padding">
          <div class="cate-effect" onclick="window.location='sub_category.php?id=OCT';">
            <div class="zoomIn">
              <img src="image/squid&octopus.jpg" alt="Sub-Fishery">
            </div>
            <h3 style="text-align:center;">Squid & Octopus</h3>
          </div>
        </div>
        <div class="flex-container-column some-padding">
          <div class="cate-effect" onclick="window.location='sub_category.php?id=SHL';">
            <div class="zoomIn">
              <img src="image/shellfish.jpg" alt="Sub-Fishery">
            </div>
            <h3 style="text-align:center;">Shell Fish</h3>
          </div>
        </div>
        <div class="flex-container-column some-padding">
          <div class="cate-effect" onclick="window.location='sub_category.php?id=LOB';">
            <div class="zoomIn">
              <img src="image/lobster&crab.jpg" alt="Sub-Fishery">
            </div>
            <h3 style="text-align:center;">Lobster & Crab</h3>
          </div>
        </div>
      </div>
    </div>
    <br>
    <hr>
    <br>
    <div class="flex-container-row">
      <?php
        while ($data = mysqli_fetch_array($result_product)) {
          $item = 
            '<div class="some-padding">
              <div class="card some-padding" style="width:300px; height:500px;">
                <a href="productInfoPage.php?id='.$data["ProductID"].'">
                  <img class="card-img-top" src="'.$data["ProductPicture"].'" alt="Product image" style="width:238px;height:238px;">
                  <div class="card-body">
                    <p class="card-title">'.$data["ProductName"].'</p>
                    <hr style="width: 100%;">
                    <p>['.$data["SellerName"].']</p>
                    <div class="d-flex align-items-center justify-content-between">
                      <h4 class="card-text"> RM'.$data["Price"].'</h4>
                      <span class="fs-4 px-3 py-3 '.print_categoryIcon($con, $data["SubCategoryID"]).'"></span>
                    </div>
                  </div>
                </a>
              </div>
            </div><br>';
          echo $item;
        }
      ?>
    </div>
    <br><br>
  </div>

  <?php
    if (isset($_GET['type'])) {
      if ($_GET['type'] == "organic") {
        echo '<script>category("organic");</script>';
      }
      else if ($_GET['type'] == "fishery") {
        echo '<script>category("fishery");</script>';
      }
    }
  ?>

  <?php require "footer.php";?>

</body>
</html>