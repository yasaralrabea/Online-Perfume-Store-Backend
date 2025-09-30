<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>الملف الشخصي</title>

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

  h1 {
    font-size: 2rem;
    color: #fa314a;
    font-weight: 700;
    margin-bottom: 30px;
    text-align: center;
    border-bottom: 2px solid #fa314a;
    padding-bottom: 10px;
    width: 100%;
  }

  .profile-card {
    width: 100%;
    max-width: 800px;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    padding: 25px;
    margin-bottom: 40px;
  }

  .profile-info p {
    font-size: 1.1rem;
    margin-bottom: 12px;
    line-height: 1.6;
  }
  .profile-info span {
    font-weight: 700;
    color: #fa314a;
  }

  .table-card {
    width: 100%;
    max-width: 900px;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    overflow-x: auto;
    padding: 20px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    min-width: 500px;
  }
  thead {
    background-color: #fa314a;
    color: #fff;
  }
  th, td {
    padding: 12px 18px;
    text-align: right;
    font-size: 1rem;
  }
  tbody tr:nth-child(even) { background-color: #fdf5f0; }
  tbody tr:hover {
    background-color: #ffe9dc;
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
  }

  p.no-orders {
    font-size: 1.1rem;
    font-weight: 500;
    color: #4b2e2e;
    text-align: center;
    margin-top: 20px;
  }

</style>
</head>

<body>
<nav>
    <ul>
        <li><a href="{{ url('admin_page') }}">الرئيسية</a></li>
        <li><a href="{{ url('orders') }}">الطلبات</a></li>
        <li><a href="{{ url('add_product_form') }}">المنتجات</a></li>
        <li><a href="{{ url('users') }}">المستخدمون</a></li>
        <li><a href="#">التقارير</a></li>
        <li><a href="#">الإعدادات</a></li>
    </ul>
</nav>

<main>
    <h1>الملف الشخصي</h1>

    <div class="profile-card">
        <div class="profile-info">
            <p><span>الاسم:</span> {{ $user->name }}</p>
            <p><span>البريد الإلكتروني:</span> {{ $user->email }}</p>
            <p><span>الهاتف:</span> {{ $user->phone ?? 'غير متوفر' }}</p>
            <p><span>العنوان:</span> {{ $user->address ?? 'غير متوفر' }}</p>
        </div>
    </div>

    <h1>الطلبات السابقة</h1>
    @if($orders->isEmpty())
        <p class="no-orders">لا توجد طلبات سابقة.</p>
    @else
    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>رقم الطلب</th>
                    <th>التاريخ</th>
                    <th>المبلغ</th>
                    <th>المنتجات</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    <td>{{ $order->total ?? 'غير محدد' }}</td>
                    <td>
                        @php
                            $items = json_decode($order->cart, true);
                        @endphp
                        @if($items)
                            <ul>
                                @foreach($items as $item)
                                    <li>{{ $item['name'] }} ({{ $item['quantity'] }})</li>
                                @endforeach
                            </ul>
                        @else
                            لا توجد منتجات
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</main>
</body>
</html>
