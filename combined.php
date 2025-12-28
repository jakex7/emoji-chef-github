<?php
$left = file_get_contents('left.txt');
$right = file_get_contents('right.txt');

$combinations = json_decode(file_get_contents('combinations/' . $left . '.json'), true);
$url = $combinations[$right];

if ($url) {
    header('Content-Type: image/png');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
    readfile($url);
} else {
    http_response_code(404);
    echo 'Combination not found';
}

?>