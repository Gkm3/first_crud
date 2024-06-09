<?php
session_start();
include "../functions/functions_edit.php";

$user_id = $_GET['id'];
$image = $_FILES['avatar'];
upload_image($user_id, $image);

$_SESSION['alert-success'] = 'Профиль успешно добавлен!';
header("Location: ../page_profile.php?id=" . $user_id);

?>