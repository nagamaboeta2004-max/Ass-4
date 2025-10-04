<?php
// 1. تضمين ملف الاتصال
include "connectionOnDatabase.php";

// 2. التحقق من أن 'id' الخبر تم تمريره عبر الرابط (GET)
if (isset($_GET['id'])) {
    
    // 3. جلب معرف الخبر وتأمينه
    $news_id_to_delete = $_GET['id'];

    // 4. تحضير استعلام الحذف (تحديث الحقل is_deleted)
    // استخدام Prepared Statements هو الخيار الأكثر أماناً
    $sql = "UPDATE news SET is_deleted = 1 WHERE news_id = ?";
    
    $stmt = $connection->prepare($sql);

    if ($stmt === false) {
        die("خطأ في تحضير الاستعلام: " . $connection->error);
    }

    // 5. ربط المتغير بالاستعلام (i تعني integer)
    $stmt->bind_param("i", $news_id_to_delete);

    // 6. تنفيذ الاستعلام
    if ($stmt->execute()) {
        // تم الحذف بنجاح، أعد التوجيه إلى صفحة عرض الأخبار
        header("Location: viewAllNews.php");
        exit; // مهم جداً إيقاف التنفيذ بعد إعادة التوجيه
    } else {
        // حدث خطأ أثناء التنفيذ
        echo "فشل الحذف: " . $stmt->error;
    }

    // 7. إغلاق الاستعلام والاتصال
    $stmt->close();
    $connection->close();

} else {
    // إذا لم يتم تمرير الـ id في الرابط
    echo "خطأ: لم يتم تحديد خبر لحذفه.";
}
?>
