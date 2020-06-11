<?php
include("C:/xampp/htdocs/PROIECT-TW/NumAX/path.php");
include(ROOT_PATH . '/app/database/connect.php');
if (isset($_GET['search-text'])) {


  $searchString = array();
  $searchString['name'] = '%' . $_GET['search-text'] . '%';
  $sql = "SELECT id,name FROM coins WHERE name LIKE ?";
  $sql .= " LIMIT 10";
  $stmt = $conn->prepare($sql);
  $values = array_values($searchString);
  $types = str_repeat('s', count($values));
  $stmt->bind_param($types, ...$values);
  $stmt->execute();
  $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  if (!empty($results)) {
    echo "<ul>";
    foreach ($results as $row) {
      echo '<li><a href="' . BASE_URL . '\coin.php?id=' . $row['id'] . '"' . '</a>' . $row['name'] . '</li>';
    }
    echo "</ul>";
  } else {
    echo "<ul>";
    echo '<li><a href="#"</a>' . 'No results found...' . '</li>';
    echo "</ul>";
  }
}
?>