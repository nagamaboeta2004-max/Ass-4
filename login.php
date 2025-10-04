<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <style>
        body {
            font-family: 'Tahoma', sans-serif;
            background: #0f172a; /* خلفية داكنة */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #e2e8f0;
        }

        .form-container {
            background: #1e293b; /* صندوق غامق */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(34,197,94,0.5); /* أخضر نيون */
            width: 350px;
            text-align: center;
        }

        .form-container h2 {
            margin-bottom: 20px;
            color: #22c55e; /* أخضر نيون */
            text-shadow: 0 0 10px #22c55e;
        }

        label {
            display: block;
            text-align: right;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #cbd5e1;
        }

        input[type="email"], 
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #334155;
            border-radius: 8px;
            outline: none;
            transition: 0.3s;
            background: #0f172a;
            color: #e2e8f0;
        }

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

        .form-footer {
            margin-top: 15px;
            font-size: 14px;
            color: #cbd5e1;
        }

        .form-footer a {
            color: #22c55e;
            text-decoration: none;
            transition: 0.3s;
            text-shadow: 0 0 5px #16a34a;
        }

        .form-footer a:hover {
            color: #16a34a;
        }

        .success-msg {
            color: #22c55e; /* أخضر نيون لتأكيد إنشاء الحساب */
            margin-bottom: 15px;
            text-shadow: 0 0 8px #22c55e;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>تسجيل الدخول</h2>
        <?php
        if(isset($_GET["statusCode"]) && $_GET["statusCode"] == "201"){
            echo "<div class='success-msg'>✅ تم إنشاء الحساب بنجاح</div>";
        }
        ?>
        <form action="logicLogin.php" method="post">
            <label>البريد الإلكتروني</label>
            <input name="email" type="email" required>

            <label>كلمة المرور</label>
            <input name="password" type="password" required>

            <input type="submit" value="دخول" name="login">
        </form>

        <div class="form-footer">
            ليس لديك حساب؟ <a href="create.php">إنشاء حساب جديد</a>
        </div>
    </div>
</body>
</html>
