<!-- // BASE_URL IN path.php  -->


<nav class="container">
        <a id="logo" href="<?php echo BASE_URL . '/main.php' ?>">NumAX</a>
        <div class="nav-list">
            <ul class="nav-list">
                <li>
                    <a href="<?php echo BASE_URL . '/main.php' ?>">Home</a>
                </li>
                <li>
                <a href="<?php echo BASE_URL . '/catalog.php' ?>">Catalog</a>
                </li>
                <?php if(isset($_SESSION['id'])):  ?>
                    
                    <li>
                    <a href="<?php echo BASE_URL . '/create_coin.php' ?>"> Create Coin</a>
                    </li>
                    
                    <li>
                    <a href="<?php echo BASE_URL . '/personal_catalog.php' ?>">My Catalog</a>
                    </li>
                    <li>
                    <a href="<?php echo BASE_URL . '/logout.php' ?>"> Logout</a>
                    </li>
                    
                    

                <?php else: ?>
                
                    <li>
                    <a href="<?php echo BASE_URL . '/register.php' ?>">Register</a>
                    </li>
                    <li>
                    <a href="<?php echo BASE_URL . '/login.php' ?>">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
            <input type="text" placeholder="Search">
        </div>
    </nav>