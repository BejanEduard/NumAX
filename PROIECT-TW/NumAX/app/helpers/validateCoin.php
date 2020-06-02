<?php

function validateCoin($coin){
    
    $errors = array();
    // email check

    // form check
    if(empty($_SESSION['id'])){
        array_push($errors,"You are not logged in!");
    }

    if(empty($coin['name'])){
        array_push($errors,'Name is required!');
    }

    if(empty($coin['provenience'])){
        array_push($errors,'Provenience is required!');
    }

    if(empty($coin['circulation'])){
        array_push($errors,'Circulation is required!');
    }


    if(empty($coin['description'])){
        array_push($errors,'Description is required!');
    }

    if(empty($coin['side1'])){
        array_push($errors,'Front image is required!');
    }

    if(empty($coin['side2'])){
        array_push($errors,'Reverse image is required!');
    }

    if(empty($coin['country'])){
        array_push($errors,'Country is required!');
    }

    $existingCoin = selectOne('coins',['name' => $coin['name']]);
    if(isset($existingCoin)){
        array_push($errors,'Coin already exists!');
    }

    return $errors;
}


?>