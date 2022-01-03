
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
                            <span style="width:30px; height:30px" class="bi bi-person-circle"></span>
                
                            <?php echo $_SESSION["SellerData"]['SellerName']?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="seller_view_profile.php" class="dropdown-item" >View Shop</a></li>
                            <li><a href="seller_logic_logout.php" class="dropdown-item" >Log out</a></li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    

