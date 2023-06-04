<?php

function send_error($error) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => false, 'err' => $error]);
}