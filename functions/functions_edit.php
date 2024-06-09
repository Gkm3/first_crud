<?php
session_start();

function edit_info($id, $user_name, $job_title, $phone, $address) {
    include "/var/www/html/first_crud/db_conn.php";

    $query = "update users set username=:username, job_title=:job_title, phone=:phone, address=:address where id=:id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id, 'username' => $user_name, 'job_title' => $job_title, 'phone' => $phone, 'address' => $address]);
}

function set_status($id, $status) {
    include "/var/www/html/first_crud/db_conn.php";

    $query = "update users set status=:status where id=:id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id, 'status' => $status]);
}

function upload_image($id, $image) {
    include "/var/www/html/first_crud/db_conn.php";

    $spl = new SplFileInfo($image['name']);
    $extenstion = $spl->getExtension();
    $unique_name = uniqid() . '.' . $extenstion;
    $path = "../upload/" . $unique_name;

    if(!file_exists("../upload")) {
        mkdir("../upload");
    }
    move_uploaded_file($image['tmp_name'], $path);

    $query = "update users set image=:image where id=:id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id, 'image' => $unique_name]);
}

function has_image($id) {
    include "/var/www/html/first_crud/db_conn.php";

    $query = "select * from users where id=:id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!empty($user['image'])) {
        return true;
    }

    return false;
}

function add_social_links($id, $vk, $telegram, $instagram) {
    include "/var/www/html/first_crud/db_conn.php";

    $query = "update users set vk=:vk, telegram=:telegram, instagram=:instagram where id=:id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id, 'vk' => $vk, 'telegram' => $telegram, 'instagram' => $instagram]);
}

function edit_credentials($id, $email, $pass) {
    include "/var/www/html/first_crud/db_conn.php";
    include_once "functions_auth.php";
    $user = get_user($id);

    if($user['email'] === $email) {
        $query = "update users set password=:password where email=:email";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['password' => $pass, 'email' => $email]);

        $_SESSION['alert-success'] = "Пароль успешно обновлен!";
        header("Location: ../page_profile.php?id=".$id);
        exit;
    }
    if(is_account_exists_db($email)) {
        header("Location: ../security.php?id=".$id);
        exit;
    }

    $query = "update users set password=:password, email=:email where id=:id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id, 'password' => $pass, 'email' => $email]);

    $_SESSION['alert-success'] = "Профиль успешно обновлен!";
    header("Location: ../page_profile?id=".$id);
}

?>