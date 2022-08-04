<?php

# Wipe out docs
if (is_dir("docs")) {
  $files = scandir("docs");
  foreach($files as $file) {
    if (is_file("docs/$file")) {
      unlink("docs/$file");
    }
  }
}

system("php index.php");
system("php content.php");
system("php book.php");

if (is_file("style.css.custom")) {
  copy("style.css.custom", "docs/style.css");
} else {
  copy("style.css", "docs/style.css");
}

if (is_file("favicon.ico.custom")) {
  copy("favicon.ico.custom", "docs/favicon.ico");
} else {
  copy("favicon.ico", "docs/favicon.ico");
}

copy("error.html", "docs/error.html");

copy("robots.txt", "docs/robots.txt");

