<?php
header("Content-Type: application/json");

// ambil amount
$amount = isset($_GET["amount"]) ? $_GET["amount"] : "";

// cek kosong
if ($amount === "") {
    echo json_encode([
        "output" => "fail",
        "content" => [
            "issue" => "amount cannot be empty"
        ]
    ], JSON_PRETTY_PRINT);
    exit;
}

// cek angka valid
if (!is_numeric($amount)) {
    echo json_encode([
        "output" => "fail",
        "content" => [
            "issue" => "amount must be a number"
        ]
    ], JSON_PRETTY_PRINT);
    exit;
}

// pastikan minimal 1
$amount = intval($amount);
if ($amount < 1) {
    echo json_encode([
        "output" => "fail",
        "content" => [
            "issue" => "amount must be greater than 0"
        ]
    ], JSON_PRETTY_PRINT);
    exit;
}

// karakter pembentuk password
$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";

// generate
$password = "";
for ($i = 0; $i < $amount; $i++) {
    $password .= $chars[random_int(0, strlen($chars) - 1)];
}

// output berhasil
echo json_encode([
    "output" => "work",
    "content" => [
        "amount" => $amount,
        "result" => $password
    ]
], JSON_PRETTY_PRINT);