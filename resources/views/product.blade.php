<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>عرض المنتج - {{ $getproduct->name }}</title>
<link rel="stylesheet" href="{{ asset('css/home.css') }}" />
<style>
/* ======= الهيدر ======= */
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 15px;
    background-color: #e8e6e6;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    position: relative;
    z-index: 1000;
}
.topbar-left { display:flex; align-items:center; gap:10px; }
.menu-btn { font-size:24px; background:none; border:none; cursor:pointer; }
.topbar-right { display:flex; align-items:center; gap:10px; }
.topbar-right a,
.topbar-right button {
    padding:6px 10px;
    border-radius:5px;
    text-decoration:none;
    font-weight:bold;
    font-size:14px;
    transition: background-color 0.3s;
    color:#333;
    background:none;
    border:none;
    cursor:pointer;
}
.topbar-right a:hover,
.topbar-right button:hover { background-color:#f2f2f2; }

/* أيقونة السلة */
.bag-link img { width:28px; height:28px; transition:transform 0.2s; }
.bag-link:hover img { transform: scale(1.1); }

/* ======= القائمة الجانبية ======= */
#sidebar {
    position: fixed;
    top:0;
    right:-270px;
    width:270px;
    height:100%;
    background-color:#fff;
    box-shadow:-2px 0 5px rgba(0,0,0,0.1);
    padding:15px;
    transition: right 0.3s;
    overflow-y:auto;
    z-index:999;
}
#sidebar.active { right:0; }
#overlay {
    position: fixed;
    top:0; left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.3);
    opacity:0;
    visibility:hidden;
    transition:opacity 0.3s;
    z-index:998;
}
#overlay.active { opacity:1; visibility:visible; }
.sidebar h2 { margin-bottom:10px; color:#b71c1c; font-weight:700; border-bottom:2px solid #b71c1c; padding-bottom:8px; }
.sidebar ul { list-style:none; padding:0; margin:0; }
.sidebar ul li { padding:10px; cursor:pointer; position:relative; }
.sidebar ul li a { text-decoration:none; color:#333; display:block; }
.sidebar ul li .submenu { display:none; padding-right:15px; list-style:none; }
.sidebar ul li.open .submenu { display:block; }
.sidebar ul li .submenu li { padding:6px 0; }

/* ======= الفوتر ======= */
footer {
    background:#403f3f;
    padding:20px;
    display:flex;
    justify-content:space-between;
    flex-wrap:wrap;
    color:#fff;
}
footer h2, footer h3 { margin:0 0 10px 0; }

/* ======= محتوى المنتج ======= */
.main-content {
    max-width:900px;
    margin:20px auto;
    padding:0 20px;
}

/* بطاقة المنتج */
.product-detail {
    border:1px solid #eee;
    padding:25px 30px;
    border-radius:12px;
    box-shadow:0 4px 20px rgba(183,28,28,0.15);
    background:#fff;
    transition: box-shadow 0.3s ease;
    margin-bottom:20px;
    text-align:center;
}
.product-detail:hover { box-shadow:0 8px 30px rgba(183,28,28,0.25); }
.product-detail img { display:block; margin:0 auto 25px; max-width:50%; height:auto; border-radius:10px; box-shadow:0 6px 15px rgba(183,28,28,0.12); transition: transform 0.3s ease; }
.product-detail img:hover { transform: scale(1.05); }
h1 { color:#b71c1c; font-weight:700; font-size:2.2rem; margin-bottom:20px; letter-spacing:1.2px; }
.product-info { font-size:1.15rem; margin-bottom:12px; color:#555; font-weight:600; border-bottom:1px solid #f0f0f0; padding-bottom:8px; text-align:left; }
.product-info strong { color:#b71c1c; margin-left:10px; font-weight:700; }
.add-to-cart-btn { display:block; width:100%; max-width:320px; margin:20px auto; background-color:#b71c1c; color:#fff; padding:12px 0; text-align:center; font-size:1.25rem; font-weight:700; border-radius:8px; text-decoration:none; box-shadow:0 6px 14px rgba(183,28,28,0.4); cursor:pointer; transition: background-color 0.3s ease, box-shadow 0.3s ease; }
.add-to-cart-btn:hover { background-color:#7a0e0e; box-shadow:0 8px 22px rgba(122,14,14,0.6); }
.qty-box { display:flex; align-items:center; justify-content:center; gap:10px; margin-bottom:15px; }
.qty-box button { padding:8px 14px; font-size:1.2rem; font-weight:700; background:#b71c1c; color:#fff; border:none; border-radius:6px; cursor:pointer; }
.qty-box input { width:70px; text-align:center; font-size:1.1rem; padding:6px; border:1px solid #ccc; border-radius:6px; }
.success-message { background-color:#d4edda; color:#155724; border:1px solid #c3e6cb; padding:15px 25px; border-radius:10px; margin-bottom:25px; font-size:1.2rem; font-weight:700; text-align:center; box-shadow:0 4px 12px rgba(21,87,36,0.25); }

/* فورم التقييم */
.product-review-form {
    margin-top:30px;
    padding:20px;
    border:1px solid #eee;
    border-radius:12px;
    background:#fafafa;
    box-shadow:0 4px 15px rgba(183,28,28,0.1);
}
.product-review-form h2 { text-align:center; color:#b71c1c; margin-bottom:15px; }
.product-review-form label { display:block; margin-bottom:6px; font-weight:600; }
.product-review-form select,
.product-review-form textarea {
    width:100%;
    padding:10px;
    border-radius:6px;
    border:1px solid #ccc;
    font-size:1rem;
    margin-bottom:15px;
    resize:none;
}
.product-review-form button {
    background-color:#b71c1c;
    color:#fff;
    padding:12px 20px;
    font-size:1.1rem;
    font-weight:700;
    border:none;
    border-radius:6px;
    cursor:pointer;
    display:block;
    margin:0 auto;
    transition:background-color 0.3s, box-shadow 0.3s;
}
.product-review-form button:hover {
    background-color:#7a0e0e;
    box-shadow:0 4px 12px rgba(122,14,14,0.4);
}

/* عرض التقييمات */
.product-reviews {
    margin-top:30px;
}
.product-reviews h2 { text-align:center; color:#b71c1c; margin-bottom:20px; }
.review-card {
    border:1px solid #eee;
    border-radius:10px;
    padding:12px 18px;
    margin-bottom:12px;
    background:#fff;
    box-shadow:0 2px 6px rgba(183,28,28,0.1);
}
.review-card strong { color:#b71c1c; }
.review-card p { margin-top:5px; color:#555; }

/* استجابة */
@media (max-width:600px){
    .product-detail img { max-width:80%; }
    .add-to-cart-btn { max-width:100%; }
}
</style>
</head>

<body>
<div id="overlay" onclick="closeSidebar()"></div>

<!-- الهيدر -->
<header class="topbar">
    <div class="topbar-left">
        <button class="menu-btn" onclick="toggleSidebar()">☰</button>
        <a href="{{ route('home') }}" class="add-to-cart-btn" style="padding:6px 12px; font-size:14px;">← الرئيسية</a>
    </div>
    <div class="topbar-right">
        <a href="{{ route('cart') }}" class="bag-link" title="حقيبتي"><img src="https://img.icons8.com/ios-filled/50/fa314a/shopping-cart.png" alt="حقيبتي"/></a>
        <a href="{{ route('settings') }}" class="topbar-link">الإعدادات</a>
        <a href="{{ route('my.orders') }}" class="topbar-link">طلباتي</a>
        <a href="{{ route('profile.edit') }}" class="topbar-link">حسابي</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="topbar-link">تسجيل الخروج</button>
        </form>
    </div>
</header>

<!-- القائمة الجانبية -->
<aside id="sidebar" class="sidebar">
    <h2>الفئات</h2>
    <ul>
        <li class="has-submenu">عطور
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
<div class="main-content">

@if(session('success'))
<div class="success-message">{{ session('success') }}</div>
@endif

<div class="product-detail">
  <h1>{{ $getproduct->name }}</h1>
  @if($getproduct->image)
    <img src="{{ url($getproduct->image) }}" alt="{{ $getproduct->name }}">
  @else
    <img src="https://via.placeholder.com/600x400?text=لا+توجد+صورة" alt="لا توجد صورة">
  @endif
  <div class="product-info"><strong>الاسم:</strong> {{ $getproduct->name }}</div>
  <div class="product-info"><strong>الجنس:</strong> {{ $getproduct->sex }}</div>
  <div class="product-info"><strong>الوصف:</strong> {{ $getproduct->description }}</div>
  <div class="product-info"><strong>السعر:</strong> {{ $getproduct->price }} ريال</div> 
  <form action="{{ route('cart.add', $getproduct->id) }}" method="POST" style="margin-top:20px;">
    @csrf
    <div class="qty-box">
      <button type="button" id="decreaseQty">-</button>
      <input type="number" id="quantity" name="quantity" value="1" min="1">
      <button type="button" id="increaseQty">+</button>
    </div>
    <button type="submit" class="add-to-cart-btn">إضافة للسلة</button>
  </form>
</div>

<div class="product-review-form">
<h2>قيم هذا المنتج</h2>
<form action="{{ route('product.rate', $getproduct->id) }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $getproduct->id }}">

    <label for="rating">التقييم (1-5 نجوم):</label>
    <select name="rating" id="rating" required>
        <option value="">اختر</option>
        @for($i = 1; $i <= 5; $i++)
            <option value="{{ $i }}">{{ $i }} ⭐</option>
        @endfor
    </select>

    <label for="comment">التعليق:</label>
    <textarea name="comment" id="comment" rows="4" placeholder="أضف تعليقك هنا..."></textarea>

    <button type="submit">إرسال التقييم</button>
</form>

</div>

<div class="product-reviews">
<h2>تقييمات المنتج</h2>
@foreach($topReviews as $review)
<div class="review-card">
<strong>{{ $review->user->name ?? 'مستخدم مجهول' }}:</strong>
<span>{{ $review->rating }} ⭐</span>
<p>{{ $review->comment }}</p>
</div>
@endforeach

<div id="moreReviews" style="display:none;">
@foreach($rates->slice(5) as $review)
<div class="review-card">
<strong>{{ $review->user->name ?? 'مستخدم مجهول' }}:</strong>
<span>{{ $review->rating }} ⭐</span>
<p>{{ $review->comment }}</p>
</div>
@endforeach
</div>

@if($rates->count() > 5)
<button id="loadMoreBtn" class="add-to-cart-btn" style="margin-top:15px;">عرض كل التقييمات</button>
@endif
</div>
</div> <!-- نهاية main-content -->

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

<script>
document.addEventListener('DOMContentLoaded', function(){
  const btn = document.getElementById('loadMoreBtn');
  const more = document.getElementById('moreReviews');
  if(btn){ btn.addEventListener('click', ()=>{ more.style.display = more.style.display==='none'?'block':'none'; btn.textContent=more.style.display==='block'?'إخفاء التقييمات':'عرض كل التقييمات'; }); }
  
  const qtyInput = document.getElementById('quantity');
  document.getElementById('increaseQty').addEventListener('click', ()=>{ qtyInput.value = parseInt(qtyInput.value)+1; });
  document.getElementById('decreaseQty').addEventListener('click', ()=>{ if(parseInt(qtyInput.value)>1) qtyInput.value=parseInt(qtyInput.value)-1; });

  document.querySelectorAll('.sidebar .has-submenu').forEach(item=>{
    item.addEventListener('click', function(e){ if(e.target.tagName!=='A') this.classList.toggle('open'); });
  });
});

function toggleSidebar(){ document.getElementById('sidebar').classList.toggle('active'); document.getElementById('overlay').classList.toggle('active'); }
function closeSidebar(){ document.getElementById('sidebar').classList.remove('active'); document.getElementById('overlay').classList.remove('active'); }
</script>

</body>
</html>
