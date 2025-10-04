<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>عرض جميع الأخبار</title>
 <style>
    body {
      font-family: 'Tahoma', sans-serif;
      background: #0f172a;
      margin: 0;
      padding: 0;
      color: #e2e8f0;
      min-height: 100vh;
    }

    .header {
      background: #1e293b;
      padding: 15px 30px;
      box-shadow: 0 0 20px rgba(34,197,94,0.5);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .header h1 {
      margin: 0;
      color: #22c55e;
      text-shadow: 0 0 8px #22c55e;
    }

    .content {
      padding: 30px;
    }

    .card {
      background: #1e293b;
      border-radius: 15px;
      padding: 20px;
      box-shadow: 0 0 20px rgba(34,197,94,0.5);
      margin-bottom: 20px;
    }

    .card h2 {
      margin-top: 0;
      color: #22c55e;
      text-align: center;
      margin-bottom: 25px;
      text-shadow: 0 0 6px #22c55e;
    }

    /* تنسيق الجدول */
    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 10px; /* مسافة بين الصفوف */
      font-size: 14px;
      color: #e2e8f0;
    }

    table th, table td {
      padding: 12px;
      text-align: center;
      vertical-align: middle;
      border-radius: 6px;
    }

    table th {
      background: #22c55e; /* أخضر نيون */
      color: #0f172a;
    }

    table td {
      background: #1e293b;
      border: 1px solid #22c55e;
    }


    /* صور الأخبار */
    img.news-img {
      border-radius: 6px;
      width: 80px;
      height: 60px;
      object-fit: cover;
    }

    /* أزرار الإجراءات */
    .actions a.edit {
      background: #22c55e;
      box-shadow: 0 0 8px #22c55e;
      color: #0f172a;
      padding: 6px 12px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      margin: 0 2px;
      display: inline-block;
      transition: 0.3s;
    }

    .actions a.edit:hover {
      background: #16a34a;
      box-shadow: 0 0 12px #16a34a;
    }

    .actions a.delete {
      background: #e74c3c;
      box-shadow: 0 0 8px #e74c3c;
      color: #fff;
      padding: 6px 12px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      margin: 0 2px;
      display: inline-block;
      transition: 0.3s;
    }

    .actions a.delete:hover {
      background: #c0392b;
      box-shadow: 0 0 12px #c0392b;
    }

    p.no-news {
      text-align: center;
      color: #22c55e;
      font-weight: bold;
      font-size: 16px;
      text-shadow: 0 0 6px #22c55e;
    }

</style>

</head>
<body>
  

  <div class="content">
    <div class="card">
      <h2>📋 جميع الأخبار</h2>
      <?php
      session_start();
      include "connectionOnDatabase.php";

      $user_id = $_SESSION["authUser"]["id"];
      $sql = "SELECT news_id, news_name, category, news_details, news_image, user_id 
              FROM news 
              WHERE is_deleted = 0 AND user_id = $user_id";
      $result = $connection->query($sql);

      if ($result && $result->num_rows > 0) {
          echo "<table>";
          echo "<tr>
                  <th>عنوان الخبر</th>
                  <th>الفئة</th>
                  <th>تفاصيل الخبر</th>
                  <th>صورة الخبر</th>
                  <th>معرف المستخدم</th>
                  <th>الإجراءات</th>
                </tr>";
          
          while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['news_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['category']) . "</td>";
        echo "<td>" . htmlspecialchars($row['news_details']) . "</td>";
        echo "<td><img src='" . htmlspecialchars($row['news_image']) . "' class='news-img'></td>";
        echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
        echo "<td class='actions'>
<a class='edit' href='editNews.php?news_id=" . $row['news_id'] . "'>تعديل</a>
                <a class='delete' href='deleteNews.php?id=" . $row['news_id'] . "'>حذف</a>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p class='no-news'>لا توجد أخبار لعرضها.</p>";
}
      $connection->close();
      ?>
    </div>
  </div>
</body>
</html>
