<?php require "resources/conn.php";
$id = intval($_SESSION["CustID"]);
$custid=mysqli_query($con, "SELECT * FROM customer WHERE CustID='$id'");
$data = mysqli_fetch_array($custid);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile Page</title>
    <link rel="stylesheet" href="css/custprofile.css">
    <?php require "import_headInfo.php"; ?>
</head>
<body>
    <?php require "header.php"; ?>
    <form action="cust_edit_profile.php" method="post">
    <input type="hidden" name="id" value="<?php echo $_SESSION["CustID"]?>">
<section>
    <div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25">
                                <div class="bi bi-person-circle display-1"></div></div>
                                <h6 class="f-w-600"><?php echo $data['CustName'];?></h6>
                                <p>Customer</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h2 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h2>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4 class="m-b-10 f-w-600">Email</h4>
                                        <h6 class="text-muted f-w-400"><?php echo $data['CustEmail'];?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="m-b-10 f-w-600">ID</h4>
                                        <h6 class="text-muted f-w-400"><?php echo $data['CustID'];?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="m-b-10 f-w-600">Address</h4>
                                        <h6 class="text-muted f-w-400"><?php echo $data['CustAddress'];?></h6>
                                    </div>
                                </div>
                                <h4 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Others</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                    <a href="cust_edit_profile.php" class="btn btn-dark btn-lg active" role="button" aria-pressed="true">Edits</a> <br> <br>
                                    <a href="cust_view_order_list.php" class="btn btn-dark btn-lg active" role="button" aria-pressed="true">View Orders</a> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<?php require "footer.php";?>
<!-- custom js file link  -->



</body>
</html>