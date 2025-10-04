<?php
session_start();

// مسح جميع بيانات الجلسة
session_unset(); 

// تدمير الجلسة بالكامل
session_destroy();

// إعادة التوجيه لصفحة تسجيل الدخول
header("Location: login.php");
exit;
?>
