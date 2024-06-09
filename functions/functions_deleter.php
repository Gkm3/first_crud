<?php

function delete_user($user_id) {
    include "/var/www/html/first_crud/db_conn.php";

    $query = "delete from users where id=:id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $user_id]);
}

?>