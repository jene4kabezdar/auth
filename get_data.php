<?php
require_once __DIR__.'/db.php';

$post_data = file_get_contents('php://input');
$user_data = json_decode($post_data, true);

$stmt = pdo()->prepare('SELECT `name`, `photo`, `dob` FROM `users`
                            WHERE `user_id` = :user_id');
$stmt->execute(['user_id' => (int) $user_data['user_id']]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($user);