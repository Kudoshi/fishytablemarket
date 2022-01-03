<?php require "resources/conn.php"?>
<?php

    unset($_SESSION);
    session_destroy();
    header("Location: seller_login.php");
?>