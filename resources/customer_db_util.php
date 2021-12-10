<?php
// Customer Database Login and Sessions
if (session_status()===PHP_SESSION_NONE){
    session_start();
}

if (isset($_SESSION['CustID'])) //If Customer ID is set
{
    echo '<script>console.log("CustID is set: '.$_SESSION["CustID"].'");</script>';
}
else
{
    echo '<script>console.log("CustID NOT SET");</script>';
}
?>