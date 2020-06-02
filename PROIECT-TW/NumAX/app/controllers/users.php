<?php
// REGISTER FORM 


include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validateUser.php");

    $errors = array();
    $username = '';
    $email = '';
    $table = 'users';

function userLogin($user){
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] =$user['username'];
        $_SESSION['message'] = "Login successful!";
        $_SESSION['type'] = "success";
        // redirect
        header('location: ' . BASE_URL .'/main.php');
        exit();
}



if(isset($_POST['register-btn'])){
     

    $errors = validateUser($_POST);

    if(count($errors) === 0){
            // Delete from $_POST array the unwanted values
        unset($_POST['register-btn'],$_POST['confirm-password']);

        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $user_id = create($table,$_POST);
        $user = selectOne($table,['id' => $user_id]);

        // log in user
        userLogin($user);
        

    } else {
        
        $username = $_POST['username'];
        $email = $_POST['email'];
        
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