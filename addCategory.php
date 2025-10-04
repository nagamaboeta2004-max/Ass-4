<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>➕ إضافة فئة - نظام إدارة الأخبار</title>
  <style>
    body {
      font-family: 'Tahoma', sans-serif;
      background: #0f172a; /* خلفية داكنة */
      margin: 0;
      padding: 0;
      min-height: 100vh;
      color: #e2e8f0;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form-container {
      background: #1e293b; /* صندوق داكن */
      padding: 30px 40px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(34,197,94,0.5); /* توهج أخضر نيون */
      width: 380px;
      text-align: center;
    }

    .form-container h1 {
      color: #22c55e; /* أخضر نيون */
      margin-bottom: 25px;
      text-shadow: 0 0 10px #22c55e;
      font-size: 24px;
    }

    label {
      display: block;
      text-align: right;
      margin: 10px 0 5px;
      font-weight: bold;
      color: #cbd5e1;
    }

    select,
    input[type="text"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #334155;
      border-radius: 8px;
      outline: none;
      background: #0f172a;
      color: #e2e8f0;
      transition: 0.3s;
      margin-bottom: 15px;
    }

    select:focus,
    input[type="text"]:focus {
      border-color: #22c55e;
      box-shadow: 0 0 10px rgba(34,197,94,0.8);
    }

    input[type="submit"] {
      width: 100%;
      background: #22c55e;
      border: none;
      padding: 12px;
      color: #0f172a;
      font-weight: bold;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
      font-size: 16px;
    }

    input[type="submit"]:hover {
      background: #16a34a;
      box-shadow: 0 0 20px rgba(34,197,94,0.8);
    }

    /* تأثير عند مرور الماوس على الصندوق */
    .form-container:hover {
      box-shadow: 0 0 25px rgba(34,197,94,0.6);
      transition: 0.4s ease-in-out;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h1>📁 إضافة فئة جديدة</h1>
    <form action="logicAddCategory.php" method="post">
      <label>نوع الفئة</label>
      <select name="category" required>
        <option value="">اختر الفئة</option>
        <option value="رياضة">رياضة</option>
        <option value="سياسة">سياسة</option>
        <option value="اقتصاد">اقتصاد</option>
        <option value="ثقافة">ثقافة</option>
        <option value="تكنولوجيا">تكنولوجيا</option>
      </select>

      <label>وصف الفئة</label>
      <input name="category_description" type="text" required>

      <input type="submit" value="💾 حفظ" name="add_category">
    </form>
  </div>
</body>
</html>
