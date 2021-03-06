<?php require "resources/conn.php";?>
<!DOCTYPE html>
<html>
    <head>
        <title>Fishytable | About Us</title>        
        <link rel="stylesheet" href="css/ml_css">

        <?php require "import_headInfo.php"; ?>
    </head>
    <body>
        <?php require "header_both.php"; ?>
        <div class="bg-color-blue-2 d-flex align-items-center justify-content-center" style="width:100%;height:100px;">
            <h1 class="text-white ">About Us</h1>
        </div> 
        <div class="flex-container-row mx-auto" style="width:90%">
            <div class="w-35 p-5 d-flex flex-column justify-content-center">
                <div class="mx-auto">
                    <img src="image/Original_Fishtable_Logo.png" alt="FishyTable Logo" style="width:300px; height:300px;">
                </div>
                <br>
                <div class="display-6"> 
                    FisherytableMarket.com
                </div>
                <br>
                <div>
                    <p>
                        No.69, Jalan Fish Table <br>
                        Taman Ming Liang, Kudo <br>
                        69690 Pulau Fish, Sheesh <br>
                    </p>
                </div>
                <br><br>
            </div>
            <div class="w-50 p-5">
                FishytableMarket.com is a wonderful platform that providing opportunity for Malaysia local seller to sells their organic/fishery products. Not only that, this website also wishes to provide people who live in Malaysia to purchase organic/fishery products more easily.
                Founded in 2021, by APU Web Solution Sdn. Bhn.
                <br>
                <br>
                We carry a variety of fish, crab, shrimp, vegies and fruits in stock from Malaysia local lesser.  We are one of the only establishments able to bring you the choicest and healthiest fishes and organic food in Malaysia. 
                <br>
                <br>
                While we provide you with every kinds of fishery and orgaanic food you can possible think of, we also provide good services. Many homes, offices and restaurants boast our custom work, and have advantage of our maintenance service to ensure the best possible environment for their healthy livestyle.
                <br>
                <br>
                Our history of recognized success since our opening in 2021, is proof that we???ll continue to provide the finest selection of fishes and organic good as well as provide friendly and informative customer service.
                <br>
                <br>
                Thank you for visiting FishyTableMarket.com Online Store!
                <br>
            </div>
        </div>
        <div class="w-100">
            <div id="carousel1" class="carousel carousel w-100 h-50" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carousel1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carousel1" data-bs-slide-to="1" aria-label="Slide 2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="image/hpage_1" class="d-block" alt="Organic pic" style="width:100%;height:500px;">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>100% Fresh Organic & Fishery Products</h5>
                            <p>Over hundred local Organic & Fishery Seller.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="image/hpage_3" class="d-block" alt="Some pic" style="width:100%;height:500px;">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>We are FishyTable Market</h5>
                            <p>A wonderful place to buy / sell your organic & fishery goods.</p>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel1" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel1" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>
        <?php require "footer_both.php";?>
    </body>
</html>