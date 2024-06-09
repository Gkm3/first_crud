<?php
session_start();

function create_account($email, $pass) {
    include "/var/www/html/first_crud/db_conn.php";

    $query = "insert into users (email, password, role) values (:email, :password, 'user')";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $pass);
    $stmt->execute();

    $query = "select id from users where email=:email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user_id = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user_id['id'];
}

function is_account_exists_db($email) {
    include "/var/www/html/first_crud/db_conn.php";

    $sql = "select email from users where email=:email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["email" => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!empty($user['email'])) {
        $_SESSION["alert-danger"] = "<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.";
        return true;
    }

    return false;
}

?>