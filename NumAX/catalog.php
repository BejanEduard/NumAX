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

    <?php include(ROOT_PATH . "/app/includes/filters.php"); ?>

    <?php include(ROOT_PATH . "/app/includes/messages.php") ?>

    <?php include(ROOT_PATH."/app/helpers/fetchData.php")?>

    

    <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>
</body>

</html>