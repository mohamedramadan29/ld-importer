@extends('front.layouts.master')
@php
    use App\Models\dashboard\PageContent;

    $hero = PageContent::getSectionAsArray('home', 'hero');
    $features = PageContent::getGrouped('home', 'features');
    $categories = PageContent::getGrouped('home', 'categories');
    $categoriesMeta = PageContent::getSectionAsArray('home', 'categories_meta');
    $philosophy = PageContent::getSectionAsArray('home', 'philosophy');
    $showroom = PageContent::getSectionAsArray('home', 'showroom');
    $showroomImages = PageContent::getGrouped('home', 'showroom_images');
    $featuredProducts = \App\Models\dashboard\Product::with('mainImage')->where('status', 1)->take(8)->get();
    $featured = PageContent::getSectionAsArray('home', 'featured');
@endphp
@section('title')
{{ $hero['title'] ?? 'L.D IMPORTER' }} - Premium Luxury Furniture
@endsection
@section('content')


    <!-- Master Hero Framework Section -->
    <section class="hero-section"
        @if(!empty($hero['image']))
        style="background-image: url('{{ asset('assets/uploads/page-contents/' . $hero['image']) }}'); background-size: cover; background-position: center;"
        @endif
    >
        <div class="hero-overlay-box" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="hero-logo-text">{{ $hero['title'] ?? 'L.D' }}</h1>
            <div class="hero-brand-sub">{{ $hero['subtitle'] ?? 'IMPORTER' }}</div>
            <p class="hero-title-desc">{{ $hero['description'] ?? 'Modern Living Collections' }}</p>
            @if(!empty($hero['button_text']))
            <a href="{{ $hero['button_link'] ?? '#' }}" class="btn-explore">{{ $hero['button_text'] }}</a>
            @endif
        </div>
        <div class="hero-indicator">01</div>
    </section>

    <!-- Structural Feature Bar Module -->
    <section class="features-bar">
        <div class="container">
            <div class="row g-4 text-center">
                @foreach($features as $index => $feature)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="{{ $feature['icon'] ?? 'fa-solid fa-star' }}"></i></div>
                        <div class="text-start">
                            <div class="feature-title-en">{{ $feature['title'] ?? '' }}</div>
                            <div class="feature-subtitle">{{ $feature['description'] ?? '' }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Category Architecture Grid -->
    <section class="container shadow-stabilized">
        <div class="section-header d-flex justify-content-between align-items-end" data-aos="fade-up">
            <div>
                <h2 class="section-title-en">{{ $categoriesMeta['title'] ?? 'Collections' }}</h2>
            </div>
            @if(!empty($categoriesMeta['view_all']))
            <a href="#" class="section-view-all">{{ $categoriesMeta['view_all'] }} &nbsp;<i class="fa-solid fa-arrow-right-long"></i></a>
            @endif
        </div>

        <div class="row g-3">
            @foreach($categories as $index => $cat)
            @if($index >= 1 && $index <= 3)
            <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <a href="{{ $cat['link'] ?? route('front.category') }}" class="text-decoration-none">
                    <div class="col-card">
                        <img src="{{ !empty($cat['image']) ? asset('assets/uploads/page-contents/' . $cat['image']) : 'https://via.placeholder.com/600x400' }}"
                            alt="{{ $cat['title'] ?? '' }}">
                        <div class="col-card-overlay">
                            <div>
                                <div class="col-card-title-en">{{ $cat['title'] ?? '' }}</div>
                            </div>
                            <div><i class="fa-solid fa-arrow-right-long"></i></div>
                        </div>
                    </div>
                </a>
            </div>
            @endif
            @endforeach
        </div>
    </section>

    <!-- Identity Statement Split Block -->
    <section class="philosophy-row" data-aos="fade-up">
        <div class="philosophy-text-panel" data-aos="fade-up" data-aos-delay="200">
            <h3>{!! nl2br($philosophy['title'] ?? "OUR\nPHILOSOPHY") !!}</h3>
            <p>{{ $philosophy['description'] ?? '' }}</p>
            @if(!empty($philosophy['link_text']))
            <a href="#" class="text-white text-decoration-none uppercase"
                style="font-size: 12px; letter-spacing: 2px;">{{ $philosophy['link_text'] }} &nbsp; →</a>
            @endif
        </div>
        <div class="philosophy-image-panel" data-aos="fade-up" data-aos-delay="200"
            @if(!empty($philosophy['image']))
            style="background-image: url('{{ asset('assets/uploads/page-contents/' . $philosophy['image']) }}')"
            @endif
        ></div>
    </section>

    <!-- Featured Products -->
    <section class="container mb-5 position-relative overflow-hidden">
        <div class="section-header d-flex justify-content-between align-items-end" data-aos="fade-up">
            <div>
                <h2 class="section-title-en">{{ $featured['title'] ?? 'Featured Products' }}</h2>
            </div>
            @if(!empty($featured['view_all']))
            <a href="{{ route('front.category') }}" class="section-view-all">{{ $featured['view_all'] }} &nbsp;<i class="fa-solid fa-arrow-right-long"></i></a>
            @endif
        </div>

        <div class="featured-slider-wrapper">
            <div class="featured-slider-track" id="featuredTrack">
                @foreach($featuredProducts as $product)
                <div class="featured-slide">
                    <a href="{{ route('front.product', $product->slug) }}" class="text-decoration-none">
                        <div class="p-img-box">
                            <img src="{{ $product->mainImage ? asset('assets/uploads/products/' . $product->mainImage->image) : 'https://via.placeholder.com/600x400' }}"
                                alt="{{ $product->name }}">
                            <button type="button" class="favorite-btn {{ in_array($product->id, session()->get('favorites', [])) ? 'active' : '' }}"
                                data-id="{{ $product->id }}" onclick="event.preventDefault(); event.stopPropagation(); toggleFavorite(this);">
                                <i class="fa{{ in_array($product->id, session()->get('favorites', [])) ? 's' : 'r' }} fa-heart"></i>
                            </button>
                            @if($product->has_discount)
                            <span class="badge badge-danger position-absolute" style="top:10px;left:10px;">Sale</span>
                            @endif
                        </div>
                        <div class="p-meta-info">
                            <div class="p-title">{{ $product->name }}</div>
                            <div class="p-price">
                                @if($product->has_discount)
                                <span style="text-decoration:line-through;color:#999;font-size:12px;">{{ number_format($product->price, 0) }} ILS</span>
                                <span class="text-danger ms-1">{{ number_format($product->discount_price, 0) }} ILS</span>
                                @else
                                ILS {{ number_format($product->price, 0) }}
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @if($featuredProducts->count() > 4)
            <button class="featured-slider-btn featured-slider-prev" type="button" onclick="scrollFeatured(-1)">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button class="featured-slider-btn featured-slider-next" type="button" onclick="scrollFeatured(1)">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
            @endif
        </div>

        @if($featuredProducts->isEmpty())
            <div class="col-12 text-center text-muted py-5">
                <i class="fa-solid fa-box-open fa-3x mb-3"></i>
                <p>No products available</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Location Invitation Hub -->
    <section class="showrooms-bar" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-4 showroom-desc-side" data-aos="fade-up" data-aos-delay="100">
                    <h4>{{ $showroom['title'] ?? 'VISIT OUR SHOWROOMS' }}</h4>
                    <p>{{ $showroom['description'] ?? '' }}</p>
                    @if(!empty($showroom['button_text']))
                    <a href="{{ $showroom['button_link'] ?? '#' }}" class="btn-explore py-2 px-3">
                        <i class="fa-solid fa-location-dot small"></i> {{ $showroom['button_text'] }}
                    </a>
                    @endif
                </div>
                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="row g-2">
                        @foreach($showroomImages as $img)
                        <div class="col-3">
                            <img src="{{ !empty($img['image']) ? asset('assets/uploads/page-contents/' . $img['image']) : 'https://via.placeholder.com/300x200' }}"
                                class="showroom-gallery-img" alt="Gallery">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
<script>
    let featuredCurrentIndex = 0;
    const featuredTrack = document.getElementById('featuredTrack');
    const featuredSlides = featuredTrack ? featuredTrack.querySelectorAll('.featured-slide') : [];
    const isRTL = document.documentElement.dir === 'rtl';

    function scrollFeatured(direction) {
        const slidesToShow = window.innerWidth > 768 ? 4 : 2;
        const maxIndex = featuredSlides.length - slidesToShow;

        featuredCurrentIndex += direction;
        if (featuredCurrentIndex < 0) featuredCurrentIndex = maxIndex;
        if (featuredCurrentIndex > maxIndex) featuredCurrentIndex = 0;

        const slideWidth = featuredTrack.parentElement.offsetWidth / slidesToShow;
        const offset = featuredCurrentIndex * slideWidth;
        featuredTrack.style.transform = isRTL ? `translateX(${offset}px)` : `translateX(-${offset}px)`;
    }

    // Auto scroll
    setInterval(function() {
        scrollFeatured(1);
    }, 3000);
</script>
@endsection
