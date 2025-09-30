<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>متجر العطور</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}" />
    <style>
        /* ======= الهيدر ======= */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            background-color: #e8e6e6ff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1000;
        }

        .topbar-left {
            display: flex;
            align-items: center;
        }

        .menu-btn {
            font-size: 24px;
            background: none;
            border: none;
            cursor: pointer;
        }

        .topbar-right {
            display: flex;
            align-items: center;
        }

        .topbar-right a,
        .topbar-right button {
            margin-left: 10px;
            padding: 6px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            transition: background-color 0.3s;
            color: #333;
            background: none;
            border: none;
            cursor: pointer;
        }

        .topbar-right a:hover,
        .topbar-right button:hover {
            background-color: #f2f2f2;
        }

        /* أيقونة السلة الجديدة */
        .bag-link img {
            width: 28px;
            height: 28px;
            filter: none;
            transition: transform 0.2s;
        }

        .bag-link:hover img {
            transform: scale(1.1);
        }

       /* ======= القائمة الجانبية ======= */
#sidebar {
    position: fixed;
    top: 0;
    right: -270px;
    width: 270px;
    height: 100%;
    background-color: #fff;
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
    padding: 15px;
    transition: right 0.3s;
    overflow-y: auto;
    z-index: 999;
}

#sidebar.active {
    right: 0;
}

#overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s;
    z-index: 998;
}

#overlay.active {
    opacity: 1;
    visibility: visible;
}

.sidebar h2 {
    margin-bottom: 10px;
}

.sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar ul li {
    padding: 10px;
    position: relative;
    cursor: pointer;
}

/* نصوص الروابط داخل القائمة */
.sidebar ul li a {
    text-decoration: none;
    color: #333;
    display: block;
}

/* القائمة الفرعية مخفية افتراضيًا */
.sidebar ul li .submenu {
    display: none;
    padding-right: 15px;
    list-style: none;
}

/* حذف السهم */
.sidebar ul li .arrow {
    display: none;
}

/* عند فتح القائمة الفرعية */
.sidebar ul li.open .submenu {
    display: block;
}

