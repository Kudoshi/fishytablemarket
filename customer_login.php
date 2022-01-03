<?php require "resources/conn.php"?>
<?php 
    if (isset($_POST["loginBtn"]))
    {
        $email = $_POST["loginEmail"];
        $password = $_POST["loginPwd"];

        $sql = "SELECT * FROM customer WHERE CustEmail = '$email' AND CustPassword = '$password'";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        print_r($result);
        if (!$result->num_rows>0)//If no record
        {
            echo "No login credentials found";
            echo $password;
        }
        else{
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

    
    <?php require "import_headInfo.php"?>
</head>
<body>
    <?php require "header.php"; ?>
    <div class="container-fluid">
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="mb-4" id="loginForm">
            <br>
            LOGIN CUSTOMER
            <div class="input-group-sm mb-2">
                <label for="emailBox" class="form-label"><p class="m-1">Email:</p></label>
                <input type="email" class="form-control " name="loginEmail" id="emailBox" placeholder="Email" required>
            </div>
            <div class="input-group-sm mb-4">
                <label for="passwordBox" class="form-label"><p class="m-1">Password:</p></label>
                <input type="password" class="form-control " name="loginPwd" id="passwordBox" placeholder="Password" required>
            </div>
            <br>
            <div class="mt-4">
                <input type="submit" class="btn btn-primary" name="loginBtn">
            </div>

            To seller login instead:
            <a href="seller_login.php">Seller Login</a>

        </form>
    </div>
    

    <?php require "footer.php";?>
</body>
</html>