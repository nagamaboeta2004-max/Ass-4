<?php
session_start();
include "connectionOnDatabase.php";

if (!isset($_SESSION["authUser"])) {
    header("Location: login.php");
    exit;
}

// إجمالي الأخبار
$totalNewsQuery = $connection->query("SELECT COUNT(*) as total FROM news WHERE is_deleted = 0");
$totalNews = $totalNewsQuery->fetch_assoc()['total'];

// الفئات
$totalCategoriesQuery = $connection->query("SELECT COUNT(*) as total FROM category");
$totalCategories = $totalCategoriesQuery->fetch_assoc()['total'];

// الأخبار المحذوفة
$deletedNewsQuery = $connection->query("SELECT COUNT(*) as total FROM news WHERE is_deleted = 1");
$deletedNews = $deletedNewsQuery->fetch_assoc()['total'];

// جميع الأخبار
$user_id = $_SESSION["authUser"]["id"];
$newsQuery = $connection->query("SELECT news_id, news_name, category, news_details, news_image, user_id 
                                 FROM news 
                                 WHERE is_deleted = 0 AND user_id = $user_id");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الرئيسية | نظام إدارة الأخبار</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            box-sizing: border-box;
            background-color: #0f172a;
            color: #e2e8f0;
            font-family: Tahoma, sans-serif;
        }
        .neon-glow {
            box-shadow: 0 0 20px rgba(34, 197, 94, 0.4);
        }
        .hover-glow:hover {
            box-shadow: 0 0 30px rgba(34, 197, 94, 0.6);
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #22c55e 0%, #0f172a 50%, #22c55e 100%);
        }
        .neon-text {
            text-shadow: 0 0 10px rgba(34, 197, 94, 0.8);
        }
        @keyframes pulse-neon {
            0%, 100% { box-shadow: 0 0 20px rgba(34, 197, 94, 0.4); }
            50% { box-shadow: 0 0 40px rgba(34, 197, 94, 0.7); }
        }
        .pulse-animation {
            animation: pulse-neon 2s infinite;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .slide-in {
            animation: slideIn 0.5s ease-out;
        }
        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }
        .mobile-menu.active {
            transform: translateX(0);
        }
        
        .weather-widget {
    background: linear-gradient(135deg, #1e40af, #3b82f6); /* تدرج أزرق */
    color: #fff;
    padding: 20px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 0 15px rgba(59, 130, 246, 0.7);
}

        .stock-ticker {
            background: linear-gradient(90deg, #22c55e, #16a34a);
        }
        .category-filter.active {
            background: #22c55e;
            color: #0f172a;
        }
    </style>
</head>

<body class="font-sans">

<!-- Header -->
<header class="gradient-bg py-6 px-4 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
        <!-- اسم الموقع + مباشر -->
        <div class="flex items-center space-x-reverse space-x-4">
            <h1 class="text-3xl md:text-4xl font-bold text-green-400 neon-text">أخبار العالم</h1>
            <span class="bg-green-400 text-slate-900 px-2 py-1 rounded text-xs font-bold">مباشر</span>
        </div>
        <!-- رسالة الترحيب بالمستخدم -->
        <div class="text-center md:text-right">
            <h2 class="text-xl md:text-2xl font-semibold text-green-400 neon-text">
                مرحبا <?php echo $_SESSION["authUser"]["name"]; ?> 👋 
            </h2>
        </div>
    </div>
</header>

<!-- Navigation -->
<nav class="hidden lg:flex space-x-reverse space-x-8 justify-center py-4">
    <a href="dashoard.php" class="text-green-400 hover:text-green-300 font-semibold">الرئيسية</a>
    <a href="addCategory.php" class="text-white hover:text-green-400">إضافة فئة</a>
    <a href="viewAllCategory.php" class="text-white hover:text-green-400">عرض الفئات</a>
    <a href="addNews.php" class="text-white hover:text-green-400">إضافة خبر</a>
    <a href="viewAllNews.php" class="text-white hover:text-green-400">عرض الأخبار</a>
    <a href="viewAllDeleteNews.php" class="text-white hover:text-green-400">الأخبار المحذوفة</a>
    <a href="logout.php" class="text-white hover:text-green-400">تسجيل خروج</a>
</nav>

<!-- باقي المحتوى بنفس الهيكل لكن بالأخضر -->

   
</head>
<<body class="bg-slate-900 text-white font-sans">

    <!-- Breaking News Ticker -->
    <div class="bg-green-400 text-slate-900 py-3 px-4 pulse-animation overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center">
                <span class="bg-red-600 text-white px-3 py-1 rounded-full text-sm font-bold ml-4 animate-pulse">🔴 عاجل</span>
                <div class="ticker-content">
                    <p class="font-bold text-lg">أخبار عاجلة: تطورات مهمة في الأحداث الجارية • اجتماع طارئ لمجلس الأمن • ارتفاع أسعار النفط • نتائج مباريات اليوم</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Weather & Stock Widget -->
    <div class="bg-slate-800 py-4 px-4">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-4">
            <div class="weather-widget rounded-lg p-4 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-bold">حالة الطقس</h3>
                        <p class="text-sm opacity-90">الرياض، السعودية</p>
                    </div>
                   <div class="weather-widget">
  <h3>🌤️ حالة الطقس</h3>
  <p>غزة: 28°C | مشمس</p>
  <p>غداً: 25°C | غائم جزئي</p>
</div>

                </div>
            </div>
            <div class="stock-ticker rounded-lg p-4 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-bold">المؤشرات المالية</h3>
                        <p class="text-sm opacity-90">تداول السعودية</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-bold text-green-300">+2.5%</p>
                        <p class="text-sm">11,250 نقطة</p>
                    </div>
                </div>
            </div>
    </div>
    </div>

<main class="max-w-7xl mx-auto px-4 py-8">
        <!-- Featured Story -->
        <section class="mb-12">
            <div class="bg-green-900 rounded-2xl p-8 neon-glow hover-glow cursor-pointer">
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        <span class="bg-green-400 text-slate-900 px-4 py-2 rounded-full text-sm font-bold">الخبر الرئيسي</span>
                        <h2 class="text-3xl font-bold mt-4 mb-4 text-green-400">عنوان الخبر الرئيسي المهم جداً</h2>
                        <p class="text-gray-300 text-lg leading-relaxed mb-6">
                            هذا نص تجريبي للخبر الرئيسي الذي يحتوي على معلومات مهمة وحديثة. 
                            يمكن أن يكون هذا الخبر متعلقاً بأي موضوع مهم يستحق التسليط عليه.
                        </p>
                        <button class="bg-green-400 text-slate-900 px-6 py-3 rounded-lg font-bold hover:bg-green-300 transition-colors">
                            اقرأ المزيد
                        </button>
                    </div>
                    <div class="bg-slate-800 rounded-xl h-64 flex items-center justify-center">
                        <span class="text-green-400 text-6xl">📰</span>
                    </div>
                </div>
            </div>
        </section>

    <!-- Cards الإحصائيات -->
    <div class="grid md:grid-cols-3 gap-6 mb-10">
        <div class="bg-slate-800 shadow-lg rounded-lg p-6 text-center card-glow">
            <h2 class="text-4xl font-extrabold text-green-400 neon-text"><?php echo $totalNews; ?></h2>
            <p class="text-gray-300">إجمالي الأخبار</p>
        </div>
        <div class="bg-slate-800 shadow-lg rounded-lg p-6 text-center card-glow">
            <h2 class="text-4xl font-extrabold text-green-400 neon-text"><?php echo $totalCategories; ?></h2>
            <p class="text-gray-300">عدد الفئات</p>
        </div>
        <div class="bg-slate-800 shadow-lg rounded-lg p-6 text-center card-glow">
            <h2 class="text-4xl font-extrabold text-red-400 neon-text"><?php echo $deletedNews; ?></h2>
            <p class="text-gray-300">الأخبار المحذوفة</p>
        </div>
    </div>

    <!-- أخبار المستخدم Cards -->
    <h2 class="text-2xl font-bold text-green-400 neon-text mb-6">📰 جميع الأخبار</h2>
    <?php if($newsQuery->num_rows > 0): ?>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while($row = $newsQuery->fetch_assoc()): ?>
                <div class="bg-slate-800 rounded-lg shadow-md overflow-hidden card-glow">
                    <div class="h-48 bg-slate-700 flex items-center justify-center">
                        <img src="<?php echo htmlspecialchars($row['news_image']); ?>" class="object-cover h-full w-full">
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-xl text-green-400 mb-2 neon-text"><?php echo htmlspecialchars($row['news_name']); ?></h3>
                        <span class="text-sm text-gray-400"><?php echo htmlspecialchars($row['category']); ?></span>
                        <p class="text-gray-300 text-sm mt-2"><?php echo substr(htmlspecialchars($row['news_details']),0,100).'...'; ?></p>
                        <div class="mt-3 flex gap-2">
                            <a href="editNews.php?id=<?php echo $row['news_id']; ?>" class="text-green-400 hover:text-green-300 text-sm font-semibold">✏️ تعديل</a>
                            <a href="deleteNews.php?id=<?php echo $row['news_id']; ?>" class="text-red-400 hover:text-red-300 text-sm font-semibold">🗑️ حذف</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-gray-400">لا توجد أخبار متاحة حالياً.</p>
    <?php endif; ?>

     <!-- Trending Section -->
<section class="bg-green-900 rounded-2xl p-8 neon-glow mt-12 mb-12">
    <h2 class="text-2xl font-bold text-green-400 mb-6 neon-text">الأكثر تداولاً</h2>
    <div class="grid md:grid-cols-2 gap-6">
        <div class="flex items-center space-x-reverse space-x-4 p-4 bg-slate-800 rounded-lg hover-glow cursor-pointer">
            <span class="text-green-400 text-2xl font-bold">1</span>
            <div>
                <h4 class="font-bold text-green-400">موضوع ترند رقم 1</h4>
                <p class="text-gray-400 text-sm">15.2k مشاهدة</p>
            </div>
        </div>
        <div class="flex items-center space-x-reverse space-x-4 p-4 bg-slate-800 rounded-lg hover-glow cursor-pointer">
            <span class="text-green-400 text-2xl font-bold">2</span>
            <div>
                <h4 class="font-bold text-green-400">موضوع ترند رقم 2</h4>
                <p class="text-gray-400 text-sm">12.8k مشاهدة</p>
            </div>
        </div>
        <div class="flex items-center space-x-reverse space-x-4 p-4 bg-slate-800 rounded-lg hover-glow cursor-pointer">
            <span class="text-green-400 text-2xl font-bold">3</span>
            <div>
                <h4 class="font-bold text-green-400">موضوع ترند رقم 3</h4>
                <p class="text-gray-400 text-sm">9.5k مشاهدة</p>
            </div>
        </div>
        <div class="flex items-center space-x-reverse space-x-4 p-4 bg-slate-800 rounded-lg hover-glow cursor-pointer">
            <span class="text-green-400 text-2xl font-bold">4</span>
            <div>
                <h4 class="font-bold text-green-400">موضوع ترند رقم 4</h4>
                <p class="text-gray-400 text-sm">7.3k مشاهدة</p>
            </div>
        </div>
    </div>
</section>
        
    <!-- الأكثر قراءة -->
    <div class="most-read bg-slate-800 rounded-xl p-6">
        <h3 class="font-bold text-green-400 text-xl mb-4">الأكثر قراءة</h3>
        <ul class="space-y-4">
            <li class="bg-slate-700 p-3 rounded hover-glow cursor-pointer">
                <h4 class="font-bold text-green-400">تقرير اقتصادي شامل</h4>
                <p class="text-gray-400 text-sm">تحليل شامل للوضع الاقتصادي الحالي...</p>
            </li>
            <li class="bg-slate-700 p-3 rounded hover-glow cursor-pointer">
                <h4 class="font-bold text-green-400">استراتيجية التنمية المستدامة</h4>
                <p class="text-gray-400 text-sm">خطط طموحة للتنمية المستدامة...</p>
            </li>
            <li class="bg-slate-700 p-3 rounded hover-glow cursor-pointer">
                <h4 class="font-bold text-green-400">أحدث أخبار الرياضة</h4>
                <p class="text-gray-400 text-sm">نتائج مباريات اليوم والأحداث الرياضية المهمة...</p>
            </li>
        </ul>
    </div>
</div>

<div class="max-w-7xl mx-auto bg-gradient-to-r from-green-900 to-slate-800 rounded-xl p-6 my-6 px-4">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-green-400 text-xl">التحديثات المباشرة</h3>
        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm animate-pulse">🔴 مباشر</span>
    </div>
    <div id="live-updates" class="space-y-4 max-h-64 overflow-y-auto">
        <div class="bg-slate-700 rounded-lg p-4">
            <div class="flex justify-between items-start mb-2">
                <span class="text-green-400 font-bold">15:30</span>
                <span class="text-xs text-gray-400">منذ دقائق</span>
            </div>
            <p class="text-white">تأكيد وصول الوفود الدولية لحضور القمة المناخية</p>
        </div>
        <div class="bg-slate-700 rounded-lg p-4">
            <div class="flex justify-between items-start mb-2">
                <span class="text-green-400 font-bold">15:15</span>
                <span class="text-xs text-gray-400">منذ 15 دقيقة</span>
            </div>
            <p class="text-white">ارتفاع مؤشر البورصة إلى مستوى قياسي جديد</p>
        </div>
        <div class="bg-slate-700 rounded-lg p-4">
            <div class="flex justify-between items-start mb-2">
                <span class="text-green-400 font-bold">15:00</span>
                <span class="text-xs text-gray-400">منذ 30 دقيقة</span>
            </div>
            <p class="text-white">بدء أعمال المؤتمر الدولي للتكنولوجيا المالية</p>
        </div>
    </div>
</div>
        
</main>

<!-- Footer -->
<footer class="bg-slate-900 text-gray-400 py-10 mt-12 border-t border-green-400">
    <div class="container mx-auto px-4 flex flex-wrap justify-between gap-6">
        <div class="w-full md:w-1/4">
            <h4 class="font-bold mb-3 text-lg text-green-400 neon-text">أخبار اليوم</h4>
            <p class="text-gray-400 text-sm">موقعك الأول للحصول على آخر الأخبار المحلية والعالمية.</p>
        </div>
        <div class="w-full md:w-1/4">
            <h4 class="font-bold mb-3 text-lg text-green-400">الأقسام</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="#" class="hover:text-green-300">سياسة</a></li>
                <li><a href="#" class="hover:text-green-300">اقتصاد</a></li>
                <li><a href="#" class="hover:text-green-300">رياضة</a></li>
                <li><a href="#" class="hover:text-green-300">تكنولوجيا</a></li>
            </ul>
        </div>
        <div class="w-full md:w-1/4">
            <h4 class="font-bold mb-3 text-lg text-green-400">تابعنا</h4>
            <div class="flex gap-3 text-xl">
                <a href="#">📘</a>
                <a href="#">🐦</a>
                <a href="#">📷</a>
                <a href="#">📺</a>
            </div>
        </div>
        <div class="w-full md:w-1/4">
            <h4 class="font-bold mb-3 text-lg text-green-400">اتصل بنا</h4>
            <p class="text-gray-400 text-sm">📧 info@akhbaralyoum.com</p>
            <p class="text-gray-400 text-sm">📞 +20 123 456 789</p>
        </div>
    </div>
    <div class="border-t border-slate-700 mt-8 pt-4 text-center text-gray-500 text-sm">
        © 2025 أخبار اليوم. جميع الحقوق محفوظة.
    </div>
</footer>

</body>
</html>
