<?php require "resources/conn.php"?>
<?php require "resources/seller_utility.php"?>
<!DOCTYPE HTML>
<html>
<head>
    <?php require "import_headInfo.php"; ?>
    <?php require "resources/import_sellerHeadInfo.php"?>
</head>
<body>
    <?php 
        echo generateUniqueHash();
        echo session_id();
    ?>
</body>
</html>