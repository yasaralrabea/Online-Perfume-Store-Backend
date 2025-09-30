<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>سلة المشتريات</title>
<style>
/* ===== عام ===== */
body {
  font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  margin:0; padding:0; background:#f7f7f7; color:#333; direction:rtl; overflow-x:hidden;
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

/* ===== محتوى السلة ===== */
main {
  flex:1; padding:120px 20px 40px 20px;
  max-width:1000px; margin:0 auto;
}
h1 {color:#b71c1c; font-weight:700; font-size:2.5rem; margin-bottom:30px; text-align:center;}

/* بطاقات المنتجات */
.cart-products {display:flex; flex-direction:column; gap:20px;}
.product-card {
  display:flex; align-items:center; background:#fff; border-radius:15px;
  box-shadow:0 5px 15px rgba(0,0,0,0.08); padding:15px; transition:0.3s;
}
.product-card:hover {box-shadow:0 8px 25px rgba(0,0,0,0.12);}
.product-image {flex-shrink:0; width:100px; height:100px; object-fit:cover; border-radius:12px; margin-left:15px;}
.product-info {flex:1; display:flex; flex-direction:column; gap:6px;}
.product-name {font-weight:700; font-size:1.2rem; color:#333;}
.product-price {font-weight:700; font-size:1.1rem; color:#b71c1c;}
.product-quantity {display:flex; align-items:center; gap:10px;}
.product-actions {display:flex; flex-direction:column; gap:8px;}

/* أزرار */
.delete-btn {
  background:#b71c1c; color:#fff; border:none; padding:8px 14px; font-weight:700; border-radius:8px; cursor:pointer; transition:0.3s;
}
.delete-btn:hover {background:#7a0e0e;}
.confirm-btn {
  display:inline-block; background:#2e7d32; color:#fff; padding:14px 40px; font-weight:700; border-radius:10px; text-decoration:none; transition:0.3s;
  text-align:center; margin-top:20px;
}
.confirm-btn:hover {background:#1b4d21;}

/* رسالة السلة فارغة */
.empty-cart {
  text-align:center; font-weight:700; color:#b71c1c; margin-top:60px; padding:20px;
  border:2px dashed #b71c1c; border-radius:12px; background:#fceaea;
}

/* استجابة */
@media(max-width:720px){
  .product-card {flex-direction:column; align-items:flex-start;}
  .product-image {margin-left:0; margin-bottom:10px;}
  .product-actions {width:100%; flex-direction:row; justify-content:space-between;}
}
</style>
</head>
<body>

<div id="overlay" onclick="closeSidebar()"></div>

<header class="topbar">
  <div class="topbar-left">
    <button class="menu-btn" onclick="toggleSidebar()">☰</button>
    <h1 style="margin:0 15px 0 0; font-size:1.8rem;">سلة المشتريات</h1>
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
  @if(count($cart) > 0)
  <div class="cart-products">
    @foreach($cart as $item)
    <div class="product-card">
      <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="product-image"/>
      <div class="product-info">
        <span class="product-name">{{ $item['name'] }}</span>
        <span class="product-price">{{ number_format($item['price'],2) }}$</span>
        <div class="product-quantity">الكمية: {{ $item['quantity'] }}</div>
      </div>
      <div class="product-actions">
        <form action="{{ route('cart.delete', $item['id']) }}" method="POST" onsubmit="return confirm('هل تريد حذف المنتج؟')">
          @csrf
          <button type="submit" class="delete-btn">🗑 حذف</button>
        </form>
      </div>
    </div>
    @endforeach
  </div>
  <div style="text-align:center;">
    <a href="{{ route('confirm') }}" class="confirm-btn">أكمل الشراء</a>
  </div>
  @else
  <p class="empty-cart">السلة فارغة.</p>
  @endif
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
