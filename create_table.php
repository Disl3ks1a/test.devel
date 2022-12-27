<?php

include_once("connect.php");
$select_db = "USE test_database";
if (mysqli_query($link, $select_db)) {
    echo "Database selected successfully.";
} else {
    echo "ERROR: Could not able to execute $select_db. " . mysqli_error($link);
}
// Attempt create table query execution
$sql = "CREATE TABLE customers(
    id INT(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(256) NOT NULL,
    last_name VARCHAR(256) NOT NULL,
    email VARCHAR(256) NOT NULL UNIQUE,
    password VARCHAR(256) NOT NULL UNIQUE,
    gender VARCHAR(256) NOT NULL,
    agreement VARCHAR(256) NOT NULL,
    age VARCHAR(256),
    personal_info VARCHAR(256)
    )
";
if (mysqli_query($link, $sql)) {
    echo "Table created successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>