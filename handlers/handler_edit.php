<?php
session_start();
include "../functions/functions_edit.php";

$user_id = $_SESSION['user']['id'];
$user_name = $_POST['username'];
$job_title = $_POST['job_title'];
$phone = $_POST['phone'];
$address = $_POST['address'];

edit_info($user_id, $user_name, $job_title, $phone, $address);
$_SESSION['alert-success'] = "Профиль успешно обновлен!";
header("Location: ../page_profile.php");

?>