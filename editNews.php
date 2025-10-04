<?php
session_start();
include "connectionOnDatabase.php";

// التحقق من وجود news_id
if (!isset($_GET['news_id'])) {
    die("لم يتم تحديد الخبر المطلوب.");
}

$news_id = (int)$_GET['news_id'];

// جلب بيانات الخبر بطريقة آمنة
$stmt = $connection->prepare("SELECT * FROM news WHERE news_id = ?");
$stmt->bind_param("i", $news_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result || $result->num_rows == 0) {
    die("الخبر غير موجود.");
}

$news_data = $result->fetch_assoc();

$stmt->close();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>تعديل الخبر</title>
  <style>
    body { font-family: 'Tahoma', sans-serif; background: #0f172a; color:#e2e8f0; display:flex; justify-content:center; align-items:center; min-height:100vh; margin:0; padding:0;}
    .card { background:#1e293b; padding:30px; border-radius:15px; box-shadow:0 0 20px rgba(34,197,94,0.7); width:500px; }
    .card h2 { text-align:center; margin-top:0; margin-bottom:25px; color:#22c55e; text-shadow:0 0 12px #22c55e; }
    form table { width:100%; border-collapse:collapse; }
    td { padding:10px; vertical-align:top; }
    .label-cell { width:130px; font-weight:bold; color:#cbd5e1; }
    input[type="text"], input[type="number"], textarea, select { width:100%; padding:12px; border:1px solid #334155; border-radius:8px; font-size:14px; background:#0f172a; color:#e2e8f0; transition:0.3s; }
    input[type="text"]:focus, input[type="number"]:focus, textarea:focus, select:focus { border-color:#22c55e; box-shadow:0 0 12px rgba(34,197,94,0.8); outline:none; }
    textarea { resize:vertical; }
    input[type="submit"] { padding:12px 20px; border:none; border-radius:8px; background:#22c55e; color:#0f172a; font-weight:bold; cursor:pointer; transition:0.3s; margin-top:10px; box-shadow:0 0 12px rgba(34,197,94,0.7); }
    input[type="submit"]:hover { background:#16a34a; box-shadow:0 0 18px rgba(34,197,94,0.9); }
  </style>
</head>
<body>
  <div class="card">
    <h2>تعديل الخبر</h2>
    <form action="logicEditNews.php" method="post">
      <input type="hidden" name="news_id" value="<?php echo (int)$news_data['news_id']; ?>">
      <table>
        <tr>
          <td class="label-cell"><label>عنوان الخبر:</label></td>
          <td><input type="text" name="new_news_name" value="<?php echo htmlspecialchars($news_data['news_name'], ENT_QUOTES); ?>" required></td>
        </tr>
        <tr>
          <td class="label-cell"><label>الفئة:</label></td>
          <td>
            <select name="new_category" required>
              <option value="">اختر الفئة</option>
              <option value="رياضة" <?php if($news_data['category']=='رياضة') echo 'selected'; ?>>رياضة</option>
              <option value="سياسة" <?php if($news_data['category']=='سياسة') echo 'selected'; ?>>سياسة</option>
              <option value="اقتصاد" <?php if($news_data['category']=='اقتصاد') echo 'selected'; ?>>اقتصاد</option>
              <option value="ثقافة" <?php if($news_data['category']=='ثقافة') echo 'selected'; ?>>ثقافة</option>
              <option value="تكنولوجيا" <?php if($news_data['category']=='تكنولوجيا') echo 'selected'; ?>>تكنولوجيا</option>
            </select>
          </td>
        </tr>
        <tr>
          <td class="label-cell"><label>التفاصيل:</label></td>
          <td><textarea name="new_news_details" rows="5" required><?php echo htmlspecialchars($news_data['news_details'], ENT_QUOTES); ?></textarea></td>
        </tr>
        <tr>
          <td class="label-cell"><label>رابط الصورة:</label></td>
          <td><input type="text" name="new_news_image" value="<?php echo htmlspecialchars($news_data['news_image'], ENT_QUOTES); ?>" required></td>
        </tr>
        <tr>
          <td class="label-cell"><label>معرف المستخدم:</label></td>
          <td><input type="number" name="new_user_id" value="<?php echo (int)$news_data['user_id']; ?>" required></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="edit_news" value="حفظ التعديلات"></td>
        </tr>
      </table>
    </form>
  </div>
</body>
</html>
