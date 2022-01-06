<?php require "resources/conn.php";?>
<?php 
    if (isset($_POST["loginBtn"]))
    {
        $email = $_POST["loginEmail"];
        $password = $_POST["loginPwd"];

        $sql = "SELECT * FROM customer WHERE CustEmail = '$email' AND CustPassword = '$password'";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        if (!$result->num_rows>0)//If no record
        {
            echo "No login credentials found";
            echo $email;
        }
        else{
            //setting data to session
            $data = mysqli_fetch_array($result);
            $_SESSION["CustID"] = $data["CustID"];
            $_SESSION["CustName"] = $data["CustName"];
            header("Location: homePage.php");
            return;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Login</title>

    <!-- You can more stuff here if you want -->
    <?php require "import_headInfo.php"; ?>
</head>
<body>
    <?php require "header.php"; ?>
<section>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="signup-form">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="mt-5 border p-4 bg-light shadow" id="loginForm" method="POST">
                    <h4 class="mb-5 text-secondary">Account Login</h4>
                    <div class="row">
                          <div class="mb-3 col-md-12">
                            <label>Email<span class="text-danger">*</span></label>
                            <input type="Email" name="loginEmail" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Password<span class="text-danger">*</span></label>
                            <input type="password" name="loginPwd" class="form-control" placeholder="Enter Password">
                        </div>
                        <div class="col-md-12">
                           <button class="btn btn-primary float-start" name="loginBtn">Login Now</button>
                    </div>
                </form>
                <p class="text-center mt-3 text-secondary">If you don't have an account, Please <a href="cust_signup.php">SignUp Now!</a> <br>To <a href="seller_login.php">Seller Login!</a></p>
            </div>
        </div>
    </div>
</div>
<br><br><br><br>
</section>
    <?php require "footer.php";?>
</body>
</html>