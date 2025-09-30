<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>تأكيد الطلب</title>
<style>
/* ===== عام ===== */
body {
  font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  margin:0; padding:0; background:#f7f7f7; color:#333; direction:rtl;
}

/* ===== الهيدر ===== */
.topbar {
  display:flex; justify-content:space-between; align-items:center;
  padding:10px 15px; background:#e8e6e6;
  box-shadow:0 2px 5px rgba(0,0,0,0.1);
  position:fixed; top:0; left:0; right:0; z-index:1000;
}
.topbar-left {display:flex; align-items:center;}
.menu-btn {font-size:24px; background:none; border:none; cursor:pointer;}
.topbar-right a, .topbar-right button {
  margin-left:10px; padding:6px 10px; border-radius:5px;
  font-weight:bold; font-size:14px; text-decoration:none; background:none; border:none; cursor:pointer; color:#333;
}
.topbar-right a:hover, .topbar-right button:hover {background:#f2f2f2;}
.bag-link img {width:28px;height:28px; transition:0.2s;}
.bag-link:hover img {transform:scale(1.1);}

/* ===== القائمة الجانبية ===== */
#sidebar {
  position:fixed; top:0; right:-300px;
  width:270px; height:100%; background:#fff;
  box-shadow:-2px 0 5px rgba(0,0,0,0.1); padding:15px;
  overflow-y:auto; z-index:1010; transition:right 0.3s ease;
}
#sidebar.active {right:0;}
#overlay {
  position:fixed; top:0; left:0; width:100%; height:100%;
  background: rgba(0,0,0,0.3); opacity:0; visibility:hidden;
  transition:0.3s; z-index:1005;
}
#overlay.active {opacity:1; visibility:visible;}
.sidebar h2 {margin-bottom:10px;}
.sidebar ul {list-style:none; padding:0; margin:0;}
.sidebar ul li {padding:10px;}
.sidebar ul li a {text-decoration:none; color:#333; display:block;}
.sidebar ul li a:hover {color:#b71c1c;}

/* ===== محتوى الصفحة ===== */
main {
  padding:120px 20px 40px 20px; max-width:1000px; margin:0 auto;
}
h1 {text-align:center; color:#b71c1c; font-size:2.5rem; margin-bottom:30px;}
h2 {color:#b71c1c; margin-bottom:15px;}

/* بيانات المستخدم */
.user-info p {margin:5px 0; font-size:1rem;}

/* جدول السلة */
.cart-table {width:100%; border-collapse:separate; border-spacing:0 12px;}
.cart-table thead {display:none;}
.cart-table tbody tr {
  display:flex; flex-wrap:wrap; background:#fff; border-radius:12px;
  box-shadow:0 5px 15px rgba(0,0,0,0.08); margin-bottom:15px; align-items:center;
}
.cart-table td {
  flex:1; padding:10px; text-align:center; font-size:1rem;
}
.cart-table td img {width:80px; height:80px; object-fit:cover; border-radius:10px; margin-bottom:5px;}

/* أزرار */
.delete-btn {
  background:#b71c1c; color:#fff; border:none; padding:8px 14px; border-radius:8px; cursor:pointer; transition:0.3s;
}
.delete-btn:hover {background:#7a0e0e;}
.next-btn {
  display:inline-block; background:#2e7d32; color:#fff; padding:14px 40px; font-weight:700; border-radius:10px;
  text-decoration:none; text-align:center; margin-top:20px; border:none; cursor:pointer; transition:0.3s;
}
.next-btn:hover {background:#1b4d21;}

/* طرق الدفع */
.payment-methods {margin-top:30px; display:flex; flex-direction:column; gap:10px;}
.payment-methods label {display:flex; align-items:center; gap:10px; font-weight:600;}

/* رسالة نجاح */
.success-message {
  background:#d4edda; color:#155724; padding:12px 20px; border-radius:10px;
  margin-bottom:20px; text-align:center;
}

/* استجابة */
@media(max-width:720px){
  .cart-table tbody tr {flex-direction:column; align-items:flex-start;}
  .cart-table td {flex:100%; text-align:right;}
  .payment-methods {gap:15px;}
}
</style>
</head>
<body>

<div id="overlay" onclick="closeSidebar()"></div>

<header class="topbar">
  <div class="topbar-left">
    <button class="menu-btn" onclick="toggleSidebar()">☰</button>
    <h1>تأكيد الطلب</h1>
  </div>
  <div class="topbar-right">
    <a href="{{ route('cart') }}" class="bag-link"><img src="https://img.icons8.com/ios-filled/50/fa314a/shopping-cart.png" alt="سلة التسوق"/></a>
    <a href="{{ route('user.page') }}" class="topbar-link">الرئيسية</a>
    <a href="{{ route('settings') }}" class="topbar-link">الإعدادات</a>
    <a href="{{ route('profile.edit') }}" class="topbar-link">حسابي</a>
    @auth
    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
      @csrf
      <button type="submit" class="topbar-link">تسجيل الخروج</button>
    </form>
    @else
    <a href="{{ route('login') }}" class="topbar-link">تسجيل الدخول</a>
    @endauth
  </div>
</header>

<aside id="sidebar" class="sidebar">
  <h2>الفئات</h2>
  <ul>
    <li><a href="{{ route('products.male') }}">عطور رجالي</a></li>
    <li><a href="{{ route('products.female') }}">عطور نسائي</a></li>
    <li><a href="#">عطور مشتركة</a></li>
    <li><a href="{{ route('every') }}">الكل</a></li>
    <li><a href="{{ route('question') }}">تواصل معنا</a></li>
  </ul>
</aside>

<main>
  @if(session('success'))
  <div class="success-message">{{ session('success') }}</div>
  @endif

  <section class="user-info">
    <h2>معلومات المستخدم</h2>
    <p>👤 الاسم: {{ $user->name }}</p>
    <p>📧 البريد الإلكتروني: {{ $user->email }}</p>
    <p>📞 الرقم: {{ $user->phone }}</p>
    <p>🏠 العنوان: {{ $user->address }}</p>
  </section>

  @if(count($cart) > 0)
    <h2>محتويات السلة</h2>
    <table class="cart-table">
      <tbody>
        @php $total=0; @endphp
        @foreach($cart as $item)
          @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
          <tr>
            <td>
              <a href="{{ route('products.show', $item['id']) }}">
                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}"><br>
                {{ $item['name'] }}
              </a>
            </td>
            <td>الكمية: {{ $item['quantity'] }}</td>
            <td>السعر: {{ number_format($item['price'],2) }}$</td>
            <td>الإجمالي: {{ number_format($subtotal,2) }}$</td>
          </tr>
        @endforeach
        <tr>
          <td colspan="4" style="text-align:right; font-weight:700; font-size:1.1rem;">الإجمالي الكلي: {{ number_format($total,2) }}$</td>
        </tr>
      </tbody>
    </table>
  @else
    <p style="text-align:center; margin-top:30px; font-weight:700; color:#b71c1c;">السلة فارغة.</p>
  @endif

  <div class="payment-methods">
    <h2>اختر طريقة الدفع</h2>
    <form action="{{ route('order.confirm') }}" method="POST">
      @csrf
      <label>
        <input type="radio" name="payment_method" value="cod" checked>
        الدفع عند الاستلام
      </label>
      <label>
        <input type="radio" name="payment_method" value="visa">
        فيزا
      </label>
      <button type="submit" class="next-btn">التالي</button>
    </form>
  </div>

</main>

<script>
function toggleSidebar(){
  document.getElementById('sidebar').classList.toggle('active');
  document.getElementById('overlay').classList.toggle('active');
}
function closeSidebar(){
  document.getElementById('sidebar').classList.remove('active');
  document.getElementById('overlay').classList.remove('active');
}
</script>

</body>
</html>
