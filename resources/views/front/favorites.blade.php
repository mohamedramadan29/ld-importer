@extends('front.layouts.master')
@php
    use App\Models\dashboard\PageContent;
    $favHero = PageContent::getSectionAsArray('favorites', 'hero');
    $favEmpty = PageContent::getSectionAsArray('favorites', 'empty');
@endphp
@section('title')
{{ $favHero['title'] ?? 'My Favorites' }} - L.D IMPORTER
@endsection
@section('content')

    <!-- Hero Banner -->
    <header class="page-hero" style="min-height: 40vh; height: auto; padding: 180px 0 80px 0;">
        <div class="container" data-aos="zoom-out" data-aos-duration="1200">
            <h1 class="hero-title-en">{{ $favHero['title'] ?? 'MY FAVORITES' }}</h1>
            <div class="hero-divider"></div>
            <p class="hero-desc">{{ $favHero['description'] ?? $products->count() . ' ' . Str::plural('item', $products->count()) . ' in your favorites' }}</p>
        </div>
    </header>

    <!-- Favorites Grid -->
    <main class="container mt-4 mb-5">
        @if($products->count() > 0)
        <div class="row g-3 g-md-4">
            @foreach($products as $product)
            <div class="col-6 col-md-3 product-catalog-item" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                <a href="{{ route('front.product', $product->slug) }}" class="text-decoration-none">
                    <div class="catalog-img-box">
                        <img src="{{ $product->mainImage ? asset('assets/uploads/products/' . $product->mainImage->image) : 'https://via.placeholder.com/600x400' }}"
                            alt="{{ $product->name }}">
                        <button type="button" class="favorite-btn active"
                            data-id="{{ $product->id }}" onclick="event.preventDefault(); event.stopPropagation(); toggleFavorite(this);">
                            <i class="fas fa-heart"></i>
                        </button>
                        @if($product->has_discount)
                        <span class="badge badge-danger position-absolute" style="top:10px;left:10px;background-color:var(--premium-red);">Sale</span>
                        @endif
                        <button class="quick-add-overlay-btn">VIEW DETAILS +</button>
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
        <div class="favorites-empty">
            <i class="fa-regular fa-heart"></i>
            <h3>{{ $favEmpty['title'] ?? 'Your favorites list is empty' }}</h3>
            <p>{{ $favEmpty['description'] ?? 'Browse our collection and tap the heart icon to save items you love.' }}</p>
            <a href="{{ route('front.category') }}" class="btn btn-dark mt-3">{{ $favEmpty['button_text'] ?? 'Browse All Products' }}</a>
        </div>
        @endif
    </main>

@endsection
