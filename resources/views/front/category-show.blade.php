@extends('front.layouts.master')
@php
    $labels = \App\Models\dashboard\PageContent::getSectionAsArray('product', 'labels');
    $filterAll = \App\Models\dashboard\PageContent::getValue('category_page', 'filter', 'all_text', 'ALL');
    $productsShow = \App\Models\dashboard\PageContent::getValue('category_page', 'products', 'show_text', 'SHOW');
    $productsWord = \App\Models\dashboard\PageContent::getValue('category_page', 'products', 'word_text', 'PRODUCTS');
    $trustFeatures = \App\Models\dashboard\PageContent::getGrouped('category_page', 'features');
@endphp
@section('title')
{{ $category->name }} - L.D IMPORTER
@endsection
@section('content')

    <!-- Hero Banner -->
    <header class="page-hero">
        <div class="container" data-aos="zoom-out" data-aos-duration="1200">
            <h1 class="hero-title-en">{{ strtoupper($category->name) }}</h1>
            <div class="hero-divider"></div>
            <p class="hero-desc">{{ $category->description ?? 'Explore our ' . $category->name . ' collection.' }}</p>
        </div>
    </header>

    <!-- Category Filters -->
    <section class="filter-tabs-section">
        <div class="container">
            <div class="row g-3 justify-content-center">
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="0">
                    <a href="{{ route('front.category') }}" class="filter-tab-card">
                        <svg viewBox="0 0 24 24">
                            <rect x="3" y="3" width="7" height="7" rx="1"/>
                            <rect x="14" y="3" width="7" height="7" rx="1"/>
                            <rect x="3" y="14" width="7" height="7" rx="1"/>
                            <rect x="14" y="14" width="7" height="7" rx="1"/>
                        </svg>
                        <span>{{ $filterAll }}</span>
                    </a>
                </div>
                @foreach($categories as $index => $cat)
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <a href="{{ route('front.category.show', $cat->slug) }}" class="filter-tab-card {{ $cat->id == $category->id ? 'active-filter' : '' }}">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9" />
                        </svg>
                        <span>{{ strtoupper($cat->name) }}</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Toolbar -->
    <section class="container utility-controls-bar d-flex justify-content-between align-items-center">
        <div class="control-select-wrapper" data-aos="fade-up">
            <span>{{ $productsShow }}</span>
            <span class="fw-bold">{{ $products->count() }} {{ $productsWord }}</span>
        </div>
        <div class="d-flex align-items-center gap-4" data-aos="fade-up">
            <div class="view-mode-icons d-none d-sm-flex">
                <i class="fa-solid fa-border-all active" id="gridViewBtn" title="Grid View"></i>
                <i class="fa-solid fa-list" id="listViewBtn" title="List View"></i>
            </div>
        </div>
    </section>

    <!-- Products Grid -->
    <main class="container">
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
            <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
            <p class="text-muted">No products in this category yet.</p>
        </div>
        @endif
    </main>

    <!-- Trust Pillars -->
    <section class="trust-pillars-bar">
        <div class="container">
            <div class="row g-4">
                @foreach($trustFeatures as $index => $feature)
                @if(!empty($feature['title']))
                <div class="col-6 col-md-3 pillar-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="pillar-icon"><i class="{{ $feature['icon'] ?? 'fa-solid fa-check' }}"></i></div>
                    <div class="pillar-title">{{ $feature['title'] }}</div>
                    <div class="pillar-subtitle">{{ $feature['description'] ?? '' }}</div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>

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
