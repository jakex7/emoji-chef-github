<?php
include 'base_url.php';

header('Content-Type: image/svg+xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="no"?>';
echo '<svg xmlns="http://www.w3.org/2000/svg" width="1000" height="400">';

$pickerPath = __DIR__ . DIRECTORY_SEPARATOR . 'emoji-picker.html';
if (!file_exists($pickerPath)) {
    http_response_code(404);
    exit;
}
$realPath = realpath($pickerPath);
$baseDir = realpath(__DIR__);
if ($realPath === false || strpos($realPath, $baseDir) !== 0) {
    http_response_code(404);
    exit;
}
$pickerHtml = @file_get_contents($pickerPath);
if ($pickerHtml === false) {
    http_response_code(500);
    exit;
}


echo '<foreignObject x="0" y="0" width="300" height="400">';
echo '<div xmlns="http://www.w3.org/1999/xhtml" style="overflow: auto; height: 400px">';
// replace ?_pos with ?BASE_URL_left
$left_html = str_replace('?_pos', BASE_URL . 'set.php?left', $pickerHtml);
// Replace &zwj; with the actual Unicode character
$left_html = str_replace('&zwj;', "\u{200D}", $left_html);
echo $left_html;
echo '</div>';
echo '</foreignObject>';

echo '<foreignObject x="300" y="0" width="300" height="400">';
echo '<div xmlns="http://www.w3.org/1999/xhtml" style="overflow: auto; height: 400px">';
// replace ?_pos with BASE_URL/set.php?right
$right_html = str_replace('?_pos', BASE_URL . 'set.php?right', $pickerHtml);
// Replace &zwj; with the actual Unicode character
$right_html = str_replace('&zwj;', "\u{200D}", $right_html);
echo $right_html;
echo '</div>';
echo '</foreignObject>';

echo '<image x="600" y="0" width="400" height="400" href="/combined.php" />';

echo '</svg>';
?>