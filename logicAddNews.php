<?php
session_start();
include "connectionOnDatabase.php";

// استلام البيانات من الفورم
$news_name    = $_POST["news_name"];
$category     = $_POST["category"];
$news_details = $_POST["news_details"];
$news_image   = $_POST["news_image"];
$user_id      = $_POST["user_id"]; // أو من السيشن

$sql = "INSERT INTO news (news_name, category, news_details, news_image, user_id)
        VALUES ('$news_name', '$category', '$news_details', '$news_image', '$user_id')";

$result = $connection->query($sql);

if ($result == true) {
    header("Location: dashboard.php");
    exit;
} else {
    echo "فشل التسجيل: " . $connection->error;
}
?>
