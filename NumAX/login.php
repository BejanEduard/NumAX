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
<?php include("app/includes/nav.php"); ?>

<div class="container s-around">
    
    <form class="col-3 col-s-10" action="login.php" method="post">
        <div class="container s-around">
         <h2 class="form-title">Login</h2>
        </div>
    <div class="container s-around">
    <div class="form-item">
        <label class="form-label" >Username</label>
        <input type="text" name="username" class=" form-text ">
    </div>
    </div>
    <div class="container s-around">
    <div class="form-item"> 
        <label class="">Password</label>
        <input type="password" name="password" class="form-text">
    </div>
</div>
    
    <div class="container s-around">
        <button type="submit" name="login-btn" class="btn form-btn"></button>
        <p> Or <a href="register.php"> Register </a> </p>
    </div>
    

</form>
</div>



<?php include("app/includes/footer.php");  ?>
</body>
</html>