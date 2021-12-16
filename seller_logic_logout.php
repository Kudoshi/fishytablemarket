<?php require "resources/conn.php"?>
<?php require "resources/seller_utility.php"?>
<?php

    unset($_SESSION);
    session_destroy();
    header("Location: seller_login.php");
?>