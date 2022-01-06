<?php require "resources/conn.php";?>
<?php
    if (isset($_SESSION["CustomerID"]))
    {
        header("Location: homePage.php");
        return;
    }
    

    if (isset($_POST["loginBtn"]))
    {
        $email = sanitizeInput($_POST["loginEmail"], "email");
        $password = sanitizeInput($_POST["loginPwd"], "string");

        $sql = "SELECT * FROM customer WHERE CustEmail = '$email' AND CustPassword = '$password'";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        if (!$result->num_rows>0)//If no record
        {
            $_SESSION["msg_loginError"] = "* Your email or password is incorrect, please try again!";
            $_SESSION["loginEmail"] = $email;

            header("Location: cust_login.php");
            return;
        }
        else{ //Login
            //setting data to session
            unset($_SESSION);
            session_destroy();
            session_start();
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
                <form action="" class="mt-5 border p-4 bg-light shadow">
                    <h4 class="mb-5 text-secondary">Account Login</h4>
                    <div class="row">
                          <div class="mb-3 col-md-12">
                            <label>Email<span class="text-danger">*</span></label>
                            <input type="Email" name="Email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Password<span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password">
                        </div>
                        <div class="col-md-12">
                           <button class="btn btn-primary float-start" name="loginBtn">Login Now</button>
                    </div>
                </form>
                <p class="text-center mt-3 text-secondary">If you don't have an account, Please <a href="cust_signup.php">SignUp Now!</a> <br>To <a href="#SellerLogin">Seller Login!</a></p>
            </div>
        </div>
    </div>
</div>
<br><br><br><br>
</section>
    <?php require "footer.php";?>
</body>
</html>