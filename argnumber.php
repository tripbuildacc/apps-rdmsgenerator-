<?php
header("Content-Type: application/json");

// ambil nilai
$min = isset($_GET['min']) ? $_GET['min'] : null;
$max = isset($_GET['max']) ? $_GET['max'] : null;

// cek kosong
if ($min === null || $max === null || $min === "" || $max === "") {
    echo json_encode([
        "output" => "fail",
        "content" => [
            "issue" => "min or max cannot be empty"
        ]
    ], JSON_PRETTY_PRINT);
    exit;
}

// ubah ke angka (termasuk negatif)
$min = floatval($min);
$max = floatval($max);

// cek max > min
if ($max <= $min) {
    echo json_encode([
        "output" => "fail",
        "content" => [
            "issue" => "max cannot be smaller than min"
        ]
    ], JSON_PRETTY_PRINT);
    exit;
}

// generate
$result = mt_rand($min, $max);

echo json_encode([
    "output" => "work",
    "content" => [
        "min" => $min,
        "max" => $max,
        "result" => $result
    ]
], JSON_PRETTY_PRINT);