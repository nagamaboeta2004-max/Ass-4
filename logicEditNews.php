<?php
// لا تكتب أي مخرجات (echo/print/HTML) قبل الـ header() لأن هذا يمنع إعادة التوجيه
include "connectionOnDatabase.php";

if (!isset($_POST['edit_news'])) {
    // لو تم الوصول للصفحة مباشرة بدون submit
    header("Location: edit.php");
    exit;
}

// جلب المدخلات والتطهير الأولي
$news_id      = isset($_POST['news_id']) ? (int)$_POST['news_id'] : 0;
$news_name    = trim($_POST['new_news_name'] ?? '');
$category     = trim($_POST['new_category'] ?? '');
$news_details = trim($_POST['new_news_details'] ?? '');
$news_image   = trim($_POST['new_news_image'] ?? '');
$user_id      = isset($_POST['new_user_id']) ? (int)$_POST['new_user_id'] : 0;

// تحقق بسيط من المدخلات
if ($news_id <= 0) {
    die("معرف الخبر غير صحيح.");
}
if ($user_id <= 0) {
    die("معرف المستخدم غير صحيح.");
}
if ($news_name === '' || $category === '' || $news_details === '' || $news_image === '') {
    die("المدخلات غير مكتملة.");
}

// تحقق أن الفئة ضمن القيم المسموح بها (whitelist)
$allowed_categories = ['رياضة','سياسة','اقتصاد','ثقافة','تكنولوجيا'];
if (!in_array($category, $allowed_categories, true)) {
    die("فئة غير معترف بها.");
}

// استخدام Prepared Statement لتجنب SQL Injection
$sql = "UPDATE news
        SET news_name = ?, category = ?, news_details = ?, news_image = ?, user_id = ?
        WHERE news_id = ?";

$stmt = $connection->prepare($sql);
if ($stmt === false) {
    die("خطأ في تحضير الاستعلام: " . $connection->error);
}

// ربط المتغيرات و التنفيذ
// types: s = string, i = integer -> "ssssii" (4 strings, 2 ints)
$stmt->bind_param("ssssii", $news_name, $category, $news_details, $news_image, $user_id, $news_id);

if ($stmt->execute()) {
    $stmt->close();
    $connection->close();
    header("Location: viewAllNews.php");
    exit;
} else {
    $error = $stmt->error;
    $stmt->close();
    $connection->close();
    // أثناء التطوير اعرض الخطأ (في الإنتاج استبدل برسالة عامة)
    die("حدث خطأ أثناء تعديل الخبر: " . $error);
}

