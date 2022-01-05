<?php
require("resources/conn.php");


$sql = "UPDATE customer SET
CustName='$_POST[Fname] $_POST[Lname]',
CustEmail='$_POST[Email]',
CustAddress='$_POST[Address]',
CustPassword='$_POST[Password]'
WHERE CustID=$_SESSION[CustID]";

if(mysqli_query($con,$sql)){
    echo "hi";
    mysqli_close($con);
    header('Location: cust_profile.php');//same as window.location.href (JS)
}
else{
    $error = "Error:".mysqli_error($con);
}