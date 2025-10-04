<?php
include "connectionOnDatabase.php";

if ($connection->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $connection->connect_error);
}

if (isset($_POST["add_category"])) {
    $name = $_POST["category_name"];
    $description = $_POST["category_description"];

    $sql = "INSERT INTO category (category_name, category_description) 
            VALUES ('$name', '$description')";

    if ($connection->query($sql) === TRUE) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "فشل التسجيل: " . $connection->error;
    }
}
?>
