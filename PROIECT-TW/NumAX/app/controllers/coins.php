<?php
// REGISTER FORM 

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validateCoin.php");

    $errors = array();
    
    $name = '';
    $provenience = '';
    $circulation = '';
    $description = '';
    $side1 = '';
    $side2 = '';
    $country = '';
    $table = 'coins';



if(isset($_POST['create-btn'])){
     

    $errors = validateCoin($_POST);

    if(count($errors) === 0){
            // Delete from $_POST array the unwanted values
        unset($_POST['create-btn']);


        $coin_id = create($table,$_POST);
        
        $ownership_id = create('ownership',["id_user" => $_SESSION['id'],"id_coin" => $coin_id]);
        $coin = selectOne($table,['id' => $coin_id]);

           

    } else {
        
    $name = $_POST['name'];
    $provenience = $_POST['provenience'];
    $circulation = $_POST['circulation'];
    $description = $_POST['description'];
    $side1 = $_POST['side1'];
    $side2 = $_POST['side2'];
    $country = $_POST['country'];

        
    }

    
    
}

if(isset($_POST['login-btn'])){
    $errors = validateLogin($_POST);

    if(count($errors) === 0){
        $user = selectOne($table,['username' => $_POST['username']]);
        if($user && password_verify($_POST['password'],$user['password'])){
            // login, redirect
            userLogin($user);
        }   else {
            // login error
            array_push($errors, "Invalid username or password!");
        }
    }
}

?>