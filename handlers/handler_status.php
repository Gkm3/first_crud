<?php
session_start();
include "../functions/functions_edit.php";

$user_id = $_GET['id'];
$status = $_POST['status'];

set_status($user_id, $status);
$_SESSION['alert-success'] = "Статус успешно обновлен!";
header("Location: ../page_profile.php?id=" . $user_id);

?>