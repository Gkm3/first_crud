<?php
session_start();
include "../functions/functions_register.php";
include "../functions/functions_edit.php";

$email = $_POST['email'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

if(is_account_exists_db($email)) {
    header("Location: ../create_user.php");
    exit;
}

$user_name = $_POST['username'];
$job_title = $_POST['job_title'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$status = $_POST['status'];
$image = $_FILES['avatar'];
$vk = $_POST['vk'];
$telegram = $_POST['telegram'];
$instagram = $_POST['instagram'];


$user_id = create_account($email, $pass);
edit_info($user_id, $user_name, $job_title, $phone, $address);
set_status($user_id, $status);
upload_image($user_id, $image);
add_social_links($user_id, $vk, $telegram, $instagram);

$_SESSION['alert-success'] = "<string>Профиль успешно добавлен</string>";
header("Location: ../users.php");

?>