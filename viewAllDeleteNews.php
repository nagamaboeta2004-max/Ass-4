<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>الأخبار المحذوفة</title>
  <style>
    body {
      font-family: 'Tahoma', sans-serif;
      background: #0f172a; /* خلفية داكنة */
      margin: 0;
      padding: 0;
      min-height: 100vh;
      color: #e2e8f0;
    }

    .header {
      background: #1e293b;
      padding: 15px 30px;
      box-shadow: 0 0 20px rgba(34,197,94,0.5); /* أخضر نيون */
      text-align: center;
    }

    .header h1 {
      margin: 0;
      color: #22c55e; /* أخضر نيون */
      text-shadow: 0 0 8px #22c55e;
    }

    .content {
      padding: 30px;
      display: flex;
      justify-content: center;
    }

    .card {
      background: #1e293b;
      border-radius: 15px;
      padding: 20px;
      box-shadow: 0 0 20px rgba(34,197,94,0.5); /* أخضر نيون */
      width: 100%;
      max-width: 1000px;
    }

    .card h2 {
      color: #22c55e;
      text-align: center;
      margin-top: 0;
      margin-bottom: 20px;
      text-shadow: 0 0 6px #22c55e;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
      color: #e2e8f0;
    }

    table th, table td {
      border: 1px solid #16a34a; /* أخضر فاتح */
      padding: 12px;
      text-align: center;
      vertical-align: middle;
      border-radius: 6px;
    }

    table th {
      background: #22c55e; /* أخضر نيون */
      color: #0f172a;
    }

    table tr:nth-child(even) {
      background-color: #0f172a;
    }

    table tr:hover {
      background-color: #16a34a; /* أخضر فاتح عند المرور */
      color: #0f172a;
      transition: 0.3s;
    }

    .btn-restore {
      padding: 6px 12px;
      background: #22c55e; /* أخضر نيون */
      color: #0f172a;
      border: none;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s;
      cursor: pointer;
      box-shadow: 0 0 8px #22c55e;
    }

    .btn-restore:hover {
      background: #16a34a; /* أخضر فاتح */
      box-shadow: 0 0 12px #16a34a;
    }

    p.no-news {
      text-align: center;
      color: #22c55e;
      font-weight: bold;
      font-size: 16px;
      padding: 20px 0;
      text-shadow: 0 0 6px #22c55e;
    }
  </style>
</head>
<body>
  <div class="header">
    <h1>🗑️ الأخبار المحذوفة</h1>
  </div>

  <div class="content">
    <div class="card">
      <table>
        <tr>
          <th>عنوان الخبر</th>
          <th>الفئة</th>
          <th>تفاصيل الخبر</th>
          <th>صورة الخبر</th>
          <th>معرف المستخدم</th>
          <th>إجراء</th>
        </tr>
        <?php 
        session_start(); 
        include "connectionOnDatabase.php"; 

        if(isset($_GET['restore_id'])){
            $restore_id = (int)$_GET['restore_id'];
            $connection->query("UPDATE news SET is_deleted = 0 WHERE news_id = $restore_id");
            header("Location: viewAllDeleteNews.php");
            exit;
        }

        $sql = "SELECT * FROM news WHERE is_deleted = 1";
        $result = $connection->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>".htmlspecialchars($row['news_name'])."</td>";
                echo "<td>".htmlspecialchars($row['category'])."</td>";
                echo "<td>".htmlspecialchars($row['news_details'])."</td>";
                echo "<td><img src='".htmlspecialchars($row['news_image'])."' width='80' height='60' style='border-radius:6px; object-fit:cover;'></td>";
                echo "<td>".htmlspecialchars($row['user_id'])."</td>";
                echo "<td><a class='btn-restore' href='?restore_id=".$row['news_id']."'>استرجاع</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'><p class='no-news'>لا يوجد أخبار محذوفة</p></td></tr>";
        }

        $connection->close();
        ?>
      </table>
    </div>
  </div>
</body>
</html>
