@extends('front.layouts.master')
@php
    use App\Models\dashboard\PageContent;
    $searchHero = PageContent::getSectionAsArray('search', 'hero');
    $searchEmpty = PageContent::getSectionAsArray('search', 'empty');
    $labels = PageContent::getSectionAsArray('product', 'labels');
@endphp
@section('title')
{{ $searchHero['title'] ?? 'Search' }}{{ $query ? ': ' . $query : '' }} - L.D IMPORTER
@endsection
@section('content')

    <!-- Hero Banner -->
    <header class="page-hero" style="min-height: 40vh; height: auto; padding: 180px 0 80px 0;">
        <div class="container" data-aos="zoom-out" data-aos-duration="1200">
            <h1 class="hero-title-en">{{ $searchHero['title'] ?? 'SEARCH' }}</h1>
            <div class="hero-divider"></div>
            <p class="hero-desc">{{ $query ? ($searchHero['description'] ?? 'Results for') . ' "' . $query . '"' : ($searchHero['description'] ?? 'Search our furniture collection') }}</p>
        </div>
    </header>

    <!-- Search Form -->
    <section class="container" style="margin-top: -40px; position: relative; z-index: 10;">
        <form action="{{ route('front.search') }}" method="GET">
            <div class="row g-3 justify-content-center align-items-center">
                <div class="col-md-5">
                    <div class="position-relative">
                        <i class="fa-solid fa-magnifying-glass position-absolute" style="left: 20px; top: 50%; transform: translateY(-50%); color: #999; pointer-events: none;"></i>
                        <input type="text" name="q" class="form-control search-main-input"
                            placeholder="Search furniture, tables, mirrors..."
                            value="{{ $query }}" style="padding-left: 45px;">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select search-select-input">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="sort" class="form-select search-select-input">
                        <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="price_low" {{ $sort == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high" {{ $sort == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="name" {{ $sort == 'name' ? 'selected' : '' }}>Name A-Z</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn search-btn-submit">
                        <i class="fa-solid fa-magnifying-glass me-2"></i> Search
                    </button>
                </div>
            </div>
        </form>
    </section>

    <!-- Results Count -->
    <section class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <p class="text-muted mb-0">
                <span class="fw-bold">{{ $products->count() }}</span> products found
                @if($query)
                for "<span class="fw-bold">{{ $query }}</span>"
                @endif
            </p>
            <div class="view-mode-icons d-none d-sm-flex">
                <i class="fa-solid fa-border-all active" id="gridViewBtn" title="Grid View"></i>
                <i class="fa-solid fa-list" id="listViewBtn" title="List View"></i>
            </div>
        </div>
    </section>

    <!-- Products Grid -->
    <main class="container mt-3 mb-5">
        @if($products->count() > 0)
        <div class="row g-3 g-md-4 catalog-main-wrapper" id="productsCatalogWrapper">
            @foreach($products as $product)
            <div class="col-6 col-md-3 product-catalog-item" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                <a href="{{ route('front.product', $product->slug) }}" class="text-decoration-none">
                    <div class="catalog-img-box">
                        <img src="{{ $product->mainImage ? asset('assets/uploads/products/' . $product->mainImage->image) : 'https://via.placeholder.com/600x400' }}"
                            alt="{{ $product->name }}">
                        <button type="button" class="favorite-btn {{ in_array($product->id, session()->get('favorites', [])) ? 'active' : '' }}"
                            data-id="{{ $product->id }}" onclick="event.preventDefault(); event.stopPropagation(); toggleFavorite(this);">
                            <i class="fa{{ in_array($product->id, session()->get('favorites', [])) ? 's' : 'r' }} fa-heart"></i>
                        </button>
                        @if($product->has_discount)
                        <span class="badge badge-danger position-absolute" style="top:10px;left:10px;background-color:var(--premium-red);">Sale</span>
                        @endif
                        <button class="quick-add-overlay-btn">{{ $labels['view_details'] ?? 'VIEW DETAILS +' }}</button>
                    </div>
                    <div class="catalog-meta">
                        <div>
                            <div class="catalog-title">{{ $product->name }}</div>
                            <div class="catalog-desc-text">{{ $product->category->name ?? '' }}</div>
                        </div>
                        <div class="catalog-price">
                            @if($product->has_discount)
                            <span style="text-decoration:line-through;color:#999;font-size:12px;">₪{{ number_format($product->price, 0) }}</span>
                            <span class="text-danger ms-1">₪{{ number_format($product->discount_price, 0) }}</span>
                            @else
                            ₪{{ number_format($product->price, 0) }}
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <i class="fa-solid fa-magnifying-glass fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">{{ $searchEmpty['title'] ?? 'No products found' }}</h4>
            <p class="text-muted">{{ $searchEmpty['description'] ?? 'Try different keywords or browse our categories.' }}</p>
            <a href="{{ route('front.category') }}" class="btn btn-dark mt-3">{{ $searchEmpty['button_text'] ?? 'Browse All Products' }}</a>
        </div>
        @endif
    </main>

@endsection

@section('js')
    <script>
        const gridViewBtn = document.getElementById('gridViewBtn');
        const listViewBtn = document.getElementById('listViewBtn');
        const wrapper = document.getElementById('productsCatalogWrapper');
        const items = wrapper ? wrapper.getElementsByClassName('product-catalog-item') : [];

        if (listViewBtn && gridViewBtn && wrapper) {
            listViewBtn.addEventListener('click', function() {
                gridViewBtn.classList.remove('active');
                listViewBtn.classList.add('active');
                wrapper.classList.add('list-activated');
                for (let i = 0; i < items.length; i++) {
                    items[i].classList.remove('col-6', 'col-md-3');
                    items[i].classList.add('col-12');
                }
            });

            gridViewBtn.addEventListener('click', function() {
                listViewBtn.classList.remove('active');
                gridViewBtn.classList.add('active');
                wrapper.classList.remove('list-activated');
                for (let i = 0; i < items.length; i++) {
                    items[i].classList.remove('col-12');
                    items[i].classList.add('col-6', 'col-md-3');
                }
            });
        }
    </script>
@endsection
