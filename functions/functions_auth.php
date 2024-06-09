<?php
session_start();

function is_not_logged_in() {
    if(!(isset($_SESSION['user']) && !empty($_SESSION['user']['id']) && !empty($_SESSION['user']['email']))) {
        return true;
    }

    return false;
}

function redirect_to_login() {
    header("Location: ../page_login.php");
    exit;
}

function is_admin() {
    if($_SESSION['user']['role'] == 'admin') {
        return true;
    }

    return false;
}

function show_dropdown_menu($user) {
    if($_SESSION['user']['role'] == 'admin' || $_SESSION['user']['id'] == $user['id']) {
        return true;
    }

    return false;
}

function get_users() {
    include "/var/www/html/first_crud/db_conn.php";

    $query = "select * from users";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_user($id) {
    include "/var/www/html/first_crud/db_conn.php";

    $query = "select * from users where id=:id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>