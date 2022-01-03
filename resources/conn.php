<?php
if (session_status()===PHP_SESSION_NONE)
{
    session_start();
}
$con=mysqli_connect("localhost","root","","fishytablemarket");

if (mysqli_connect_error()) {
    echo "Failed to connect to MySQL: " .mysqli_connect_error();
}
?>