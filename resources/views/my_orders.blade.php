<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلبـــــاتي</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* ======= الهيدر والفوتر والقائمة الجانبية ======= */
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

        .bag-link img {
            width: 28px;
            height: 28px;
            transition: transform 0.2s;
        }

        .bag-link:hover img {
            transform: scale(1.1);
        }

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
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            display: block;
        }

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

<body class="bg-gray-50">
    <div id="overlay" onclick="closeSidebar()"></div>

    <!-- الهيدر -->
    <header class="topbar">
        <div class="topbar-left">
            <button class="menu-btn" onclick="toggleSidebar()">☰</button>
            <h1 class="text-xl font-bold" style="margin:0 15px 0 0;">طلبـــــاتي</h1>
        </div>
        <div class="topbar-right">
            <a href="{{ route('cart') }}" class="bag-link" title="سلة التسوق">
                <img src="https://img.icons8.com/ios-filled/50/fa314a/shopping-cart.png" alt="سلة التسوق" />
            </a>
            <a href="{{ route('settings') }}" class="topbar-link">الإعدادات</a>
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
            <li><a href="{{ route('products.male') }}">عطور رجالي</a></li>
            <li><a href="{{ route('products.female') }}">عطور نسائية</a></li>
            <li><a href="#">عطور مشتركة</a></li>
            <li><a href="{{ route('every') }}">الكل</a></li>
            <li><a href="{{ route('question') }}">تواصل معنا</a></li>
        </ul>
    </aside>

    <!-- المحتوى الرئيسي -->
    <main class="py-10 max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-8">
        @forelse($orders as $order)
        <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-200 hover:shadow-xl transition">
            <!-- رأس الطلب -->
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-4">
                <h3 class="text-lg font-bold text-red-700">الطلب رقم #{{ $order->id }}</h3>
                <span class="px-3 py-1 text-sm rounded-full
                    @if($order->condition == 'قيد المعالجة') bg-yellow-100 text-yellow-600
                    @elseif($order->condition == 'مكتمل') bg-green-100 text-green-600
                    @elseif($order->condition == 'ملغي') bg-red-100 text-red-600
                    @else bg-gray-100 text-gray-600 @endif">
                    {{ $order->status }}
                </span>
            </div>

            <!-- تفاصيل الطلب -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-gray-700 mb-6">
                <p><span class="font-semibold">📅 تاريخ الطلب:</span> {{ $order->created_at }}</p>
                <p><span class="font-semibold">📍 عنوان التوصيل:</span> {{ $order->address }}</p>
                <p><span class="font-semibold">حالة الطلب:</span> {{ $order->condition }}</p>
            </div>

            <!-- المنتجات -->
            <h4 class="font-semibold text-red-600 mb-3">🛒 تفاصيل المنتجات</h4>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-center border-collapse border rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="border px-3 py-2">صورة المنتج</th>
                            <th class="border px-3 py-2">اسم المنتج</th>
                            <th class="border px-3 py-2">السعر</th>
                            <th class="border px-3 py-2">الكمية</th>
                            <th class="border px-3 py-2">الإجمالي</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach(json_decode($order->cart, true) ?? [] as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border px-3 py-2">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="mx-auto h-16 w-16 object-cover rounded-lg">
                            </td>
                            <td class="border px-3 py-2">{{ $item['name'] }}</td>
                            <td class="border px-3 py-2">{{ $item['price'] }} JD</td>
                            <td class="border px-3 py-2">{{ $item['quantity'] }}</td>
                            <td class="border px-3 py-2 font-bold text-red-600">{{ $item['price'] * $item['quantity'] }} JD</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @empty
        <p class="text-center text-gray-500 text-lg">🚫 لا يوجد لديك طلبات حالياً.</p>
        @endforelse
    </main>

    <!-- الفوتر -->
    <footer>
        <div class="footer-about">
            <h2>نبذة عنا</h2>
            <p>
                نحن متجر عطور متخصص في تقديم أجود أنواع العطور الرجالية والنسائية والمشتركة بجودة عالية وأسعار مناسبة.
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
    </script>
</body>

</html>
