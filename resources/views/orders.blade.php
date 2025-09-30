<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>الطلبات والسلة</title>

<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet" />

<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'Cairo', sans-serif;
    background-color: #f9f9fb;
    color: #333;
    display: flex;
    min-height: 100vh;
}

nav {
    width: 240px;
    background: #fff;
    padding: 30px 20px;
    box-shadow: 2px 0 10px rgba(0,0,0,0.05);
}
nav ul { list-style: none; }
nav ul li { margin-bottom: 20px; }
nav ul li a {
    color: #fa314a;
    font-weight: 600;
    font-size: 1.1rem;
    text-decoration: none;
    display: block;
    padding: 8px 12px;
    border-radius: 8px;
    transition: all 0.3s ease;
}
nav ul li a:hover { background-color: #fa314a; color: #fff; }

main {
    flex-grow: 1;
    padding: 40px 50px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
}

h2 {
    font-size: 2rem;
    color: #fa314a;
    font-weight: 700;
    margin-bottom: 30px;
    text-align: center;
    border-bottom: 2px solid #fa314a;
    padding-bottom: 10px;
    width: 100%;
}

.order-card {
    width: 100%;
    max-width: 900px;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    padding: 25px 30px;
    margin-bottom: 25px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.order-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.15);
}

.order-card p { margin: 8px 0; font-size: 1rem; }
.order-card strong { color: #fa314a; }

.cart-items {
    margin-top: 12px;
    padding-right: 1rem;
    border-right: 4px solid #fa314a;
}
.cart-items ul {
    list-style: disc;
    padding-right: 1.2rem;
    margin: 5px 0 0 0;
}
.cart-items li {
    margin-bottom: 5px;
    font-size: 1rem;
}
.cart-items li span { font-weight: 600; color: #333; }

.order-status-buttons {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 15px;
}
.status-btn {
    padding: 8px 16px;
    border-radius: 12px;
    color: white;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 0.95rem;
    user-select: none;
}
.status-btn.cancel { background-color: #d32f2f; }
.status-btn.cancel:hover { background-color: #b71c1c; }
.status-btn.received { background-color: #388e3c; }
.status-btn.received:hover { background-color: #2e7d32; }
.status-btn.delivering { background-color: #fbc02d; color: #333; }
.status-btn.delivering:hover { background-color: #f9a825; }
.status-btn.preparing { background-color: #1976d2; }
.status-btn.preparing:hover { background-color: #1565c0; }

p.no-orders {
    font-size: 1.2rem;
    font-weight: 500;
    color: #4b2e2e;
    text-align: center;
    margin-top: 50px;
}

@media (max-width: 768px) {
    nav { width: 200px; padding: 20px; }
    main { padding: 30px 20px; }
}
@media (max-width: 480px) {
    nav { width: 160px; padding: 15px; }
    main { padding: 20px 15px; }
    h2 { font-size: 1.6rem; }
    .order-card { padding: 20px; }
}
</style>
</head>

<body>
<nav>
    <ul>
        <li><a href="admin_page">الرئيسية</a></li>
        <li><a href="orders">الطلبات</a></li>
        <li><a href="add_product_form">المنتجات</a></li>
        <li><a href="users">المستخدمون</a></li>
        <li><a href="#">التقارير</a></li>
        <li><a href="#">الإعدادات</a></li>
    </ul>
</nav>

<main>
    <h2>الطلبات مع معلومات السلة</h2>

    @if($orders->count() > 0)
        @foreach ($orders as $order)
            <div class="order-card">
                <p><strong>رقم الطلب:</strong> {{ $order->id }}</p>
                <p><strong>الاسم:</strong> {{ $order->name }}</p>
                <p><strong>الإيميل:</strong> {{ $order->email }}</p>
                <p><strong>الهاتف:</strong> {{ $order->phone }}</p>
                <p><strong>العنوان:</strong> {{ $order->address }}</p>

                <div class="cart-items">
                    <p><strong>السلة:</strong></p>
                    @if($order->cart && is_array($order->cart))
                        <ul>
                            @foreach($order->cart as $item)
                                <li>
                                    اسم: <span>{{ $item['name'] ?? 'غير معروف' }}</span> |
                                    كود: <span>{{ $item['code'] ?? 'غير معروف' }}</span> |
                                    سعر: <span>{{ number_format($item['price'] ?? 0, 2) }} د.إ</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>لا توجد سلة مرتبطة.</p>
                    @endif
                </div>

                <div class="order-status-buttons">
                    <a href="{{ route('orders.cancel', $order->id) }}" class="status-btn cancel">إلغاء</a>
                    <a href="{{ route('orders.delivering', $order->id) }}" class="status-btn delivering">قيد التوصيل</a>
                    <a href="{{ route('orders.preparing', $order->id) }}" class="status-btn preparing">يتم تحضير الطلب</a>
                    <a href="{{ route('orders.deliverd', $order->id) }}" class="status-btn received">تم الاستلام</a>
                </div>
            </div>
        @endforeach
    @else
        <p class="no-orders">لا توجد طلبات حتى الآن.</p>
    @endif
</main>

</body>
</html>
