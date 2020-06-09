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

    if(empty($_FILES['side1']['name'])){
        array_push($errors,'Front image is required!');
    }

    if(empty($_FILES['side2']['name'])){
        array_push($errors,'Reverse image is required!');
    }

    if(empty($coin['country'])){
        array_push($errors,'Country is required!');
    }

    if(empty($coin['value'])){
        array_push($errors,'Value is required!');
    }
    
    if(empty($coin['currency'])){
        array_push($errors,'Currency is required!');
    }

    if(empty($coin['composition'])){
        array_push($errors,'Composition is required!');
    }

    if(empty($coin['weight'])){
        array_push($errors,'Weight is required!');
    } else if(!is_numeric($coin['weight'])) {
        array_push($errors,'Weight should be numeric!');
    }

    if(empty($coin['diameter'])){
        array_push($errors,'Diameter is required!');
    } else if(!is_numeric($coin['diameter'])) {
        array_push($errors,'Diameter should be numeric!');
    }

    if(empty($coin['thickness'])){
        array_push($errors,'Thickness is required!');
    } else if(!is_numeric($coin['thickness'])) {
        array_push($errors,'Thickness should be numeric!');
    }
    
    if(empty($coin['shape'])){
        array_push($errors,'Shape is required!');
    }

    if(empty($coin['obverse'])){
        array_push($errors,'Obverse Description is required!');
    }

    if(empty($coin['reverse'])){
        array_push($errors,'Reverse Description is required!');
    }


    $existingCoin = selectOne('coins',['name' => $coin['name']]);
    if(isset($existingCoin)){
        array_push($errors,'Coin already exists!');
    }

    return $errors;
}


?>