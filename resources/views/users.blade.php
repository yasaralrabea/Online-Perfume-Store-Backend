<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>قائمة المستخدمين</title>

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

  .btn-profile {
    background: #fa314a;
    color: #fff;
    padding: 6px 12px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-block;
    margin-left: 5px;
  }
  .btn-profile:hover {
    opacity: 0.85;
  }

  /* ألوان مختلفة للأزرار الإضافية */
  .btn-promote { background-color: #4CAF50; }
  .btn-remove { background-color: #f44336; }
  .btn-demote { background-color: #ff9800; }

  p.no-users {
    font-size: 1.2rem;
    font-weight: 500;
    color: #4b2e2e;
    text-align: center;
    margin-top: 40px;
  }

  @media (max-width: 768px) {
    nav { width: 200px; padding: 20px; }
    main { padding: 30px 20px; }
    th, td { padding: 10px 12px; font-size: 0.95rem; }
  }
  @media (max-width: 480px) {
    nav { width: 160px; padding: 15px; }
    main { padding: 20px 15px; }
    h1 { font-size: 1.6rem; }
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
    <h1>قائمة المستخدمين</h1>

    @if($users->isEmpty())
        <p class="no-users">لا يوجد مستخدمون لعرضهم.</p>
    @else
    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
    <a href="{{ route('users.show', $user->id) }}" class="btn-profile">زيارة الملف الشخصي</a>

    @if($user->role != 'admin')
        <a href="{{ route('users.promote', $user->id) }}" 
           class="btn-profile btn-promote"
           onclick="return confirm('هل أنت متأكد أنك تريد ترقية هذا المستخدم إلى أدمن؟');">
           ترقية لادمن
        </a>
    @endif

    <a href="{{ route('users.remove', $user->id) }}" 
       class="btn-profile btn-remove"
       onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا المستخدم؟');">
       إزالة
    </a>

    @if($user->role == 'admin')
        <a href="{{ route('users.demote', $user->id) }}" 
           class="btn-profile btn-demote"
           onclick="return confirm('هل أنت متأكد أنك تريد إزالة صلاحية الأدمن من هذا المستخدم؟');">
           إزالة ادمن
        </a>
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
