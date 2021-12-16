<?php require "resources/seller_utility.php" ?>
<!DOCTYPE HTML>
<html>
<head>
    <?php require "import_headInfo.php"; ?>
    <?php require "resources/import_sellerHeadInfo.php"?>
</head>
<body>
    <div class="container-fluid bg-secondary">
        <p><label for="file" style="cursor: pointer;">Upload Image</label></p>
        <input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;">

        <br>
        <img id="output" width="200" />	
    </div>

    <script>var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    } 
    </script>
</body>
</html>