<?php
// REGISTER FORM 

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validateCoin.php");
include(ROOT_PATH . "/app/helpers/exportCoins.php");
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
$currency = '';
$composition = '';
$weight = '';
$diameter = '';
$thickness = '';
$shape = '';
$demonetized = '';
$obverse_description = '';
$reverse_description = '';


$table = 'coins';


$coins = selectAll($table);
$top_five_coins = getTopFiveCoins();


$coin = '';


if (isset($_SESSION['id'])) {
    $personal_coins = selectPersonalCoins(['users.id' => $_SESSION['id']]);

    // Calculation statistics
    $total_weight = 0;
    $number_of_coins = count($personal_coins);
    $total_diameter = 0;
    $average_diameter = 0;
    $coins_by_country = array();

    $coins_by_composition = array();
    $coins_by_circulation = array();
    $coins_by_shape = array();



    foreach ($personal_coins as $coin) {

        $total_weight += $coin['weight'];
        $total_diameter += $coin['diameter'];


        if (array_key_exists($coin['country'], $coins_by_country)) {
            $coins_by_country[$coin['country']]++;
        } else {
            // we already have a coin, so the number of coins is 1
            $coins_by_country[$coin['country']] = 1;
        }

        if (array_key_exists($coin['composition'], $coins_by_composition)) {
            $coins_by_composition[$coin['composition']]++;
        } else {
            // we already have a coin, so the number of coins is 1
            $coins_by_composition[$coin['composition']] = 1;
        }

        if (array_key_exists($coin['circulation'], $coins_by_circulation)) {
            $coins_by_circulation[$coin['circulation']]++;
        } else {
            // we already have a coin, so the number of coins is 1
            $coins_by_circulation[$coin['circulation']] = 1;
        }

        if (array_key_exists($coin['shape'], $coins_by_shape)) {
            $coins_by_shape[$coin['shape']]++;
        } else {
            // we already have a coin, so the number of coins is 1
            $coins_by_shape[$coin['shape']] = 1;
        }


    }
    if ($number_of_coins != 0) {
        $average_weight = (float)$total_weight / $number_of_coins;
        $average_diameter = round((float)$total_diameter / $number_of_coins, 1);
    }

}

if (isset($_POST['importCSV'])) {

    if ($_FILES['csvfile']['name']) {
        $filename = explode(".", $_FILES['csvfile']['name']);
        if (end($filename) == "csv") {
            $instructions = array();
            $handle = fopen($_FILES['csvfile']['tmp_name'], 'r');
            $i = 0;
            while ($data = fgetcsv($handle, 0, ",")) {
                if ($i == 0) {
                    $i++;
                } else {
                    
                    // $instructions['id'] = $data[0];
                    $instructions['name'] = $data[1];
                    $instructions['provenience'] = $data[2];
                    $instructions['circulation'] = $data[3];
                    $instructions['description'] = $data[4];
                    $instructions['side1'] = $data[5];
                    $instructions['side2'] = $data[6];
                    $instructions['country'] = $data[7];
                    $instructions['value'] = $data[8];
                    $instructions['currency'] = $data[9];
                    $instructions['composition'] = $data[10];
                    $instructions['weight'] = $data[11];
                    $instructions['diameter'] = $data[12];
                    $instructions['thickness'] = $data[13];
                    $instructions['shape'] = $data[14];
                    $instructions['obverse'] = $data[15];
                    $instructions['reverse'] = $data[16];
           
                        // Delete from $_POST array the unwanted values
                    unset($_POST['importCSV']);

                    $existingCoin = selectOne('coins', ['id' => $data[0]]);
                    if (!$existingCoin)
                        $coin_id = create('coins', $instructions);

                    $ownership_id = create('ownership', ["id_user" => $_SESSION['id'], "id_coin" => $data[0]]);
                        
                    
                    // saveImageTo ROOT_PATH/assets/img

                    $_SESSION['message'] = "Coins imported successfuly!";
                    $_SESSION['type'] = "success";

                    unset($_POST['importCSV']);



                }
            }
        } else {
            $_SESSION['message'] = "You can import only .csv files!";
            $_SESSION['type'] = 'error';
        }

    } else {
        $_SESSION['message'] = "Something went wrong with the import!";
        $_SESSION['type'] = 'error';
    }

}



