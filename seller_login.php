
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fishytable Market|Seller Login</title>
    
    
    <?php require "import_headInfo.php"?>
    <!-- You can more stuff here if you want -->
    <?php require "resources/import_sellerHeadInfo.php"?>
</head>
<body>
    <?php require "header.php"; ?>
    <?php 
$_SESSION['CustID'] = "SUkima";
?>

    <div class="container-fluid" >
        <div class="row">
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
                        <a class="col-sm-2" href="#back" onclick="e_turnOnOffDisplay(['loginBtnGroup','loginForm','topBackBtn'])"><img src="image/arrow.png" alt="Back Button" class="d-none" style="width: 50%; height:auto;" id="topBackBtn"></a>
                        <p class="h4 m-0 visible col-sm-8 ">LOGIN</p>
                        <div class="col-sm-2 me-4"></div>
                    </div>
                    

                </div>
                <div class="spanLine mx-auto"></div>
                <div class="flex-grow-1 d-flex flex-column w-70 justify-content-center mx-auto">
                    <!-- TODO: Animation -->
                    <div class="d-flex flex-column mb-4 displayOn" id="loginBtnGroup" >
                        <a class="btn btn-primary text-uppercase mb-4" onclick="e_turnOnOffDisplay(['loginBtnGroup','loginForm','topBackBtn'])">login</button>
                        <a class="btn btn-primary text-uppercase mt-4" href="seller_register.php" >register</a>

                    </div>
                    
                    <!-- -------------------[[SECOND PAGE]] -------------->
                    
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="mb-4 d-none" id="loginForm" >
                        <br>
                        <!-- SEND LOGIN -->
                        <div class="input-group-sm mb-2">
                            <label for="emailBox" class="form-label"><p class="m-1">Email:</p></label>
                            <input type="text" class="form-control " name="loginEmail" id="emailBox" placeholder="Email">
                        </div>
                        <div class="input-group-sm mb-4">
                            <label for="passwordBox" class="form-label"><p class="m-1">Password:</p></label>
                            <input type="text" class="form-control " name="loginPwd" id="passwordBox" placeholder="Password">
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
        if (isset($_POST['loginBtn']) && $_POST['loginBtn'] == 'Submit')
        {
            $_POST['loginBtn'] = NULL;
            $post = $_POST['loginBtn'];
            unset($_POST['loginBtn']);
            echo "<script>console.log($post)</script>";
            echo "<script>e_turnOnOffDisplay(['loginBtnGroup','loginForm','topBackBtn'])</script>";
        }
    ?>
</body>
</html>