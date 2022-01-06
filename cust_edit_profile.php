<?php require "resources/conn.php";                     
$id = intval($_SESSION["CustID"]);
$custid=mysqli_query($con, "SELECT * FROM customer WHERE CustID='$id'");
$data = mysqli_fetch_array($custid);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Edit Profile </title>
    <link rel="stylesheet" href="css/edit.css">
    
    <?php require "import_headInfo.php"; ?>
</head>
<body>
    <?php require "header.php"; 
    
?>
    <form action="update.php" method="post">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8 mx-auto">
                <form>
                    <div class="mt-5 align-items-center">
                        <div>
                            <div class="avatar avatar-xl">
                            <div class="text-center"><h4 class="mb-1"><?php echo $data['CustName']?></h4>
                            </div>
                        </div>
                        <div class="text-center mb-5">
                            <div class="avatar avatar-xl">
                            <div class="bi bi-person-circle display-1"></div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4" />
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstname">First Name</label>
                            <input type="text" name="Fname" class="form-control"  placeholder="First" value="<?php echo $data['CustName']?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastname">Last Name</label>
                            <input type="text" name="Lname" id="lastname" class="form-control"  placeholder="Last" value="<?php echo $data['CustName']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" name="Email"class="form-control" id="Email"  placeholder="Email" value="<?php echo $data['CustEmail']?>">
                    </div>
                    <div class="form-group">
                        <label for="Address">Address</label>
                        <input type="text" name="Address" class="form-control" id="Address" placeholder="Address" value="<?php echo $data['CustAddress']?>">
                    </div>
                    <hr class="my-4" />
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Password">New Password</label>
                                <input type="password" name="Password" class="form-control" id="Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">Password requirements</p>
                            <p class="small text-muted mb-2">To create a new password, you have to meet all of the following requirements:</p>
                            <ul class="small text-muted pl-4 mb-0">
                                <li>Minimum 8 character</li>
                                <li>At least one special character</li>
                                <li>At least one number</li>
                                <li>Can't be the same as a previous password</li>
                            </ul>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Save Change</button>
                    <br>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>
    <?php require "footer.php";?>
</body>
</html>