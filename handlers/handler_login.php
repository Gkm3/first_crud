<?php
session_start();
include "../functions/functions_login.php";

$email = $_POST['email'];
$pass = $_POST['password'];

validate_data($email, $pass);

?>