if (isset($_POST['filter-btn'])) {
    $filter = array();
    if ($_POST['country'] == "All") {
        unset($_POST['country']);
    } else {
        $filter['country'] = $_POST['country'];
    }
    if ($_POST['composition'] == "All") {
        unset($_POST['composition']);
    } else {
        $filter['composition'] = $_POST['composition'];
    }
    if ($_POST['shape'] == "All") {
        unset($_POST['shape']);
    } else {
        $filter['shape'] = $_POST['shape'];
    }
    $coins = selectAll($table, $filter);
} else {
    $coins = selectAll($table);
}


if (isset($_SESSION['id']) and isset($_POST['filter-btn'])) {
    $filter['users.id'] = $_SESSION['id'];
    $personal_coins = selectPersonalCoins($filter);
    unset($_POST['filter-btn']);
} else if (isset($_SESSION['id']) and !isset($_POST['filter-btn'])) {
    $personal_coins = selectPersonalCoins(['users.id' => $_SESSION['id']]);
}



if (isset($_POST['create-btn'])) {



    $errors = validateCoin($_POST);

    if (count($errors) === 0) {
            // Delete from $_POST array the unwanted values
        unset($_POST['create-btn']);
        $sides = upload();
        $_POST['side1'] = $sides[0];
        $_POST['side2'] = $sides[1];
        $coin_id = create($table, $_POST);

        $ownership_id = create('ownership', ["id_user" => $_SESSION['id'], "id_coin" => $coin_id]);
        $coin = selectOne($table, ['id' => $coin_id]);
        
        // saveImageTo ROOT_PATH/assets/img

        $_SESSION['message'] = "Coin created successfuly!";
        $_SESSION['type'] = "success";


    } else {


        $name = $_POST['name'];
        $provenience = $_POST['provenience'];
        $circulation = $_POST['circulation'];
        $description = $_POST['description'];
        $country = $_POST['country'];
        $value = $_POST['value'];
        $currency = $_POST['currency'];
        $composition = $_POST['composition'];
        $weight = $_POST['weight'];
        $diameter = $_POST['diameter'];
        $thickness = $_POST['thickness'];
        $shape = $_POST['shape'];
        $obverse_description = $_POST['obverse'];
        $reverse_description = $_POST['reverse'];


    }


}

if (isset($_POST['add-btn'])) {



    $existingOwnership = selectOne('ownership', ["id_user" => $_SESSION['id'], "id_coin" => $_POST['id_coin']]);

    if ($existingOwnership) {
        $_SESSION['message'] = "The coin is already in your collection!";
        $_SESSION['type'] = "error";
    } else {
        $ownership_id = create('ownership', ["id_user" => $_SESSION['id'], "id_coin" => $_POST['id_coin']]);
        $_SESSION['message'] = "The coin has beeen added to your collection!";
        $_SESSION['type'] = "success";

        $personal_coins = selectPersonalCoins(['users.id' => $_SESSION['id']]);

    }

    unset($_POST);

}

if (isset($_POST['delete-btn'])) {


    $ownership_id = deleteOwnership($_POST['id_coin']);
    $_SESSION['message'] = "The coin has been removed from your collection!";
    $_SESSION['type'] = "success";

    $personal_coins = selectPersonalCoins(['users.id' => $_SESSION['id']]);


    unset($_POST);

}

if (isset($_POST['exportCSV'])) {

    exportCoins($personal_coins);

}


if (isset($_GET['id'])) {

    $coin_id = $_GET['id'];
    $existingCoin = selectOne($table, ['id' => $_GET['id']]);
    if ($existingCoin) {
        $coin = $existingCoin;
    } else {
        $_SESSION['message'] = "The coin you search in not available or existing!";
        $_SESSION['type'] = 'error';

        header('location: ' . BASE_URL . '/main.php');
    }

}
?>