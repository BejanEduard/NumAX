<?php 

function exportStatistics($statistics)
{
    header("Content-Type: text/csv; charset=utf-8");
    header('Content-Disposition: attachement; filename=statistics.csv');

    $output = fopen("php://output", 'w');
    ob_end_clean();
    fputcsv($output, array(
        'Total Weight', 'Average Diameter', 'Number of Coins'
    ));

    fputcsv($output, $statistics);

    fclose($output);

    exit();
}


if (isset($_POST['statisticsCSV'])) {

    exportStatistics(array($total_weight, $average_diameter, $number_of_coins));
    unset($_POST['statisticsCSV']);

}

?>