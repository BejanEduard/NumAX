<?php 
include("path.php");
include(ROOT_PATH . "/app/controllers/coins.php");

header("Content-Type:text/xml;charset=iso-8859-1");



echo "<?xml version='1.0' encoding='UTF-8'  ?>" . PHP_EOL;

echo "<rss version='2.0'>" . PHP_EOL;

echo "<channel>" . PHP_EOL;

echo "<title> RSS  NumAX </title>" . PHP_EOL;

echo "<link>" . BASE_URL . "rss.php" . "</link>" . PHP_EOL;

echo "<description>TOP FIVE COINS</description>" . PHP_EOL;

echo "<language>en-us</language>" . PHP_EOL;

foreach ($top_five_coins as $coin) {
    echo "<item xmlns:dc='ns:1'>" . PHP_EOL;
    echo "<title>" . $coin['name'] . "</title>" . PHP_EOL;
    echo "<link>" . BASE_URL . '\coin.php?id=' . $coin['id'] . "</link>" . PHP_EOL;
    echo "<guid>" . md5($coin['id']) . "</guid>" . PHP_EOL;
    echo "<description>" . 'Number of Owners: ' . $coin['number'] . "</description>" . PHP_EOL;

    echo "<category> NumAX </category>" . PHP_EOL;
    echo "</item>" . PHP_EOL;
}

echo "</channel>" . PHP_EOL;

echo "</rss>" . PHP_EOL;


?>