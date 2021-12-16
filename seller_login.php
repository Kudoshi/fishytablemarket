<?php require "resources/conn.php"?>
<?php require "resources/seller_utility.php"?>
<?php
    if (isset($_SESSION["SellerID"]))
    {
        header("Location: seller_home.php");
        return;
    }

    if (isset($_POST["loginBtn"]))
    {
        $email = sanitizeInput($_POST["loginEmail"], "email");
        $password = sanitizeInput($_POST["loginPwd"], "string");

        $sql = "SELECT * FROM seller WHERE SellerEmail = '$email' AND SellerPassword = '$password'";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        if (!$result->num_rows>0)//If no record
        {
            $_SESSION["msg_loginError"] = "* Your email and/or password is incorrect, please try again";
            $_SESSION["loginEmail"] = $email;

            header("Location: seller_login.php");
            return;
        }
        else{

            $data = mysqli_fetch_array($result);
            $_SESSION["SellerID"] = $data["SellerID"];
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

    <div class="container-fluid">
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
            <div class="col-sm-8 bg-primary pb-4 h-85vh">
                <div class="d-flex flex-column justify-content-center h-100">
                    <div class="p-2">
                        <img src="image/fishytable_logo.png" alt="Fishytable Logo" class="rounded mx-auto d-block mt-auto" style="width:20vh ;height: auto;">
                    </div>
                    <div class="display-4 text-center p-2">Fishytable Market</div>
                    <div class="mx-auto w-75 h5 p-2"><p class="text-center"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pellentesque dolor erat, ac tristique odio sagittis non.</small></p></div>
                </div>
            </div>    
            <!-- Right Side -->
            <div class="col-sm-4 d-flex flex-column justify-content-center text-center p-2">
                <div class="d-flex flex-column justify-content-center text-center h-20 ">
                    <p class="display-6 m-0">Seller Account</p><br>
                    <div class="row">
                        <a class="col-sm-2" onclick="e_turnOnOffDisplay(['loginBtnGroup','loginForm','topBackBtn'])"><img src="image/arrow.png" alt="Back Button" class="d-none" style="width: 50%; height:auto;" id="topBackBtn"></a>
                        <p class="h4 m-0 visible col-sm-8 ">LOGIN</p>
                        <div class="col-sm-2 me-4"></div>
                    </div>
                    

                </div>
                <div class="spanLine mx-auto"></div>
                <div class="flex-grow-1 d-flex flex-column w-70 justify-content-center mx-auto">

                    <!-- Register/login page -->
                    <div class="d-flex flex-column mb-4 displayOn" id="loginBtnGroup" >
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
                <div class="h-25 d-flex flex-column pt-2">
                    <p>Want to be a seller? <a class="d-inline" href="#Contact Us">Contact Us!</a><br><br>
                    To customer login instead
                    </p>
                    <a href="#CustomerLogin"><img src="image/arrow.png" class="imgFlip ms-2" style="width: 5%; height: auto;" alt="Arrow Link"></a>
                    
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