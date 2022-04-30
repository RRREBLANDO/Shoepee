<header>
    <nav class="navbar navbar-expand-lg shadow-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i class='bx bxs-shopping-bag-alt bx-tada bx-rotate-180' ></i> Shoe<span class="color-custom-light">pee</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span><i class='bx bx-menu-alt-right color-custom-light'></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav ms-auto">
                <?php
                    if(!isset($_SESSION['USER']) && !isset($_SESSION['ROLE_ID'])){
                        echo '<li class="nav-item">
                            <a class="nav-link" href="../main/index.php">Home</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="../main/products.php">Products</a>
                            </li>';
                    }
                ?>
                <?php
                    if(isset($_SESSION['ROLE_ID']) && $_SESSION['ROLE_ID'] == 2){
                        echo '<li class="nav-item">
                            <a class="nav-link" href="../main/index.php">Home</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="../main/products.php">Products</a>
                            </li>';
                    }
                ?>
                <?php
                    if(isset($_SESSION['USER']) && isset($_SESSION['ROLE_ID']) && ($_SESSION['ROLE_ID'] == 1)){
                        echo '<li class="nav-item">
                            <a class="nav-link" href="../admin/dashboard.php">Dashboard</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="../admin/brands.php">Brands</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="../admin/products.php">Products</a>
                            </li>';
                    }
                ?>
                <?php
                    if(isset($_SESSION['USER']) && isset($_SESSION['ROLE_ID'])){
                        echo '<li class="nav-item">
                            <a class="nav-link" href="../admin/orders.php">Orders</a>
                            </li>';
                    }
                ?>
                <?php
                    if(isset($_SESSION['USER']) && isset($_SESSION['ROLE_ID']) && ($_SESSION['ROLE_ID'] == 1)){
                        echo '<li class="nav-item">
                            <a class="nav-link" href="../admin/reports.php">Reports</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="../admin/faq.php">FAQ</a>
                            </li>
                            <li class="nav-item user-link">
                            <a class="nav-link" href="../admin/users.php">Users</a>
                            </li>';
                    }
                ?>
                <?php
                    if(isset($_SESSION['USER']) && isset($_SESSION['ROLE_ID']) && ($_SESSION['ROLE_ID'] == 2)){
                        include_once '../partials/connectionString.php';
                        $sql = "SELECT COUNT(*) FROM cart WHERE user_id='{$_SESSION['USER']}'";
                        $query = mysqli_query($conn, $sql);
                        $count = mysqli_fetch_array($query);
                        echo '<li class="nav-item">
                                <a class="nav-link" href="../main/viewCart.php"><i class="bx bx-shopping-bag"></i> <span>'.$count[0].'</span></a>
                                </li>';
                    }
                ?>
                <?php
                    if(!isset($_SESSION['USER']) && !isset($_SESSION['ROLE_ID'])){
                        echo '<li class="nav-item">
                                <a class="nav-link" href="../main/viewCart.php"><i class="bx bx-shopping-bag"></i> <span>0</span></a>
                                </li>';
                    }
                ?>
                <?php
                    if(!isset($_SESSION['USER']) && !isset($_SESSION['ROLE_ID'])){
                        echo '<li class="nav-item">
                            <a class="btn btn-sm signup-btn" href="../main/signup.php">SIGN UP</a>
                            </li>
                            <li class="nav-item">
                            <a class="btn btn-sm login-btn" href="../main/login.php">LOGIN</a>
                            </li>';
                    }
                ?>
            </ul>
            <?php
                if(isset($_SESSION['USER']) && isset($_SESSION['ROLE_ID'])){
                    echo '<div class="user-profile">
                            <img src="../assets/user-profiles/profile-'.$_SESSION['USER'].'.jpg" alt="profile picture" width="30" height="30">
            
                            <div class="profile-dropdown">
                                <img src="../assets/user-profiles/profile-'.$_SESSION['USER'].'.jpg" alt="profile picture" width="50" height="50">
                                <li><a href="../main/manageProfile.php">Manage Profile</a></li>
                                <li><a href="../partials/logout.php">Log Out</a></li>
                            </div>
                        </div>';
                }
            ?>
            </div>
        </div>
        </nav>
</header>