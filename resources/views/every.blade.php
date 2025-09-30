<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>جميع العطور</title>
    <link rel="stylesheet" href="{{ asset('css/men.css') }}" />
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

<header class="topbar">
    <div class="topbar-left">
        <button class="menu-btn" onclick="toggleSidebar()">☰</button>
        <h1 style="margin: 0 15px 0 0; font-size: 1.8rem; color: #fff;">جميع العطور</h1>
    </div>
    
    </div>
    <div class="topbar-right">
        
        <!-- أيقونة السلة -->
        <a href="{{ route('cart') }}" class="cart-icon" title="سلة التسوق">
            <img src="https://img.icons8.com/ios-filled/32/ffffff/shopping-cart.png" alt="سلة التسوق" />
        </a>
           <a href="{{ route('user.page') }}" class="topbar-link home-icon" title="العودة للصفحة الرئيسية">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
            </svg>
            الرئيسية
        </a>
        <a href="{{ route('settings') }}" class="topbar-link">الإعدادات</a>
        <a href="{{ route('profile.edit') }}" class="topbar-link">حسابي</a>

        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="topbar-link" style="background: none; border: none; color: inherit; cursor: pointer; font: inherit; padding: 0;">
                تسجيل الخروج
            </button>
        </form>
    </div>
</header>

<!-- القائمة الجانبية -->
<aside id="sidebar" class="sidebar">
    <h2>الفئات</h2>
    <ul>
        <li><a href="{{ route('products.male') }}">عطور رجالي</a></li>
        <li><a href="{{ route('products.female') }}">عطور نسائية</a></li>
        <li><a href="#">عطور مشتركة</a></li>
        <li><a href="#">الكل</a></li>
    </ul>
</aside>

<main style="padding-top: 90px;">
    <section class="bestsellers">
        <div class="products">
            @forelse ($every as $product)
                <div class="product-card">
                    @if($product->image)
                        <img src="{{ url($product->image) }}" alt="{{ $product->name }}" />
                    @else
                        <img src="https://via.placeholder.com/400x300?text=بدون+صورة" alt="لا توجد صورة" />
                    @endif
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->description }}</p>
                    <span class="price">{{ $product->price }}jd</span>
                    <a href="{{ route('products.show', ['id' => $product->id]) }}" class="btn-view-product">عرض المنتج</a>
                </div>
            @empty
                <p>لا توجد منتجات حالياً.</p>
            @endforelse
        </div>
    </section>
</main>

</body>
</html>
