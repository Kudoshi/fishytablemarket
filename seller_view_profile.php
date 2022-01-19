<?php require "resources/conn.php"?>
<?php require "resources/seller_utility.php"?>
<?php require "resources/seller_security.php"?>
<?php

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
   
    <div class="container-fluid bg-color-white-1">
        <div class="text-end display-6 bg-color-black-2 text-white row py-4">
            <div class="me-4 pe-4 col-md-11">
                <span class="fs-4 ">View Shop</span>
                <span class="text-primary px-2">|</span>
                <span class="text-gray-2 display-6">Shop</span>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="bg-primary row p-3 text-white text-center">
            <div class=" display-6 mb-2">Shop Customer View</div> 
            <div class="h5">- View Only Mode -</div>
        </div>
        <div class="my-4 ">
            
            <div class="bg-color-white-2 mx-auto p-4 shadow-sm border rounded-3" style="max-width: 97%; min-width:470px">
                <div class="fs-3 text-center bi bi-info-circle text-primary"></div>
                <div class="p-2 text-center h6">This is the customer's view on your shop page
                </div>
                <div class="spanLineFull-sm mx-auto mb-4"></div>
                <iframe class=" px-2 py-2 mt-4 shadow border border-2 border-dark rounded-3" style="width: 100%; height: 800px;" id="Iframe" src="seller_profile?SellerID=<?php echo $_SESSION["SellerData"]["SellerID"]?>"></iframe>
           <br>
            </div>
        </div>
        </div>
        <br><br><br>
    </div>
    <?php require "footer_seller.php";?>

    <script>
        //Set frame height to max and disable all links
        var frame = document.getElementById("Iframe");
        frame.onload = function()
        {
            frame.style.height = frame.contentWindow.document.body.scrollHeight + 21 + 'px';
            var links= frame.contentWindow.document.getElementsByTagName("a"); 

        
            for (var i in links) { 
                links[i].href = "javascript:void(0)"; 
            }
        }
        
    </script>
</body>
</html>