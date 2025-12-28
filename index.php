<?php
include 'base_url.php';

header('Content-Type: image/svg+xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="no"?>';
echo '<svg xmlns="http://www.w3.org/2000/svg" width="1000" height="400">';

echo '<foreignObject x="0" y="0" width="300" height="400">';
// replace ?_pos with ?BASE_URL_left
$left_html = str_replace('?_pos', BASE_URL . 'set.php?left', file_get_contents('emoji-picker.html'));
// Replace &zwj; with the actual Unicode character
$left_html = str_replace('&zwj;', "\u{200D}", $left_html);
echo $left_html;
echo '</foreignObject>';

echo '<foreignObject x="300" y="0" width="300" height="400">';
// replace ?_pos with BASE_URL/set.php?right
$right_html = str_replace('?_pos', BASE_URL . 'set.php?right', file_get_contents('emoji-picker.html'));
// Replace &zwj; with the actual Unicode character
$right_html = str_replace('&zwj;', "\u{200D}", $right_html);
echo $right_html;
echo '</foreignObject>';

echo '<image x="600" y="0" width="400" height="400" href="/combined.php" />';

echo '</svg>';
?>