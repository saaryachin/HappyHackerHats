<?php
mysqli_report(MYSQLI_REPORT_OFF);
error_reporting(0);

$db_host = getenv('DB_HOST') ?: "localhost";
$db_user = getenv('DB_USER') ?: "hatter";
$db_pass = getenv('DB_PASSWORD') ?: "whitehat";
$db_name = getenv('DB_NAME') ?: "whitehat";

$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$link) {
  die("Database connection failed.");
}

mysqli_set_charset($link, "utf8mb4");
?>
