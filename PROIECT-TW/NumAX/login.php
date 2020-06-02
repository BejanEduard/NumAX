<?php include("path.php")?>
<?php include(ROOT_PATH ."/app/controllers/users.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/cdd030e6ac.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<?php include(ROOT_PATH . "/app/includes/nav.php");  ?>

<div class="container s-around">
        <form class="form-auth  col-5 col-s-10" action="login.php" method="post">
        <?php include(ROOT_PATH . "/app/helpers/formErrors.php");  ?>
            <h2 class="form-title">Login</h2>   

            <div class="form-item">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-input ">
            </div>

            <div class="form-item">
                <label class="form-label">Password </label>
                <input type="password" name="password" class="form-input">
            </div>

            <div class="form-item">
                <button type="submit" name="login-btn" class="btn form-btn">Login</button>
                <p> Or
                    <a href="register.php"> Register </a>
                </p>
            </div>


        </form>

</div>



<?php include(ROOT_PATH. "/app/includes/footer.php"); ?>
</body>
</html>