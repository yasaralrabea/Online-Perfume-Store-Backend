<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>إضافة منتج</title>

<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet" />

<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }

  body {
    font-family: 'Cairo', sans-serif;
    background-color: #f9f9fb;
    display: flex;
    min-height: 100vh;
    color: #333;
  }

  nav {
    width: 240px;
    background: #fff;
    box-shadow: 2px 0 10px rgba(0,0,0,0.05);
    padding: 30px 20px;
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
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 2rem;
  }

  .form-card {
    background: #fff;
    padding: 40px 30px;
    border-radius: 20px;
    max-width: 500px;
    width: 100%;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .form-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
  }

  h1 {
    text-align: center;
    color: #fa314a;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 30px;
    border-bottom: 2px solid #fa314a;
    padding-bottom: 10px;
  }

  .filter-buttons {
    text-align: center;
    margin-bottom: 25px;
  }
  .filter-btn {
    background: #fa314a;
    color: #fff;
    padding: 8px 16px;
    border-radius: 25px;
    font-weight: 600;
    margin: 5px;
    display: inline-block;
    transition: all 0.3s ease;
  }
  .filter-btn:hover { background: #d72a3a; }

  form label {
    display: block;
    margin-bottom: 6px;
    margin-top: 15px;
    font-weight: 600;
    color: #4b2e2e;
  }
  form input, form select {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #fa314a;
    border-radius: 12px;
    font-size: 1rem;
    margin-bottom: 5px;
    transition: all 0.3s ease;
  }
  form input:focus, form select:focus { border-color: #d72a3a; outline: none; }

  form button[type="submit"] {
    width: 100%;
    padding: 12px;
    background: #fa314a;
    color: #fff;
    border: none;
    font-size: 1.15rem;
    font-weight: 700;
    border-radius: 25px;
    margin-top: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
  }
  form button[type="submit"]:hover {
    background: #d72a3a;
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
  }

  .success-message {
    background: #c8e6c9;
    color: #256029;
    padding: 12px;
    border-radius: 12px;
    font-weight: 600;
    text-align: center;
    margin-bottom: 15px;
  }
  .error-message {
    color: #b71c1c;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 5px;
  }

  @media (max-width: 768px) {
    nav { width: 200px; padding: 20px; }
    .form-card { padding: 30px 25px; }
  }
  @media (max-width: 480px) {
    nav { width: 160px; padding: 15px; }
    .form-card { padding: 25px 20px; }
    h1 { font-size: 1.6rem; }
  }
</style>
</head>

<body>
  
@if(session('success'))
<div class="success-message">
  {{ session('success') }}
</div>
@endif
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
  <div class="form-card">
    <h1>إضافة منتج جديد</h1>

    <div class="filter-buttons">
      <a href="{{ route('products.male') }}" class="filter-btn">عطور رجالية</a>
      <a href="{{ route('products.female') }}" class="filter-btn">عطور نسائية</a>
      <a href="{{ route('every') }}" class="filter-btn">الكل</a>
    </div>

    @if(session('success'))
      <div class="success-message">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('add_product') }}">
      @csrf

      <label for="name">اسم المنتج</label>
      <input type="text" id="name" name="name" value="{{ old('name') }}" required />
      @error('name')<div class="error-message">{{ $message }}</div>@enderror

      <label for="description">وصف المنتج</label>
      <input type="text" id="description" name="description" value="{{ old('description') }}" required />
      @error('description')<div class="error-message">{{ $message }}</div>@enderror


      <label for="name">الكمية </label>
      <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}" required />
      @error('quantity')<div class="error-message">{{ $message }}</div>@enderror

      <label for="name">مل </label>
      <input type="ml" id="ml" name="ml" value="{{ old('ml') }}" required />
      @error('ml ')<div class="error-message">{{ $message }}</div>@enderror

      <label for="code">الكود</label>
      <input type="number" id="code" name="code" value="{{ old('code') }}" required />
      @error('code')<div class="error-message">{{ $message }}</div>@enderror
      
<label for="image">مسار الصورة</label>
      <input type="text" id="image" name="image" value="{{ old('image') }}" required />
      @error('image')<div class="error-message">{{ $message }}</div>@enderror

            
<label for="image">مميز </label>
      <input type="text" id="special" name="special" value="{{ old('special') }}" required />
      @error('special')<div class="error-message">{{ $message }}</div>@enderror

      <label for="sex">الفئة</label>
      <select id="sex" name="sex" required>
        <option value="">اختر الفئة</option>
        <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>عطور رجالية</option>
        <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>عطور نسائية</option>
        <option value="all" {{ old('sex') == 'all' ? 'selected' : '' }}>الكل</option>
      </select>
      @error('sex')<div class="error-message">{{ $message }}</div>@enderror

      <label for="price">السعر</label>
      <input type="number" step="0.01" id="price" name="price" value="{{ old('price') }}" required />
      @error('price')<div class="error-message">{{ $message }}</div>@enderror

      <button type="submit">إضافة المنتج</button>
    </form>
  </div>
</main>
</body>
</html>
