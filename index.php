<?php
require 'variables_and_passwords.php';

$mysqli = mysqli_connect($host_name, $user_name, $pass_word, 'test_database'); //переменные лежат в variables_and_passwords.php
if (!$mysqli) {
    die("Connection error: " . mysqli_connect_error());
}

$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : false;


if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if($mode === 'admin_panel') {
        $email = trim($_REQUEST['email']);
        $user = $mysqli->query("SELECT email, password FROM customers where email = '$email' limit 1");
        $user = mysqli_fetch_array($user, MYSQLI_ASSOC);

        if ($user) {
            if(password_verify(trim($_REQUEST['password']), $user['password'])) {
                $customers = $mysqli->query("SELECT * FROM customers");
                
                while($result = mysqli_fetch_array($customers, MYSQLI_ASSOC)) {
                    
                    $users[] = $result;
                    
                }

                require 'users.html';
            } else {
                $failed_verify = 'true';
                require 'auth.html';
            }
    
        }

        exit;
    }

    $first_name = trim($_REQUEST['first_name']);
    $last_name = trim($_REQUEST['last_name']);
    $email = trim($_REQUEST['email']);
    $password = password_hash(trim($_REQUEST['password']), PASSWORD_BCRYPT);
    $gender = trim($_REQUEST['gender']);
    $agreement = trim($_REQUEST['agreement']);
    $age = $_REQUEST['age'];
    $personal_info = $_REQUEST['personal_info'];



    $user_is_created = $mysqli->query("INSERT INTO `customers` (`first_name`, `last_name`, `email`, `password`, `gender`, `agreement`, `age`, `personal_info`) 
    VALUES ('$first_name', '$last_name', '$email', '$password', '$gender', '$agreement', '$age', '$personal_info')");

    require_once('phpmailer/PHPMailerAutoload.php');
    $mail = new PHPMailer;
    $mail->CharSet = 'utf-8';

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    $mail->isSMTP();
    $mail->Host = 'smtp.mail.ru';
    $mail->SMTPAuth = true;
    $mail->Username = 'randomname2001@mail.ru';
    $mail->Password = 'z5UhQqvk695t8xaWE8e8';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('randomname2001@mail.ru');
    $mail->addAddress($send_email_to); //Указать почтовый ящик, на который отправлять письмо

    $mail->isHTML(true);

    $mail->Subject = 'Письмо с тестового сайта';
    $mail->Body = '' .$first_name . ' ' . $last_name . ' '. 'зарегистрирован';
    $mail->AltBody = '';

    $mail->send();


}



if ($mode === 'auth') {
    require 'auth.html';
} else {
    require 'index.html';
}


exit;