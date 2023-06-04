<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/util.php';

$post_data = file_get_contents('php://input');
$user_data = json_decode($post_data, true);
header('Content-Type: application/json; charset=utf-8');

$stmt = pdo()->prepare('SELECT 1 FROM `users` WHERE `login` = :login');
$stmt->execute(['login' => $user_data['login']]);
if ($stmt->rowCount() > 0) {
    send_error('Это имя пользователя уже занято');
    exit();
}

$stmt = pdo()->prepare('INSERT INTO `users` (`login`, `password`) 
                        VALUES (:login, :password)');

$stmt->execute([
    'login' => $user_data['login'],
    'password' => password_hash($user_data['password'], PASSWORD_DEFAULT),
]);

$stmt = pdo()->prepare('SELECT `user_id` FROM `users` WHERE login = :login');
$stmt->execute([
    'login' => $user_data['login'],
]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

setcookie('user_id', $user['user_id'], time() + 3600);
header('Content-Type: application/json; charset=utf-8');
echo json_encode(['user_id' => $user['user_id']]);