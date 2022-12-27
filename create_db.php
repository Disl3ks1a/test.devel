<?php

include_once("connect.php");
$sql = "CREATE DATABASE test_database CHARACTER SET utf8 COLLATE utf8_general_ci";
if (mysqli_query($link, $sql)) {
    echo "Database created successfully";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

mysqli_close($link);