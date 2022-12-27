<?php
include_once ('variables_and_passwords.php');
$link = mysqli_connect($host_name, $user_name, $pass_word, ""); //переменные лежат в variables_and_passwords.php
if ($link === false) {
    die("Ошибка: Не можем подключиться. " . mysqli_connect_error());
}
echo "Connect Successfully. Host info: " . mysqli_get_host_info($link) . "
";
