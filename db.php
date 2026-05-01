<?php
mysqli_report(MYSQLI_REPORT_OFF);
error_reporting(0);

define("DB_SERVER", "localhost");
define("DB_USERNAME", "hatter");
define("DB_PASSWORD", "whitehat");
define("DB_NAME", "whitehat");

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$link) {
  die("Database connection failed.");
}

mysqli_set_charset($link, "utf8mb4");
?>
