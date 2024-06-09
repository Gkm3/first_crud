<?php 
session_start();

function validate_data($email, $pass) {
    include "/var/www/html/first_crud/db_conn.php";

    $query = "select * from users where email=:email";
    $stmt = $pdo->prepare($query);
    $stmt->execute(["email" => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if(empty($user['email'])) {
        $_SESSION['alert-danger'] = "Неверный адрес электронной почты или пароль!";
        header("Location: ../page_login.php");
        exit;
    }
    if(!password_verify($pass, $user['password'])) {
        $_SESSION['alert-danger'] = "Неверный адрес электронной почты или пароль!";
        header("Location: ../page_login.php");
        exit;
    }

    $_SESSION['user'] = ['id' => $user['id'], 'email' => $user['email'], 'role' => $user['role']];
    
    header("Location: ../users.php");
}
?>