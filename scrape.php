<?php

$content = '';
$files = scandir("src", SCANDIR_SORT_DESCENDING);
foreach($files as $file) {
  if ($file != '.' && $file != '..') {
    $content .= file_get_contents('src/' . $file);
    $content .= "\n";
    $content = str_replace('</h1>', "\n", $content);
    $content = str_replace('<h1>', "", $content);
    $content = str_replace('</p>', "\n", $content);
    $content = str_replace('<p>', "", $content);
    $content = str_replace('</pre>', "\n", $content);
    $content = str_replace('<pre>', "", $content);
    $content = str_replace('</li>', "\n", $content);
    $content = str_replace('<li>', "", $content);
    $content = str_replace('</ul>', "\n", $content);
    $content = str_replace('<ul>', "", $content);
  }
}

file_put_contents('scrape.txt', $content);
