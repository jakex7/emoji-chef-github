<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'base_url.php';

if (isset($_GET['left'])) {
    $left = preg_replace('/[^a-f0-9\-]/', '', $_GET['left']);
    if (file_put_contents('left.txt', $left) === false) {
        // Print the last error occurred
        $error = error_get_last();
        die("Failure: " . $error['message']);
    }
}

if (isset($_GET['right'])) {
    $right = preg_replace('/[^a-f0-9\-]/', '', $_GET['right']);
    if (file_put_contents('right.txt', $right) === false) {
        // Print the last error occurred
        $error = error_get_last();
        die("Failure: " . $error['message']);
    }
}

header('Location: ' . GITHUB_URL);
exit;
?>