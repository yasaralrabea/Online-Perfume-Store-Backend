<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>متجر العطور</title>
<link rel="stylesheet" href="{{ asset('css/home.css') }}" />
    <script>
      function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('active');
        document.getElementById('overlay').classList.toggle('active');
      }
      function closeSidebar() {
        document.getElementById('sidebar').classList.remove('active');
        document.getElementById('overlay').classList.remove('active');
      }
    </script>
</head>
<body>
    <div id="overlay" onclick="closeSidebar()"></div>

    <!-- الشريط العلوي -->
    <header class="topbar">
        <button class="menu-btn" onclick="toggleSidebar()">☰</button>
       <div class="topbar-right">
    <a href="{{ route('login') }}" class="topbar-link">تسجيل دخول</a>
    <a href="{{ route('settings') }}" class="topbar-link">الإعدادات</a>
    <a href="{{ route('profile.edit') }}" class="topbar-link">حسابي</a>
</div>

    </header>

    <!-- القائمة الجانبية -->
    <aside id="sidebar" class="sidebar">
        <h2>الفئات</h2>
        <ul>
            <li><a href="#">عطور رجالي</a></li>
            <li><a href="#">عطور نسائية</a></li>
            <li><a href="#">عطور مشتركة</a></li>
            <li><a href="#">الكل</a></li>
        </ul>
    </aside>

    <!-- المحتوى الرئيسي -->
    <main>
        <section class="bestsellers">
            <h1>الأكثر مبيعاً</h1>
            <div class="products">
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" alt="عطر رجالي" />
                    <h3>عطر رجالي فاخر</h3>
                    <p>رائحة جذابة تدوم طويلاً.</p>
                    <span class="price">150 ر.س</span>
                </div>
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=400&q=80" alt="عطر نسائي" />
                    <h3>عطر نسائي زهري</h3>
                    <p>نفحات من الورود الطبيعية.</p>
                    <span class="price">140 ر.س</span>
                </div>
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1515548212796-1c3f0f92c9f7?auto=format&fit=crop&w=400&q=80" alt="عطر مشترك" />
                    <h3>عطر مشترك فاخر</h3>
                    <p>مزيج مثالي يناسب الجميع.</p>
                    <span class="price">160 ر.س</span>
                </div>
            </div>
        </section>
    </main>

    <!-- الفوتر -->
    <footer>
        <div class="footer-about">
            <h2>نبذة عنا</h2>
            <p>نحن متجر عطور متخصص في تقديم أجود أنواع العطور الرجالية والنسائية والمشتركة بجودة عالية وأسعار مناسبة.</p>
        </div>
        <div class="footer-logo">
            <img src="https://img.icons8.com/ios-filled/50/fa314a/perfume-bottle.png" alt="شعار المتجر" />
            <h3>متجر العطور</h3>
        </div>
        <div class="footer-rights">
            <p>© 2025 جميع الحقوق محفوظة لمتجر العطور</p>
        </div>
    </footer>
</body>
/html>
