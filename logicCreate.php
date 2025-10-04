<?php
include "connectionOnDatabase.php";

if (!$connection->connect_error) {
    if (isset($_POST["create"])) {
        $id = rand(0,100);
        $name = $_POST["name"];
        $email = $_POST["email"];
       // $password=$_POST["password"];
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (id, name, email, password) VALUES('$id', '$name', '$email', '$password')";
        $result= $connection->query($sql);
        if ($result==true) {
        header("Location:login.php?statusCode=201");
            exit;
        } else {
            echo "فشل التسجيل: " . $connection->error;
        }
    }
} else {
    echo "فشل الاتصال بقاعدة البيانات: " . $connection->connect_error;
}
?>
