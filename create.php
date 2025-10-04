<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>إنشاء حساب</title>
  <style>
    body {
      font-family: 'Tahoma', sans-serif;
      background: #0f172a; /* خلفية داكنة */
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
      width: 400px;
      text-align: center;
    }

    .form-container h2 {
      color: #22c55e; /* أخضر نيون */
      margin-top: 0;
      margin-bottom: 25px;
      text-shadow: 0 0 10px #22c55e;
    }

    label {
      display: block;
      text-align: right;
      margin: 10px 0 5px;
      font-weight: bold;
      color: #cbd5e1;
    }

    input[type="text"], 
    input[type="email"], 
    input[type="password"] {
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
    input[type="email"]:focus, 
    input[type="password"]:focus {
      border-color: #22c55e;
      box-shadow: 0 0 10px rgba(34,197,94,0.7);
    }

    input[type="submit"] {
      margin-top: 20px;
      width: 100%;
      padding: 12px;
      background: #22c55e; /* زر أخضر نيون */
      border: none;
      border-radius: 8px;
      color: #0f172a;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
      font-weight: bold;
      text-shadow: 0 0 5px #14532d;
    }

    input[type="submit"]:hover {
      background: #16a34a;
      box-shadow: 0 0 15px rgba(34,197,94,0.9);
    }

    .login-link {
      display: block;
      margin-top: 15px;
      font-size: 14px;
      color: #22c55e;
      text-decoration: none;
      transition: 0.3s;
      text-shadow: 0 0 5px #16a34a;
    }

    .login-link:hover {
      color: #16a34a;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>إنشاء حساب</h2>
    <form action="logicCreate.php" method="post">
      <label>الاسم الكامل</label>
      <input name="name" type="text" required>

      <label>البريد الإلكتروني</label>
      <input name="email" type="email" required>

      <label>كلمة المرور</label>
      <input name="password" type="password" required>

      <input type="submit" value="إنشاء" name="create">
    </form>
    <a href="login.php" class="login-link">لديك حساب؟ تسجيل الدخول</a>
  </div>
</body>
</html>
