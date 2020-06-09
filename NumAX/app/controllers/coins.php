<?php
// REGISTER FORM 

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validateCoin.php");
include(ROOT_PATH . "/app/helpers/uploadSides.php");


    $errors = array();
    $sides = array();
    $name = '';
    $provenience = '';
    $circulation = '';
    $description = '';
    $side1 = '';
    $side2 = '';
    $country = '';
    $value = '';
    $currency ='';
    $composition= '';
    $weight = '';
    $diameter ='';
    $thickness = '';
    $shape = '';
//    $demonetized = '';
    $obverse_description = '';
    $reverse_description = '';
    $coin = '';

    $table = 'coins';
    if(isset($_POST['filter-btn']) ){
    $filter=array();
    if($_POST['country']== "All"){
        unset($_POST['country']);}
        else{$filter['country']=$_POST['country'];}
    if($_POST['composition'] =="All"){
        unset($_POST['composition']);}
        else{$filter['composition']=$_POST['composition'];}
    if($_POST['shape'] =="All"){
        unset($_POST['shape']);}
    else{$filter['shape']=$_POST['shape'];}
    $coins=selectAll($table,$filter);
    }
    else{$coins = selectAll($table);}
    
    if(isset($_SESSION['id']) AND isset($_POST['filter-btn'])){
            $filter['users.id']=$_SESSION['id'];
            $personal_coins = selectPersonalCoins($filter);
            unset($_POST['filter-btn']);
        }else{
        $personal_coins = selectPersonalCoins(['users.id'=>$_SESSION['id']]);  
        }

    
if(isset($_POST['create-btn'])){
     

    $errors = validateCoin($_POST);

    if(count($errors) === 0){
            // Delete from $_POST array the unwanted values
        unset($_POST['create-btn']);
        $sides=upload();
        $_POST['side1']=$sides[0];
        $_POST['side2']=$sides[1];
        $coin_id = create($table,$_POST);
        
        $ownership_id = create('ownership',["id_user" => $_SESSION['id'],"id_coin" => $coin_id]);
        $coin = selectOne($table,['id' => $coin_id]);
        
        // saveImageTo ROOT_PATH/assets/img

        $_SESSION['message'] = "Coin created successfuly!";
        $_SESSION['type'] = "success";
           

    } else {
        
    $name = $_POST['name'];
    $provenience = $_POST['provenience'];
    $circulation = $_POST['circulation'];
    $description = $_POST['description'];
    $side1 = $_POST['side1'];
    $side2 = $_POST['side2'];
    $country = $_POST['country'];
    $value = $_POST['value'];
    $currency =$_POST['currency'];
    $composition=$_POST['composition'];
    $weight = $_POST['weight'];
    $diameter =$_POST['diameter'];
    $thickness = $_POST['thickness'];
    $shape = $_POST['shape'];
  //  $demonetized = $_POST['demonetized'];
    $obverse_description = $_POST['obverse'];
    $reverse_description = $_POST['reverse'];

        
    }
 
    
}

if(isset($_POST['add-btn'])){

        

        $existingOwnership = selectOne('ownership',["id_user" => $_SESSION['id'],"id_coin" => $_POST['id_coin']]);
        
        if($existingOwnership){  
            $_SESSION['message'] = "The coin is already in your collection!";
            $_SESSION['type'] = "error";
        }
        else {
        $ownership_id = create('ownership',["id_user" => $_SESSION['id'],"id_coin" => $_POST['id_coin']]);
            $_SESSION['message'] = "The coin has beeen added to your collection!";
            $_SESSION['type'] = "success";
            
            $personal_coins = selectPersonalCoins(['users.id' => $_SESSION['id']]);    
            
        }
        
        unset($_POST);
        
}

if(isset($_POST['delete-btn'])){

        
        $ownership_id = deleteOwnership($_POST['id_coin']);
        $_SESSION['message'] = "The coin has been removed from your collection!";
        $_SESSION['type'] = "success";

        $personal_coins = selectPersonalCoins(['users.id' => $_SESSION['id']]);

    
    unset($_POST);
    
}

if(isset($_GET['id'])){

    $coin_id = $_GET['id'];
    $existingCoin = selectOne($table,['id' =>$_GET['id']]);
    if($existingCoin){
        $coin = $existingCoin;
    } else {
        $_SESSION['message'] = "The coin you search in not available or existing!";
        $_SESSION['type'] = 'error';
        
        header('location: ' . BASE_URL .'/main.php');
    }
    
}


?>