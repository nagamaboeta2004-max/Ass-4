<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>➕ إضافة خبر</title>
  <style>
    body {
      font-family: 'Tahoma', sans-serif;
      background: #0f172a; /* خلفية غامقة */
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #e2e8f0;
    }

    .form-container {
      background: #1e293b; /* صندوق غامق */
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(34,197,94,0.5); /* أخضر نيون */
      width: 420px;
    }

    .form-container h2 {
      color: #22c55e; /* أخضر نيون */
      margin-top: 0;
      text-align: center;
      margin-bottom: 25px;
      text-shadow: 0 0 10px #22c55e;
    }

    label {
      display: block;
      text-align: right;
      margin: 10px 0 5px;
      font-weight: bold;
      color: #cbd5e1; /* رمادي فاتح */
    }

    input[type="text"],
    select,
    textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #334155;
      border-radius: 8px;
      outline: none;
      transition: 0.3s;
      box-sizing: border-box;
      font-size: 14px;
      background: #0f172a;
      color: #e2e8f0;
    }

    input[type="text"]:focus,
    select:focus,
    textarea:focus {
      border-color: #22c55e;
      box-shadow: 0 0 10px rgba(34,197,94,0.7);
    }

    textarea {
      resize: none;
    }

    input[type="submit"] {
      margin-top: 20px;
      width: 100%;
      padding: 12px;
      background: #22c55e; /* أخضر نيون */
      border: none;
      border-radius: 8px;
      color: #0f172a;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
      font-weight: bold;
    }

    input[type="submit"]:hover {
      background: #16a34a; /* أخضر فاتح عند hover */
      box-shadow: 0 0 15px rgba(34,197,94,0.9);
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>➕ إضافة خبر جديد</h2>
    <form action="logicAddNews.php" method="post">
      <label>عنوان الخبر</label>
      <input name="news_name" type="text" required>

      <label>الفئة</label>
      <select name="category" required>
        <option value="">اختر الفئة</option>
        <option value="رياضة">رياضة</option>
        <option value="سياسة">سياسة</option>
        <option value="اقتصاد">اقتصاد</option>
        <option value="ثقافة">ثقافة</option>
        <option value="تكنولوجيا">تكنولوجيا</option>
      </select>

      <label>تفاصيل الخبر</label>
      <textarea name="news_details" rows="4" required></textarea>

      <label>رابط صورة الخبر</label>
      <input name="news_image" type="text" required>

      <label>معرف المستخدم</label>
      <input name="user_id" type="text" required>

      <input name="add_news" type="submit" value="إضافة خبر">
    </form>
  </div>
</body>
</html>
