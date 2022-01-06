<?php require "resources/conn.php";?>
<?php require "resources/basic_utility.php";?>
<?php
    if (isset($_POST["registerBtn"])){
        $errorMsg = "";
        $FName = sanitizeInput($_POST["FName"], "string");
        $LName = sanitizeInput($_POST["LName"], "string");
        $email = sanitizeInput($_POST["Email"], "email");
        $password = sanitizeInput($_POST["Password"], "string");
        $address = sanitizeInput($_POST["Address"],"string");

        
        if (!validateInputLength($FName, 3, 60))
        {
            $errorMsg .= "<br>* Name is too long";
        }
        if (!validateInputLength($LName, 3, 60))
        {
            $errorMsg .= "<br>* Name is too long";
        }
        if (!validateInputLength($email, 3, 255) && filter_var($email, FILTER_VALIDATE_EMAIL) === false)
        {
            $errorMsg .= "<br>* Incorrect email format";
        }
        if (!validateInputLength($password, 8, 128))
        {
            $errorMsg .= "<br>* Incorrect password length";
        }
        if (!validateInputLength($address, 5, 255))
        {
            $errorMsg .= "<br>* Incorrect address length";
        }


        //Check with database
        $sqlEmail = "SELECT CustEmail FROM customer WHERE CustEmail = '$email'";
        $resultEmail = mysqli_query($con, $sqlEmail) or die(mysqli_error($con));
        if ($resultEmail->num_rows > 0)
        {
            $errorMsg .= "<br>* Email has already been used to register";
        }

        // Insert into database
        if ($errorMsg === "")
        {
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $date = date("y-m-d");
            $sql = "INSERT INTO customer (CustName, CustEmail, CustPassword, CustAddress)
            VALUES
            ('$FName "."$LName', '$email', '$password', '$address')";
            if (!mysqli_query($con,$sql))
            {
                $errorMsg .= "<br>Error creating an account";
            }
            else ("SELECT CustID FROM customer WHERE CustEmail = $email");
            {mysqli_query ($con, $sql)
                $data = mysqli_fetch_array($result)};
        }

        // Control Redirect
        if ($errorMsg === "") //SUCCESS
        {
            $_SESSION["Message"] = "Account successfully created";
            header("Location: cust_login.php");
            return;
        }
        else //ERROR
        {
            $_SESSION["Message"] = $errorMsg;

            //Sets the form data back
            $formData["FName"]= sanitizeInput($_POST["FName"], "string");
            $formData["LName"]= sanitizeInput($_POST["LName"], "string");
            $formData["Email"]= sanitizeInput($_POST["Email"], "email");
            $formData["Password"] = sanitizeInput($_POST["Password"], "string");
            $formData["Address"] = sanitizeInput($_POST["Address"],"string");
            $_SESSION["FormData"] = $formData;
            header("Location: cust_signup.php");
            return;
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Signup</title>

    <?php require "import_headInfo.php"; ?>
</head>
<body>
    <?php
        //Prevent user from registering when logged in
        if (isset($_SESSION["CustID"])) 
        {
            header("Location: customer_home.php");
            return;
        }
        //Insert previously entered form data
        if (isset($_SESSION["FormData"]))
        {  
            $formData = $_SESSION["FormData"];  
            $FName= $formData["FName"];
            $LName= $formData["LName"];
            $email= $formData["Email"];
            $password = $formData["Password"];
            $address = $formData["Address"];
            
            unset($_SESSION["FormData"]);
        }
        else{
            //Declare blank var
            $FName="";
            $LName="";
            $email= "";
            $password = "";
            $address = "";
        }
    ?>
        <?php require "header.php"; ?>
    <section>
    <div class="text-center text-danger h6">
                    <?php if (isset($_SESSION["Message"])) 
                    { 
                        echo $_SESSION["Message"];
                        unset($_SESSION["Message"]);
                    }?>
                </div>
        <div class="container">
          <div class="row">
              <div class="col-md-6 offset-md-3 p-4 border-top ">
                  <div class="signup-form">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mt-5 border p-4 bg-light shadow">
                          <h4 class="mb-5 text-secondary">Account Registration</h4> 
                          <div class="row">
                              <div class="mb-3 col-md-6">
                                  <label>First Name<span class="text-danger">*</span></label>
                                  <input type="text" name="FName" class="form-control" placeholder="Enter First Name">
                              </div>
      
                              <div class="mb-3 col-md-6">
                                  <label>Last Name<span class="text-danger">*</span></label>
                                  <input type="text" name="LName" class="form-control" placeholder="Enter Last Name">
                              </div>
    
                              <div class="mb-3 col-md-12">
                                <label>Email<span class="text-danger">*</span></label>
                                <input type="email" name="Email" class="form-control" placeholder="Enter Email">
      
                              <div class="mb-3 col-md-12">
                                  <label>Password<span class="text-danger">*</span></label>
                                  <input type="password" name="Password" class="form-control" placeholder="Enter Password">
                              </div>
                              <div class="mb-3 col-md-12">
                                  <label>Address<span class="text-danger">*</span></label>
                                  <input type="address" name="Address" class="form-control" placeholder="Enter Address">
                              </div>
                              <div class="col-md-12">
                                 <!-- <button class="btn btn-primary float-end">Signup Now</button> -->
                                 <input type="submit" class="btn btn-primary float-end" name="registerBtn" >
                              </div>
                          </div>
                      </form>
                      <p class="text-center mt-3 text-secondary">If you have account, Please <a href="cust_login.php">Login Now!</a></p>
                  </div>
              </div>
          </div>
      </div>
      <br><br>
    </section>


    <?php require "footer.php";?>
</body>
</html>