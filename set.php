<?php
include 'base_url.php';

// Validate emoji code against whitelist of allowed files
function getValidEmojiCodes() {
    $codes = array();
    $combinationsDir = __DIR__ . DIRECTORY_SEPARATOR . 'combinations';
    
    if (is_dir($combinationsDir)) {
        $files = scandir($combinationsDir);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..' && pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                $codes[] = pathinfo($file, PATHINFO_FILENAME);
            }
        }
    }
    return $codes;
}

$validCodes = getValidEmojiCodes();

if (isset($_GET['left'])) {
    $left = basename($_GET['left']);
    $left = preg_replace('/[^a-f0-9\-]/', '', $left);
    
    if (!empty($left) && in_array($left, $validCodes, true)) {
        if (file_put_contents('left.txt', $left) === false) {
            http_response_code(500);
            exit;
        }
    }
}

if (isset($_GET['right'])) {
    $right = basename($_GET['right']);
    $right = preg_replace('/[^a-f0-9\-]/', '', $right);
    
    if (!empty($right) && in_array($right, $validCodes, true)) {
        if (file_put_contents('right.txt', $right) === false) {
            http_response_code(500);
            exit;
        }
    }
}

header('Location: ' . GITHUB_URL);
exit;
?>