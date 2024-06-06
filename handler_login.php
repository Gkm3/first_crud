<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$email = $_POST['email'];
$pass = $_POST['password'];

validate_data($email, $pass);


function validate_data($email, $pass) {
    include_once "./db_conn.php";

    $query = "select * from accounts where email=:email";
    $stmt = $pdo->prepare($query);
    $stmt->execute(["email" => $email]);
    $account = $stmt->fetch(PDO::FETCH_ASSOC);

    if(empty($account['email'])) {
        $_SESSION['alert-danger'] = "Неверный адрес электронной почты или пароль!";
        header("Location: ./page_login.php");
        exit;
    }
    if(!password_verify($pass, $account['password'])) {
        $_SESSION['alert-danger'] = "Неверный адрес электронной почты или пароль!";
        header("Location: ./page_login.php");
        exit;
    }

    $_SESSION['user'] = ['id' => $account['id'], 'email' => $account['email']];
    
    header("Location: ./users.php");
}

?>