/* تنسيق روابط الفرعية */
.sidebar ul li .submenu li {
    padding: 6px 0;
}


        /* ======= المحتوى الرئيسي ======= */
        main {
            padding: 20px;
        }

        .products {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .product-card {
            width: calc(25% - 12px); /* 4 بطاقات في الصف */
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 8px;
            box-sizing: border-box;
            text-align: center;
            cursor: pointer;
            transition: box-shadow 0.3s, transform 0.2s;
        }

        .product-card:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            transform: translateY(-3px);
        }

       .product-card img {
    width: 100%;
    height: 160px;       /* الطول ثابت */
    object-fit: contain; /* الصورة تظل كاملة */
    background-color: #fff; /* خلفية ورا الصورة */
    border-radius: 5px;
    padding: 5px;        /* مسافة صغيرة حول الصورة */
}


        .product-card h3 {
            margin: 8px 0 4px;
            font-size: 14px;
        }

        .product-card p {
            font-size: 12px;
            color: #666;
            height: 36px;
            overflow: hidden;
        }

        .product-card .price {
            font-weight: bold;
            font-size: 13px;
            color: #fa314a;
        }

        /* زر الإضافة للسلة بشكل جديد */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 6px;
            padding: 6px 12px;
            background: linear-gradient(135deg, #fa314a, #ff5c7a);
            color: #fff;
            border-radius: 20px;
            font-weight: bold;
            font-size: 13px;
            border: none;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(250, 49, 74, 0.3);
        }

        .btn svg {
            width: 16px;
            height: 16px;
        }

        /* ======= الفوتر ======= */
        footer {
            background: #403f3fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        footer h2,
        footer h3 {
            margin: 0 0 10px 0;
        }
    </style>
</head>

<body>
    <div id="overlay" onclick="closeSidebar()"></div>

    <!-- الهيدر -->
    <header class="topbar">
        <div class="topbar-left">
            <button class="menu-btn" onclick="toggleSidebar()">☰</button>
        </div>
        <div class="topbar-right">
            <a href="{{ route('cart') }}" class="bag-link" title="حقيبتي" aria-label="حقيبتي">
                <img src="https://img.icons8.com/ios-filled/50/fa314a/shopping-cart.png" alt="حقيبتي" />
            </a>

            <a href="{{ route('settings') }}" class="topbar-link">الإعدادات</a>
            <a href="{{ route('my.orders') }}" class="topbar-link">طلباتي</a>
            <a href="{{ route('profile.edit') }}" class="topbar-link">حسابي</a>
             @auth
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="topbar-link">تسجيل الخروج</button>
        </form>
    @else
        <a href="{{ route('login') }}" class="topbar-link">تسجيل الدخول</a>
    @endauth
        </div>
    </header>

    <!-- القائمة الجانبية -->
    <aside id="sidebar" class="sidebar">
        <h2>الفئات</h2>
        <ul>
            <li class="has-submenu">
                عطور
                <ul class="submenu">
                    <li><a href="{{ route('products.male') }}">رجالي</a></li>
                    <li><a href="{{ route('products.female') }}">نسائي</a></li>
                    <li><a href="#">مشتركة</a></li>
                    <li><a href="{{ route('every') }}">الكل</a></li>
                </ul>
            </li>
            <li><a href="{{ route('question') }}">تواصل معنا</a></li>
            <li><a href="{{ route('profile.edit') }}">حسابي ومعلوماتي</a></li>
            <li><a href="{{ route('my.orders') }}">متابعة الطلبات</a></li>
        </ul>
    </aside>

    <!-- المحتوى الرئيسي -->
    <main>
        <!-- قسم الأكثر مبيعاً -->
        <section class="bestsellers">
            <h1>الأكثر مبيعاً</h1>
            <div class="products">
                @forelse ($popular_perfumes as $product)
                    <div class="product-card" onclick="window.location='{{ route('products.show', $product->id) }}'">
                        @if($product->image)
                            <img src="{{ url($product->image) }}" alt="{{ $product->name }}" />
                        @else
                            <img src="https://via.placeholder.com/400x300?text=بدون+صورة" alt="لا توجد صورة" />
                        @endif
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->description }}</p>
                        <span class="price">{{ $product->price }} jd</span>

                        <!-- زر الإضافة للسلة الجديد -->
                        <form method="POST" action="{{ route('cart.add', $product->id) }}"
                              onclick="event.stopPropagation();">
                            @csrf
                            <button type="submit" class="btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.6 8H19m-6-4a2 2 0 100-4 2 2 0 000 4z"/>
                                </svg>
                                إضافة للسلة
                            </button>
                        </form>
                    </div>
                @empty
                    <p>لا توجد منتجات مميزة حالياً.</p>
                @endforelse
            </div>
        </section>

        <section class="all-products">
            <h1>كل المنتجات</h1>
            <div class="products" id="product-list">
                @include('partials', ['products' => $products])
            </div>

            @if ($products->hasMorePages())
                <div class="load-more-container">
                    <button id="load-more" data-url="{{ $products->nextPageUrl() }}">
                        تحميل المزيد
                    </button>
                </div>
            @endif
        </section>
    </main>

    <!-- الفوتر -->
    <footer>
        <div class="footer-about">
            <h2>نبذة عنا</h2>
            <p>
                نحن متجر عطور متخصص في تقديم أجود أنواع العطور الرجالية والنسائية
                والمشتركة بجودة عالية وأسعار مناسبة.
            </p>
        </div>
        <div class="footer-logo">
            <img src="https://img.icons8.com/ios-filled/50/fa314a/perfume-bottle.png" alt="شعار المتجر" />
            <h3>متجر العطور</h3>
        </div>
        <div class="footer-rights">
            <p>© 2025 جميع الحقوق محفوظة لمتجر العطور</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('overlay').classList.toggle('active');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('active');
            document.getElementById('overlay').classList.remove('active');
        }

        // القائمة الفرعية: فتح/غلق عند الضغط على العنوان
        document.querySelectorAll('.sidebar .has-submenu').forEach(item => {
            item.addEventListener('click', function (e) {
                if (e.target.tagName !== 'A') {
                    this.classList.toggle('open');
                }
            });
        });

        // تحميل المزيد
        document.addEventListener("DOMContentLoaded", function () {
            let loadMoreBtn = document.getElementById("load-more");

            if (loadMoreBtn) {
                loadMoreBtn.addEventListener("click", function () {
                    let url = this.getAttribute("data-url");

                    fetch(url, {
                        headers: { "X-Requested-With": "XMLHttpRequest" }
                    })
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById("product-list").insertAdjacentHTML('beforeend', data);

                            let newUrl = new DOMParser().parseFromString(data, "text/html")
                                .querySelector("#load-more")?.getAttribute("data-url");

                            if (newUrl) {
                                loadMoreBtn.setAttribute("data-url", newUrl);
                            } else {
                                loadMoreBtn.style.display = "none";
                            }
                        });
                });
            }
        });
    </script>
</body>

</html>
