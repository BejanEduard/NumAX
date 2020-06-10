<?php include("path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/coins.php") ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/cdd030e6ac.js" crossorigin="anonymous"></script>
    <title>NumAx</title>
</head>

<body>
    <!-- NAVBAR HERE -->
    <?php include(ROOT_PATH . "/app/includes/nav.php"); ?>

    <div class="filter-section">
        <div class="container">
            <div class="filter-option">
                <h4>Country</h4>
                <i class="fas fa-caret-down"></i>
            </div>
            <div class="filter-option">
                <h4>Age</h4>
                <i class="fas fa-caret-down"></i>
            </div>
            <div class="filter-option">
                <h4>Dimension</h4>
                <i class="fas fa-caret-down"></i>
            </div>
            <div class="filter-option">
                <h4>Rarity</h4>
                <i class="fas fa-caret-down"></i>
            </div>
            <div class="filter-option">
                <h4>Price</h4>
                <i class="fas fa-caret-down"></i>
            </div>
            <div class="filter-option">
                <h4>Weight</h4>

                <i class="fas fa-caret-down"></i>
            </div>
            <div class="filter-option">
                <h4>Composition</h4>
                <i class="fas fa-caret-down"></i>
            </div>

        </div>
    </div>

    

    <?php include(ROOT_PATH . "/app/includes/messages.php") ?>
    <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>
    
    <?php if (isset($_SESSION['id'])) : ?>
    <div class="container s-around">
        <form  action="personal_catalog.php" enctype="multipart/form-data" method="post" class="col-4 col-s-10 m-1">
                    <div class="">
                        <button type="submit" name="exportCSV" class="btn form-btn sucess">Export Your Coins</button>
                    </div>                                       
        </form>

        <form  action="personal_catalog.php" enctype="multipart/form-data" method="post" class="col-4 col-s-10 m-1" >   
                    <div class="">    
                        <button type="submit" name="importCSV" class="btn form-btn sucess">Import Your Coins</button>
                        <input type="file" name="csvfile" required>
                    </div>
                    
        </form>
    </div>
    
    <?php foreach ($personal_coins as $coin) : ?>
    <div class="coin-info container">
        <div class="coin-picture col-5 col-s-4">
            <div class="coin-sides">
            <a href="<?php echo BASE_URL . '\coin.php?id=' . $coin['id'] ?>">
                <img src="assets/img/<?php echo $coin['side1']; ?>" alt="No Photo Available">
                </a>
                <a href="<?php echo BASE_URL . '\coin.php?id=' . $coin['id'] ?>">
                <img src="assets/img/<?php echo $coin['side2']; ?>" alt="No Photo Available">
                </a>
                
                <?php if (isset($_SESSION['id'])) : ?>
                    <form  action="personal_catalog.php" method="post">
                    <input type="hidden" name="id_coin"  value="<?php echo $coin['id']; ?>">
                    <div class="form-item">
                    <button type="submit" name="delete-btn" class="btn form-btn error">Delete coin from your collection!</button>
                    </div>
                    </form>
                <?php endif; ?>

            
            </div>
        </div>
        <div class="coin-text col-7 col-s-8">
            <div class="coin-details">
                <h3><?php echo $coin['name'] . ' ' . $coin['provenience']; ?>  </h3>
                <?php if ($coin['circulation'] === 1) : ?>
                <h4>
                Non-circulating coin :  </h4>
<?php else : ?> 
<h4>
                Circulating coin : <?php echo $coin['country'] . ' • ' . $coin['weight'] . 'g • ' . $coin['thickness'] . 'mm' ?> </h4>
<?php endif; ?>
                
                <p><?php echo $coin['description']; ?>
                </p>
                <img src="assets/img/flags/<?php echo strtolower($coin['country']); ?>.png" alt="No picture available">
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php endif; ?>

    

    <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>
</body>

</html>