<?php

function exportCoins($coins)
{
    header("Content-Type: text/csv; charset=utf-8");
    header('Content-Disposition: attachement; filename=data.csv');

    $output = fopen("php://output", 'w');
    ob_end_clean();
    fputcsv($output, array(
        'Id', 'Name', 'Provenience', 'Circulation', 'Description', 'Side1', 'Side2', 'Country', 'Value', 'Currency', 'Composition',
        'Weight', 'Diameter', 'Thickness', 'Shape', 'Obverse', 'Reverse'
    ));
    foreach ($coins as $coin) {
        fputcsv($output, $coin);
    }
    fclose($output);

    exit();
}

?>