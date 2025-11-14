<?php
header('Content-Type: application/json; charset=utf-8');

// ambil param amount
$amount = isset($_GET['amount']) ? $_GET['amount'] : null;

// validasi keberadaan
if ($amount === null || $amount === '') {
    echo json_encode([
        "output" => "fail",
        "content" => [
            "issue" => "amount cannot be empty"
        ]
    ], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    exit;
}

// validasi integer positif
if (!ctype_digit(strval($amount)) || intval($amount) < 1) {
    echo json_encode([
        "output" => "fail",
        "content" => [
            "issue" => "amount must be a positive integer"
        ]
    ], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    exit;
}

$len = intval($amount);

// optional: batasi panjang untuk safety (ubah atau hapus batas ini jika perlu)
$MAX_LEN = 2000;
if ($len > $MAX_LEN) {
    echo json_encode([
        "output" => "fail",
        "content" => [
            "issue" => "amount too large (max {$MAX_LEN})"
        ]
    ], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    exit;
}

// karakter (hanya huruf)
$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
$charsLen = strlen($chars);
$result = '';

// gunakan random_int untuk keamanan kripto
for ($i = 0; $i < $len; $i++) {
    $idx = random_int(0, $charsLen - 1);
    $result .= $chars[$idx];
}

// output sukses
echo json_encode([
    "output" => "work",
    "content" => [
        "amount" => $len,
        "result" => $result
    ]
], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);