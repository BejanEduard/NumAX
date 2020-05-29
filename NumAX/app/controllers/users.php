<?php 

include(ROOT_PATH . "/app/database/db.php");

if(isset($_POST['register-btn'])){
    // Delete from $_POST array the unwanted values
    unset($_POST['register-btn'],$_POST['confirm-password']);
    echo_screen($_POST);
    die();
}
?>