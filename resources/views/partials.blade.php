@forelse($products as $product)
    <div class="product-card" onclick="window.location='{{ route('products.show', $product->id) }}'">
        @if($product->image)
            <img src="{{ url($product->image) }}" alt="{{ $product->name }}">
        @else
            <img src="https://via.placeholder.com/400x300?text=بدون+صورة" alt="لا توجد صورة">
        @endif

        <h3>{{ $product->name }}</h3>
        <p>{{ $product->description }}</p>
        <span class="price">{{ $product->price }} jd</span>

        {{-- زر الإضافة للسلة الجديد --}}
        <form method="POST" action="{{ route('cart.add', $product->id) }}" onclick="event.stopPropagation();">
            @csrf
            <button type="submit" class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.6 8H19m-6-4a2 2 0 100-4 2 2 0 000 4z"/>
                </svg>
                إضافة للسلة
            </button>
        </form>
    </div>
@empty
    <p>لا توجد منتجات.</p>
@endforelse

{{-- عنصر مخفي لتسهيل Ajax تحميل المزيد --}}
@if($products->hasMorePages())
    <div class="pagination-probe" data-next="{{ $products->nextPageUrl() }}" style="display:none;"></div>
@endif
