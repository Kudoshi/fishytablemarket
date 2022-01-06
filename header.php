<nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3" id="header"> 
    <div class="container">
        <a href="homePage.php" class="navbar-brand"><img src="image/fishytable_logo.png" width=50px></a>
        <a href="homePage.php" class="navbar-brand">Fishytable Market</a>
        <button 
            class="navbar-toggler" 
            type="button"
            data-bs-toggle="collapse" 
            data-bs-target="#navmenu"
        >
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="homePage.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href='homePage.php?type=organic' class="nav-link" id="organicLink">Organics</a>
                </li>
                <li class="nav-item">
                    <a href='homePage.php?type=fishery' class="nav-link" id="fisheryLink">Fishery</a>

                </li>
                <?php
                    if (!isset($_SESSION["CustID"])) {
                        echo '<li class="nav-item">
                        <a href="cust_login.php" class="nav-link">Login</a>
                        </li><li class="nav-item">
                        <a href="cust_signup.php" class="nav-link">Register</a>
                        </li>';
                    }
                    
                ?>
                <?php
                    if(isset($_SESSION["CustID"])){
                        echo  '<li class="nav-item">
                        <a href="cust_profile.php" class="nav-link"><span style="width:30px; height:30px" class="bi bi-person-circle"></span>Profile</a>
                        </li>
                        <li class="nav-item"><a href="cust_logout.php" class="nav-link">Logout</a></li>';
                        
                    }
                ?>
                
                <?php
                    if (isset($_SESSION["CustID"])) {
                        $cart = mysqli_query($con,"SELECT ProductCartListID, CustID FROM productcartlist INNER JOIN cart ON ProductCartList.CartID = cart.CartID WHERE cart.CustID = ".$_SESSION["CustID"]." AND cart.CartPaid = 0");
                        $numOfCart = mysqli_num_rows($cart);
                        echo '<li id="cartIcon" class="nav-item"> <a id="cartLink" href="cartPage.php" method="post" class="nav-link position-relative"> <img src="image/cart2.png" width="20px",height="20px">';
                        if ($numOfCart > 0) {
                            echo '<span id="cartQty" class="position-absolute top-0 start-100 translate-middle badge bg-warning rounded-pill text-dark">'.$numOfCart.'</span> ';
                        }
                        echo '</a> </li>';
                    }
                ?>
                <li class="nav-item ms-2">
                    <a href="#search" class="nav-link"><img src="image/search.png" width="20px",height="20px"></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
