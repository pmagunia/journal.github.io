<?php

$book = '';

# Doctype
if (is_file("doctype.custom")) {
  $book .= file_get_contents("doctype.custom");
} else {
  $book .= file_get_contents("doctype");
}

# HTML tag
if (is_file("html.custom")) {
  $book .= file_get_contents("html.custom");
} else {
  $book .= file_get_contents("html");
}

# Head
if (is_file("head.custom")) {
  $head = file_get_contents("head.custom");
} else {
  $head = file_get_contents("head");
}

# Replace default metatags if they are set
if (is_file('src/book.meta')) {
  $pattern = '/<!-- SNB_META -->(.*)<!-- \/SNB_META -->' . PHP_EOL . '/s';
  $replacement = file_get_contents("src/$file.meta");
  $book .= preg_replace($pattern, $replacement, $head);
} else {
  $book .= $head;
}

# Body
if (is_file("body.custom")) {
  $book .= file_get_contents("body.custom");
} else {
  $book .= file_get_contents("body");
}

# Get all content for book
if (is_file("toc_ascending")) {
  $book_files = scandir("src", SCANDIR_SORT_ASCENDING);
} else {
  $book_files = scandir("src", SCANDIR_SORT_DESCENDING);
}

# Footer of Index File
if (is_file("footer.custom")) {
  $footer = file_get_contents("footer.custom");
} else {
  $footer = file_get_contents("footer");
}

foreach($book_files as $book_file) {
  if (is_file("src/$book_file")) {
    if (strpos("src/$book_file", ".meta") !== FALSE) {
      continue;
    }
	$book .= PHP_EOL . '<br />' . file_get_contents("src/$book_file") . PHP_EOL . $footer . PHP_EOL . '<br /><br />';
  }
}

# Body closing tag
if (is_file("cbody.custom")) {
  $book .= file_get_contents("cbody.custom");
} else {
  $book .= file_get_contents("cbody");
}

# HTML closing tag
if (is_file("chtml.custom")) {
  $book .= file_get_contents("chtml.custom");
} else {
  $book .= file_get_contents("chtml");
}

file_put_contents("docs/book.html", $book);
