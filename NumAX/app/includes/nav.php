<!-- // BASE_URL IN path.php  -->
<nav class="container">
        <a class="logo" href="<?php echo BASE_URL . '/main.php' ?>">NumAX</a>
        <div class="nav-list">
            <ul class="nav-list">
                <li>
                    <a href="<?php echo BASE_URL . '/main.php' ?>">Home</a>
                </li>
                <li>
                <a href="<?php echo BASE_URL . '/catalog.php' ?>">Catalog</a>
                </li>
                <?php if (isset($_SESSION['id'])) : ?>
                    
                    <li>
                    <a href="<?php echo BASE_URL . '/create_coin.php' ?>"> Create Coin</a>
                    </li>
                    
                    <li>
                    <a href="<?php echo BASE_URL . '/personal_catalog.php' ?>">My Catalog</a>
                    </li>
                    <li>
                    <a href="<?php echo BASE_URL . '/statistics.php' ?>">Statistics</a>
                    </li>
                    <li>
                    <a href="<?php echo BASE_URL . '/logout.php' ?>"> Logout</a>
                    </li>
                    
                    

                <?php else : ?>
                
                    <li>
                    <a href="<?php echo BASE_URL . '/register.php' ?>">Register</a>
                    </li>
                    <li>
                    <a href="<?php echo BASE_URL . '/login.php' ?>">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
            <form  class ="search-box"method="get" name="search">
            <input type="text"  autocomplete="off" size ="25" name="search-text" placeholder="Search coin by name..." onkeyup="searchCoins(this.value)">
            <div id ="livesearch" class="result">
            </div>
            </form>
        </div>
    </nav>