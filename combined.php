<?php

function sanitize_filename($input) {
    return preg_replace('/[^a-zA-Z0-9_\-]/', '', trim($input));
}

$leftPath = __DIR__ . '/left.txt';
$rightPath = __DIR__ . '/right.txt';

if (!is_readable($leftPath) || !is_readable($rightPath)) {
    http_response_code(500);
    echo 'Configuration error';
    exit;
}

$leftRaw = file_get_contents($leftPath);
$rightRaw = file_get_contents($rightPath);

$left = sanitize_filename($leftRaw);
$right = sanitize_filename($rightRaw);

$jsonFilePath = __DIR__ . '/combinations/' . $left . '.json';

if (!is_readable($jsonFilePath)) {
    http_response_code(404);
    echo 'Combination not found';
    exit;
}

$combinations = json_decode(file_get_contents($jsonFilePath), true);

if (!is_array($combinations)) {
    http_response_code(500);
    exit;
}

// Check if the $right key exists
if (isset($combinations[$right])) {
    $imageUrl = $combinations[$right];

    header('Content-Type: image/png');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
    readfile($imageUrl);
    exit;
}

http_response_code(404);
echo 'Combination not found';
?>