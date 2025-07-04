@foreach($products as $product)
<div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up">
    <div class="product-card position-relative">
        <button class="favorite-btn {{ in_array($product->id_product, $favoriteProductIds ?? []) ? 'active' : '' }}" 
                title="Yêu thích" 
                data-id="{{ $product->id_product }}">
            <i class="fa-{{ in_array($product->id_product, $favoriteProductIds ?? []) ? 'solid' : 'regular' }} fa-heart"></i>
        </button>
        <div class="product-img">
            <img src="{{ asset('uploads/productimage/' . $product->image_address_product) }}" 
                 alt="{{ $product->name_product }}"
                 loading="lazy">
            <div class="product-actions">
                <a href="{{ route('product.indexDetailproduct', ['id' => $product->id_product]) }}" 
                   class="btn-action">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('cart.indexCart') }}" class="btn-action">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </div>
        </div>
        <div class="product-info">
            <div class="product-category">
                @foreach($productsWithCategorys as $category)
                    @if($product->id_category == $category->id_category)
                        {{ $category->name_category }}
                        @break
                    @endif
                @endforeach
            </div>
            <h4 class="product-name">
                <a href="{{ route('product.indexDetailproduct', ['id' => $product->id_product]) }}">
                    {{ $product->name_product }}
                </a>
            </h4>
            <div class="product-manufacturer">
                {{ $productsWithManufacturers->firstWhere('id_manufacturer', $product->id_manufacturer)->name_manufacturer ?? '' }}
            </div>
            <div class="product-price">{{ number_format($product->price_product, 0, ',', '.') }} VNĐ</div>
        </div>
    </div>
</div>
@endforeach 