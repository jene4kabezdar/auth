<?php
function pdo() {
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ];
    $pdo = new PDO(
        "mysql:dbname=test_task;host=localhost",
        "admin",
        "z[04ejxty1vyju@Pizza",
        $options,
    );
    
    $pdo->SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}