<?php

ob_start();

# Doctype
if (is_file("doctype.custom")) {
  echo file_get_contents("doctype.custom");
} else {
  echo file_get_contents("doctype");
}

# HTML tag
if (is_file("html.custom")) {
  echo file_get_contents("html.custom");
} else {
  echo file_get_contents("html");
}

# Head
if (is_file("head.custom")) {
  $head = file_get_contents("head.custom");
} else {
  $head = file_get_contents("head");
}

# Replace metatag comments if they are present
$head = str_replace("<!-- SNB_META -->" . PHP_EOL, '', $head);
echo str_replace("<!-- /SNB_META -->" . PHP_EOL, '', $head);

# Body
if (is_file("body.custom")) {
  echo file_get_contents("body.custom");
} else {
  echo file_get_contents("body");
}

# Site Name
if (is_file("site_name.custom")) {
  echo file_get_contents("site_name.custom");
} else {
  echo file_get_contents("site_name");
}

# Create Table of Contents
echo "<ul>" . PHP_EOL;
if (is_file("toc_ascending")) {
  $files = scandir("src", SCANDIR_SORT_ASCENDING);
} else {
  $files = scandir("src", SCANDIR_SORT_DESCENDING);
}

foreach($files as $file) {
  if (is_file("src/$file")) {
    if (strpos("src/$file", ".meta") !== FALSE) {
      continue;
    }
    echo '<li><a href="' . $file . '.html">' . date("F d, Y", strtotime($file)) . "</a></li>" . PHP_EOL;
  }
}
echo "</ul>" . PHP_EOL;

# Footer of Index File
if (is_file("index_footer.custom")) {
  echo file_get_contents("index_footer.custom");
} else {
  echo file_get_contents("index_footer");
}

# Body closing tag
if (is_file("cbody.custom")) {
  echo file_get_contents("cbody.custom");
} else {
  echo file_get_contents("cbody");
}

# HTML closing tag
if (is_file("chtml.custom")) {
  echo file_get_contents("chtml.custom");
} else {
  echo file_get_contents("chtml");
}

$result = ob_get_clean();
if (!is_dir("docs")) {
  mkdir("docs");
}
file_put_contents("docs/index.html", $result);
