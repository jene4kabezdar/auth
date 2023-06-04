<?php
require_once __DIR__.'/db.php';
require_once __DIR__.'/util.php';

$post_data = file_get_contents('php://input');
$user_data = json_decode($post_data, true);

$stmt = pdo()->prepare('SELECT `user_id`, `login`, `password` FROM `users` 
                        WHERE `login` = :login');
$stmt->execute(['login' => $user_data['login']]);
if (!$stmt->rowCount()) {
    send_error('Пользователь с такими данными не зарегистрирован');
    exit();
}

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (password_verify($user_data['password'], $user['password'])) {
    setcookie('user_id', $user['user_id'], time() + 3600);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['user_id' => $user['user_id']]);
    exit();
}

send_error('Пароль неверен');