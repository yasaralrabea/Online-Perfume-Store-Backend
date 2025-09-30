<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم متجر العطور</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* إعادة ضبط أساسي */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Cairo', sans-serif; background-color: #f4f5f7; color: #333; min-height: 100vh; }

        a { text-decoration: none; color: inherit; transition: color 0.3s ease; }
        a:hover { color: #fa314a; }

        /* الشريط العلوي */
        .topbar {
            background-color: #fff;
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgb(0 0 0 / 0.05);
        }
        .topbar h1 { font-size: 1.8rem; color: #fa314a; }
        .topbar form button {
            background: #fa314a;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.3s;
        }
        .topbar form button:hover { background: #ff5c7a; }

        /* قائمة الأزرار (محوّلة من القائمة الجانبية) */
        .dashboard-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin: 25px 15px;
        }
        .dashboard-buttons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 180px;
            height: 60px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgb(0 0 0 / 0.08);
            font-weight: 600;
            font-size: 1.1rem;
            color: #444;
            transition: transform 0.3s, box-shadow 0.3s, background 0.3s, color 0.3s;
        }
        .dashboard-buttons a:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgb(250 49 74 / 0.25);
            background: #fa314a;
            color: #fff;
        }

        /* قسم المحتوى الرئيسي */
        main {
            max-width: 1200px;
            margin: 0 auto 50px;
            padding: 0 15px;
        }

        /* العنوان */
        main h1 {
            text-align: center;
            font-size: 2rem;
            color: #fa314a;
            margin: 30px 0;
        }

        /* بطاقات الإحصائيات */
        .stats {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 50px;
        }
        .stat-card {
            background-color: #fff;
            padding: 30px 25px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgb(0 0 0 / 0.12);
            text-align: center;
            width: 250px;
            transition: transform 0.35s ease, box-shadow 0.35s ease;
            position: relative;
        }
        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgb(250 49 74 / 0.3);
        }
        .stat-card h2 {
            font-size: 1.5rem;
            color: #4b2e2e;
            margin-bottom: 15px;
        }
        .stat-card p:first-of-type {
            font-size: 2rem;
            font-weight: 700;
            color: #fa314a;
            margin-bottom: 8px;
        }
        .stat-card p:last-of-type {
            font-size: 1.1rem;
            color: #666;
        }

        /* أيقونات بطاقات الإحصائيات */
        .stat-card::before {
            content: '';
            display: block;
            width: 50px;
            height: 50px;
            margin: 0 auto 15px;
            background-size: cover;
        }
        .stat-card.orders::before {
            background-image: url('https://img.icons8.com/ios-filled/50/fa314a/sale.png');
        }
        .stat-card.users::before {
            background-image: url('https://img.icons8.com/ios-filled/50/fa314a/user-group-man-man.png');
        }

        /* جدول العطور */
        .popular-perfumes {
            background-color: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 12px rgb(0 0 0 / 0.08);
            margin-bottom: 50px;
        }
        .popular-perfumes h2 {
            font-size: 1.8rem;
            color: #fa314a;
            margin-bottom: 20px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 12px;
            overflow: hidden;
        }
        thead {
            background-color: #fa314a;
            color: #fff;
        }
        th, td {
            padding: 12px 15px;
            text-align: right;
            font-size: 1rem;
        }
        tbody tr:nth-child(even) { background-color: #fff0f0; }
        tbody tr:hover {
            background-color: #ffdce0;
            transform: translateX(3px);
            box-shadow: 0 4px 12px rgb(0 0 0 / 0.08);
        }

        /* استجابة */
        @media (max-width: 768px) {
            .stats, .dashboard-buttons { flex-direction: column; gap: 20px; align-items: center; }
        }
    </style>
</head>
<body>
    <!-- الشريط العلوي -->
    <header class="topbar">
        <h1>لوحة التحكم</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">تسجيل الخروج</button>
        </form>
    </header>

    <!-- أزرار القائمة (داخل الصفحة) -->
    <section class="dashboard-buttons">
        <a href="admin_page">الرئيسية</a>
        <a href="orders">الطلبات</a>
        <a href="add_product_form">المنتجات</a>
        <a href="users">المستخدمون</a>
        <a href="show_Q">الاستفسارات</a>
        <a href="#">التقارير</a>
        <a href="all_orders">كل الطلبات</a>
    </section>

    <!-- المحتوى الرئيسي -->
    <main>
        <h1>لوحة تحكم متجر العطور</h1>

        <!-- إحصائيات مختصرة -->
        <section class="stats">
            <div class="stat-card orders">
                <h2>الأكثر مبيعا</h2>
                <p>{{ $top_one }}</p>
                <p>{{ $items }} مرة</p>
            </div>
            <div class="stat-card users">
                <h2>عدد المستخدمين</h2>
                <p>{{ $users_num }}</p>
                <p>مسجل في المتجر</p>
            </div>
        </section>

        <!-- قائمة العطور الأكثر شهرة -->
        <section class="popular-perfumes">
            <h2>العطور الأكثر شهرة</h2>
            <table>
                <thead>
                    <tr>
                        <th>اسم العطر</th>
                        <th>الكمية المباعة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($popular_perfumes as $perfume)
                        <tr>
                            <td>{{ $perfume->name }}</td>
                            <td>{{ $perfume->number_of_sales}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
