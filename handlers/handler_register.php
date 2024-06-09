<?php
session_start();
include "../functions/functions_register.php";

$email = $_POST['email'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

if(is_account_exists_db($email)) {
    header("Location: ../page_register.php");
    exit;
}

create_account($email, $pass);
$_SESSION["alert-success"] = "<strong>Регистрация прошла успешно!</strong>";
header("Location: ../page_login.php");



?>