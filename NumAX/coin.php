<?php include("path.php");
include(ROOT_PATH . "/app/controllers/coins.php");
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
    <?php include(ROOT_PATH . "/app/includes/nav.php"); ?>
    <?php include(ROOT_PATH . "/app/includes/messages.php") ?>

    
    <h1 style="text-align:center"> <?php echo $coin['name']; ?></h4>
    <div class="coin-info container ">
        <div class="coin-picture col-5 col-s-4">
            <div class="coin-sides">
                <a href="<?php echo BASE_URL . '\coin.php?id=' . $coin['id'] ?>">
                <img src="assets/img/<?php echo $coin['side1']; ?>" alt="No Photo Available">
                </a>
                <a href="<?php echo BASE_URL . '\coin.php?id=' . $coin['id'] ?>">
                <img src="assets/img/<?php echo $coin['side2']; ?>" alt="No Photo Available">
                </a>
                
                <?php if (isset($_SESSION['id'])) : ?>
                
                    <form  action="coin.php?id=<?php echo $coin['id'] ?>" method="post">
                    <input type="hidden" name="id_coin"  value="<?php echo $coin['id']; ?>">
                    <div class="form-item">
                    <?php if (in_array($coin, $personal_coins)) : ?>
                    <button type="submit" name="add-btn" class="btn form-btn info" disabled>You already have this coin!</button>
                    <?php else : ?>      
                    <button type="submit" name="add-btn" class="btn form-btn ">Add coin to your collection!</button>
                    <?php endif; ?>
                    </div>
                    </form>
                <?php endif; ?>

            
            </div>
        </div>
        <div class="coin-text col-7 col-s-8">
            <div class="coin-details">
                <h3><?php echo $coin['name'] . ' ' . $coin['provenience']; ?></h3>
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

    

    
        <div class="container s-around">
                <div class="col-6">
                <div class="coin-info ">
                    <h2>Obverse</h2>
                    <p><?php echo $coin['obverse']; ?></p>
                </div>
                <div class="coin-info ">
                <h2>Reverse</h2>
                <p><?php echo $coin['reverse']; ?></p>
                </div> 
                </div>
            
            <div class="coin-info col-3 col-s-10  bg-transp" style="color:white">
                 <h3 style="text-align:center"> Features </h3>
                 <h4>Country:	<?php echo $coin['country']; ?>  </h5>   
                 <h4>Type:	<?php echo $coin['circulation']; ?> </h5>  
                 <h4>Year:	<?php echo $coin['provenience']; ?> </h5>  
                 <h4>Value:	<?php echo $coin['value']; ?> </h5>  
                 <h4>Currency:	<?php echo $coin['currency']; ?> </h5>  
                 <h4>Composition:	<?php echo $coin['composition']; ?> </h5>  
                 <h4>Weight:	<?php echo $coin['weight']; ?> g</h5>  
                 <h4>Diameter:	<?php echo $coin['diameter'];
                                ?> mm </h5>
                 <h4>Thickness:	<?php echo $coin['thickness'];
                                ?> mm </h5>  
                 <h4>Shape:	<?php echo $coin['shape']; ?> </h5>    
            </div>
        </div>
    

    <!-- FOOTER HERE -->
    <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>
    
</body>

</html>