<?php require "resources/conn.php"?>
<?php require "resources/seller_utility.php"?>
<?php
    if (isset($_SESSION["SellerData"]))
    {
        header("Location: seller_home.php");
        return;
    }
    

    if (isset($_POST["loginBtn"]))
    {
        $email = sanitizeInput($_POST["loginEmail"], "email");
        $password = sanitizeInput($_POST["loginPwd"], "string");

        $sql = "SELECT SellerID, SellerName, SellerEmail, SellerTelephone, SellerPhoto, ShopName, SellerAddress, SellerDescription, JoinDate, SellerRating
                FROM seller WHERE SellerEmail = '$email' AND SellerPassword = '$password'";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        
        if (!$result->num_rows>0)//If no record
        {
            $_SESSION["msg_loginError"] = "* Your email and/or password is incorrect, please try again";
            $_SESSION["loginEmail"] = $email;

            header("Location: seller_login.php");
            return;
        }
        else{ //Login
            unset($_SESSION);
            session_destroy();
            session_start();
            
            $data = mysqli_fetch_array($result);
            $_SESSION["SellerData"] = $data;
            header("Location: seller_home.php");
            return;
        }
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fishytable Market|Seller Login</title>
    
    <?php require "import_headInfo.php"?>
    <?php require "resources/import_sellerHeadInfo.php"?>
</head>
<body>
    <?php require "header.php"; ?>

    <?php
        $email = "";
        $errorMsg = "";
        if (isset($_SESSION["loginEmail"]) && isset($_SESSION["msg_loginError"])){
            $errorMsg = $_SESSION["msg_loginError"];
            $email = $_SESSION["loginEmail"];
            unset($_SESSION["loginEmail"]);
            unset($_SESSION["msg_loginError"]);
        }
    ?>

    <div class="container-fluid bg-color-blue-1">
        <div class="row">
            <div class="text-center bg-success text-white">
                <?php 
                if (isset($_SESSION["Message"])) 
                { 
                    echo "<br>".$_SESSION["Message"]."<br><br>";
                    unset($_SESSION["Message"]);
                }
                ?>
            </div>
            
            <!-- Left Side -->
            <div class="col-md-8  pb-4 h-85vh">
                <div class="d-flex flex-column justify-content-center h-100 text-white text-shadow-edge">
                    <div class="p-2">
                        <img src="image/fishytable_logo.png" alt="Fishytable Logo" class="rounded-circle shadow-lg mx-auto d-block mt-auto p-1" style="width:20vh ;height: auto; background-color: hsla(0, 0%, 0%, 0.2);">
                    </div>
                    <div class="display-4 text-center p-2">Fishytable Market</div>
                    <div class="mx-auto w-75 fs-5 p-2"><p class="text-center "><small>Malaysia's e-commerce website providing a platform for the local farmers, fisherman and bussiness to sell their produce</small></p></div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="col-md-4 d-flex flex-column justify-content-center text-center justify-content-between p-0 bg-color-white-0 border-start border-dark border-2">
                <div class="d-flex flex-column flex-grow-1 flex-md-grow-0 justify-content-center text-center h-20" style="min-height: 150px;">
                    <p class="display-6 m-2 ">Seller Account</p><br>
                    <div class="row">
                        <a class="col-2"  onclick="e_turnOnOffDisplay(['loginBtnGroup','loginForm','topBackBtn'])"><img src="image/arrow.png" alt="Back Button" class="d-none" style="max-width:30px" id="topBackBtn"></a>
                        <p class="h4 visible col-8 ">LOGIN</p>
                        <div class="col-2 me-4"></div>
                    </div>
                </div>

                <div class="spanLine mx-auto"></div>
                <div class="flex-grow-1 d-flex flex-column w-70 justify-content-center mx-auto">

                    <!-- Register/login page -->
                    <div class="d-flex flex-column mb-4 displayOn py-4 my-4" id="loginBtnGroup" >
                        <a class="btn btn-primary text-uppercase mb-4" onclick="e_turnOnOffDisplay(['loginBtnGroup','loginForm','topBackBtn'])">login</button>
                        <a class="btn btn-primary text-uppercase mt-4" href="seller_register.php" >register</a>

                    </div>
                    
                    <!-- Login page -->
                    
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="mb-4 d-none" id="loginForm" >
                        <br>
                        <div class="text-center text-danger mb-4 pb-2"><?php echo $errorMsg; ?></div>
                        <div class="input-group-sm mb-2">
                            <label for="emailBox" class="form-label"><p class="m-1">Email:</p></label>
                            <input type="email" class="form-control " name="loginEmail" id="emailBox" placeholder="Email" value="<?php echo $email?>" required>
                        </div>
                        <div class="input-group-sm mb-4">
                            <label for="passwordBox" class="form-label"><p class="m-1">Password:</p></label>
                            <input type="password" class="form-control " name="loginPwd" id="passwordBox" placeholder="Password" required>
                        </div>
                        <br>
                        <div class="mt-4">
                            <input type="submit" class="btn btn-primary" name="loginBtn">
                        </div>
                    </form>
                    
                </div>
                <div class="spanLine mx-auto"></div>
                <div class="h-25 d-flex flex-column pt-2 my-4">
                    <p>Want to be a seller? <a class="d-inline" href="#Contact Us">Contact Us!</a><br><br>
                    To customer login instead
                    </p>
                    <a href="customer_login.php"><img src="image/arrow.png" class="imgFlip ms-2" style="max-width:20px" alt="Arrow Link"></a>
                    
                </div>
            </div>

        </div>
    </div>
    
    <?php require "footer.php";?>

    <?php
    if ($errorMsg !== "")
    {
        js_RunScript("e_turnOnOffDisplay(['loginBtnGroup','loginForm','topBackBtn'])");
    }
    ?>
</body>
</html>