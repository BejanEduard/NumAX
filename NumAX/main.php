<?php include("path.php") ;
include(ROOT_PATH . "/app/database/db.php");
?>

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
    <?php include(ROOT_PATH . "/app/includes/nav.php");  ?>
    <?php include(ROOT_PATH . "/app/includes/messages.php") ?>
    

    <section id="introduction">
        <div class="container">
            <div id="info" class="col-8 col-s-6">
                <h1>The Biggest Collection of Coins on Earth</h1>
                <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam aperiam ullam non quas, officia aspernatur
                    hic error delectus omnis, sequi modi. Veniam omnis facilis impedit magnam delectus ad nesciunt quae.</h3>
            </div>
            <div id="coin-shuffle" class="col-4 col-s-6">

                <img src="assets/img/coin_1.png">

            </div>
        </div>
    </section>

    <section id="badge-section">
        <div class="container s-around">
            <div class="badge col-3 col-s-6">
                <h2>World Coin Catalog</h2>
                <p>Looking for information about a coin or to identify an unknown coin? Find it among 170,000+ world coins in
                    the collaborative coin catalog, built and constantly enriched by the Numista community.</p>
            </div>
            <div class="badge col-3 col-s-6">
                <h2>Manage Your Collection Online</h2>
                <p>View and update your collection list from any place, any time on Numista! Enter your collection by checking
                    the coins you have in the catalog.</p>
            </div>
            <div class="badge col-3 col-s-6">
                <h2>Share your passion</h2>
                <p>Numista is also a wonderful space to share with other coin enthusiasts, especially thanks to the forum and
                    to Numisdoc, the participative numismatic encyclopedia.</p>
            </div>
        </div>
    </section>

    <!-- FOOTER HERE -->
    <?php include(ROOT_PATH. "/app/includes/footer.php"); ?>
    
</body>

</html>