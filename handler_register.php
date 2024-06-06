<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$email = $_POST['email'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

is_account_exists_db($email);
create_account($email, $pass);


function create_account($email, $pass) {
    include "./db_conn.php";

    $query = "insert into accounts (email, password) values (:email, :password)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $pass);
    $stmt->execute();

    $_SESSION["alert-success"] = "Регистрация успешна";
    header("Location: ./page_login.php");
}


function is_account_exists_db($email) {
    include "./db_conn.php";

    $sql = "select email from accounts where email=:email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["email" => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!empty($user['email'])) {
        $_SESSION["alert-danger"] = "<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.";
        header("Location: ./page_register.php");
        exit;
    }
}


?>