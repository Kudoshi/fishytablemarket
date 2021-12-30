
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3"> 
        <div class="container">
            <a href="seller_home.php" class="navbar-brand"><img src="image/fishytable_logo.png"  width=50px></a>
            <a href="seller_home.php" class="navbar-brand">Fishytable Market</a>
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
                        <a href="seller_home.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="seller_products.php" class="nav-link">Products</a>
                    </li>
                    <li class="nav-item">
                        <a href="seller_orders.php" class="nav-link">Orders</a>
                    </li>
                    <li class="dropdown nav-item">
                        <a class="dropdown-toggle nav-link" role="button" href="#" data-bs-toggle="dropdown"> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                            <?php echo $_SESSION["SellerData"]['SellerName']?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="seller_profile.php?SellerID=<?php echo $_SESSION['SellerData']['SellerID'] ?>" class="dropdown-item" >View Shop</a></li>
                            <li><a href="seller_logic_logout.php" class="dropdown-item" >Log out</a></li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    

