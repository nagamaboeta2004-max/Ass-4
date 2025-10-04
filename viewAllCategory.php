<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>عرض جميع الفئات</title>
  <style>
    body {
      font-family: 'Tahoma', sans-serif;
      background: #0f172a; /* خلفية داكنة */
      margin: 0;
      padding: 0;
      min-height: 100vh;
      color: #e2e8f0;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      padding: 0 20px;
    }

    .header {
      background: #1e293b;
      padding: 20px 30px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(34,197,94,0.5); /* أخضر نيون */
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 30px;
    }

    .header h1 {
      margin: 0;
      color: #22c55e; /* أخضر نيون */
      font-size: 24px;
      text-shadow: 0 0 10px #22c55e;
    }

    .card {
      background: #1e293b; /* صندوق داكن */
      border-radius: 15px;
      padding: 25px;
      box-shadow: 0 0 20px rgba(34,197,94,0.5);
    }

    .card h2 {
      color: #22c55e;
      margin-top: 0;
      margin-bottom: 20px;
      text-align: center;
      text-shadow: 0 0 8px #22c55e;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
      color: #e2e8f0;
    }

    table th, table td {
      border: 1px solid #334155;
      padding: 12px;
      text-align: center;
    }

    table th {
      background: #22c55e; /* رأس الجدول أخضر نيون */
      color: #0f172a;
      border-radius: 6px;
    }

    table tr:nth-child(even) {
      background-color: #0f172a; /* صفوف متدرجة */
    }

    p {
      text-align: center;
      color: #22c55e;
      font-weight: bold;
      font-size: 16px;
      text-shadow: 0 0 6px #22c55e;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>📂 عرض جميع الفئات</h1>
    </div>

    <div class="card">
      <h2>قائمة الفئات</h2>
      <?php
      include "connectionOnDatabase.php";
      $sql = "SELECT category_name, category_description FROM category";
      $result = $connection->query($sql);

      if ($result && $result->num_rows > 0) {
          echo "<table>";
          echo "<tr><th>اسم الفئة</th><th>وصف الفئة</th></tr>";
          while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($row["category_name"]) . "</td>";
              echo "<td>" . htmlspecialchars($row["category_description"]) . "</td>";
              echo "</tr>";
          }
          echo "</table>";
      } else {
          echo "<p>لا توجد فئات لعرضها.</p>";
      }
      $connection->close();
      ?>
    </div>
  </div>
</body>
</html>
