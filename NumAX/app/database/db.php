<?php 
session_start();
require('connect.php');


// This function in temporary, for database testing.
function echo_screen($value)
{
    echo "<pre>", print_r($value, true), "</pre>";
    die();
}

// prepare the query for execution then return it
function executeQuery($sql, $data)
{
    global $conn;
    $stmt = $conn->prepare($sql);
    // key values from conditions
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt;
}


// Select all elements from a given table.
function selectAll($table, $conditions = [])
{
    global $conn;
    $sql = "SELECT * FROM $table";
    if (empty($conditions)) {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $results;
    } else {
        // Return only records that match the conditions 
        $i = 0;
        foreach ($conditions as $key => $value) {
            if ($i === 0)
                $sql = $sql . " WHERE $key=?";
            else {
                $sql = $sql . " AND $key=?";
            }
            $i++;
        }

    }
    $stmt = executeQuery($sql, $conditions);
    $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $results;

}

// Select only one element from a given table.
function selectOne($table, $conditions)
{
    global $conn;
    $sql = "SELECT * FROM $table";
    
        // Return only records that match the conditions 
    $i = 0;
    foreach ($conditions as $key => $value) {
        if ($i === 0)
            $sql = $sql . " WHERE $key=?";
        else {
            $sql = $sql . " AND $key=?";
        }
        $i++;
    }

    $sql = $sql . " LIMIT 1";


    $stmt = executeQuery($sql, $conditions);
    $results = $stmt->get_result()->fetch_assoc();
    return $results;

}

// Select all elements from a given table with JOIN.
function selectPersonalCoins($conditions)
{

    $sql = "SELECT coins.* FROM coins JOIN ownership ON coins.id=ownership.id_coin 
                                      JOIN users ON ownership.id_user=users.id ";

    $i = 0;
    foreach ($conditions as $key => $value) {
    if ($i === 0)
        $sql .= " WHERE $key=?";
    else {
        $sql .= " AND $key=?";
    }
    $i++;
}
    $stmt = executeQuery($sql, $conditions);
    $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $results;

}

// Function for creating an element in the database
function create($table, $data)
{
    global $conn;
    $sql = "INSERT INTO $table SET ";
    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0)
            $sql = $sql . " $key=?";
        else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }

    $stmt = executeQuery($sql, $data);
    $id = $stmt->insert_id;
    return $id;
}

// Update a record in given table
function update($table, $id, $data)
{
    global $conn;
    $sql = "UPDATE $table  SET ";
    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0)
            $sql = $sql . " $key=?";
        else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }

    $sql = $sql . " WHERE id=?";
    $data['id'] = $id;
    $stmt = executeQuery($sql, $data);
    return $stmt->affected_rows;
}

function delete($table, $id)
{
    global $conn;
    $sql = "DELETE FROM $table WHERE id=?";
    $stmt = executeQuery($sql, ["id" => $id]);
    return $stmt->affected_rows;
}

function deleteOwnership($id_coin)
{
    global $conn;
    $sql = $sql = "DELETE FROM ownership WHERE id_coin=?";
    $stmt = executeQuery($sql, ["id_coin" => $id_coin]);
    return $stmt->affected_rows;
}


?>