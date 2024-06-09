<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../functions/functions_deleter.php";

$user_id = (int) $_GET['id'];

if($_SESSION['user']['role'] === "admin") {
    delete_user($user_id);

    $_SESSION['alert-success'] = "Пользовать удален!";
    header("Location: ../users.php");
    exit;
}
if($_SESSION['user']['id'] === $user_id) {
    delete_user($user_id);

    $_SESSION['alert-success'] = "Пользовать удален!";
    header("Location: ../page_register.php");
    exit;
}


?>