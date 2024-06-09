<?php
session_start();
include "../functions/functions_edit.php";

$user_id = $_GET['id'];
$email = $_POST['email'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

edit_credentials($user_id, $email, $pass);

?>