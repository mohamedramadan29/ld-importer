@extends('front.layouts.master')
@php
    use App\Models\dashboard\PageContent;
    use App\Models\dashboard\Setting;

    $setting = Setting::getSettings();
    $pageSettings = PageContent::getSectionAsArray('product', 'whatsapp');
    $showroomSettings = PageContent::getSectionAsArray('product', 'showroom');
    $labels = PageContent::getSectionAsArray('product', 'labels');
@endphp
@section('title')
{{ $product->name }} - {{ $setting->site_name ?? 'L.D Importer' }}
@endsection
@section('content')
    <div class="product_page">
        <div class="container breadcrumb-section animate__animated animate__fadeIn">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('front.index') }}">Home</a> /
                    <a href="{{ route('front.category.show', $product->category->slug ?? '') }}">{{ $product->category->name ?? '' }}</a> /
                    <span class="active">{{ $product->name }}</span>
                </div>
            </div>
        </div>

        <section class="container mt-2">
            <div class="row g-4 g-lg-5">
                <div class="col-lg-7 animate__animated animate__fadeInLeft">
                    @if($product->images->count() > 0)
                    <div id="productCarousel" class="carousel slide carousel-custom" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach($product->images as $index => $img)
                            <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="{{ $index }}"
                                class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach($product->images as $index => $img)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('assets/uploads/products/' . $img->image) }}" alt="{{ $product->name }}">
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                    @else
                    <div class="text-center p-5 bg-light rounded">
                        <i class="fa-solid fa-image fa-3x text-muted mb-3"></i>
                        <p class="text-muted">لا توجد صور للمنتج</p>
                    </div>
                    @endif
                </div>

                <div class="col-lg-5 d-flex flex-column justify-content-center animate__animated animate__fadeInRight">
                    <h1 class="product-title">{{ $product->name }}</h1>
                    <div class="product-price">
                        @if($product->has_discount)
                            <span style="text-decoration:line-through;color:#999;font-size:18px;">₪{{ number_format($product->price, 0) }}</span>
                            <span class="text-danger ms-2">₪{{ number_format($product->discount_price, 0) }}</span>
                        @else
                            ₪{{ number_format($product->price, 0) }}
                        @endif
                    </div>
                    <div class="stock-status">
                        @if($product->availability)
                        <i class="fa-solid fa-circle-check animate__animated animate__pulse animate__infinite"></i>
                        {{ $labels['available'] ?? 'Currently Available' }}
                        @else
                        <i class="fa-solid fa-circle-xmark text-danger"></i>
                        <span class="text-danger">{{ $labels['out_of_stock'] ?? 'Out of Stock' }}</span>
                        @endif
                    </div>
                    <p class="product-description">{{ $product->description ?? '' }}</p>

                    <div class="d-grid gap-2">
                        <a href="https://wa.me/{{ $pageSettings['number'] ?? $setting->whatsapp ?? '' }}" class="btn-whatsapp-inquiry" target="_blank">
                            <i class="fa-brands fa-whatsapp"></i> {{ $pageSettings['text'] ?? 'Inquiry via WhatsApp' }}
                        </a>
                        @if(!empty($showroomSettings['button_text']))
                        <a href="#" class="btn-locator-outline">
                            <i class="fa-solid fa-location-dot"></i> {{ $showroomSettings['button_text'] }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        @if($product->dimensions || $product->materials || $product->color)
        <section class="container">
            <div class="specs-section animate__animated animate__fadeInUp">
                <div class="spec-grid-layout row g-0">
                    @if($product->dimensions)
                    <div class="col-md spec-box">
                        <i class="fa-solid fa-ruler-combined"></i>
                        <h5>{{ $labels['spec_dimensions'] ?? 'Dimensions' }}</h5>
                        <p>{{ $product->dimensions }}</p>
                    </div>
                    @endif
                    @if($product->materials)
                    <div class="col-md spec-box">
                        <i class="fa-solid fa-layer-group"></i>
                        <h5>{{ $labels['spec_materials'] ?? 'Materials' }}</h5>
                        <p>{{ $product->materials }}</p>
                    </div>
                    @endif
                    @if($product->color)
                    <div class="col-md spec-box">
                        <i class="fa-solid fa-palette"></i>
                        <h5>{{ $labels['spec_color'] ?? 'Color' }}</h5>
                        <p>{{ $product->color }}</p>
                    </div>
                    @endif
                    <div class="col-md spec-box">
                        <i class="fa-solid fa-shop"></i>
                        <h5>{{ $labels['spec_availability'] ?? 'Availability' }}</h5>
                        <p>{{ $product->availability ? ($labels['available'] ?? 'In Stock') : ($labels['out_of_stock'] ?? 'Out of Stock') }}</p>
                    </div>
                    @if($product->delivery_info)
                    <div class="col-md spec-box">
                        <i class="fa-solid fa-truck"></i>
                        <h5>{{ $labels['spec_delivery'] ?? 'Delivery' }}</h5>
                        <p>{{ $product->delivery_info }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </section>
        @endif

        @if($product->images->count() > 1)
        <section class="container">
            <h4 class="sub-section-title">{{ $labels['additional_images'] ?? 'Additional Images' }}</h4>
            <div class="row g-2 g-md-3">
                @foreach($product->images as $index => $img)
                <div class="col-md-3 col-6" onclick="changeSlide({{ $index }})">
                    <div class="additional-img-card">
                        <img src="{{ asset('assets/uploads/products/' . $img->image) }}" alt="{{ $product->name }}">
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        @if($relatedProducts->count() > 0)
        <section class="container mb-4">
            <h4 class="sub-section-title">{{ $labels['related_title'] ?? 'You May Also Like' }}</h4>
            <div class="row g-3 g-md-4">
                @foreach($relatedProducts as $related)
                <div class="col-md-3 col-6">
                    <a href="{{ route('front.product', $related->slug) }}" class="related-product-card">
                        <img src="{{ $related->mainImage ? asset('assets/uploads/products/' . $related->mainImage->image) : 'https://via.placeholder.com/500' }}" alt="{{ $related->name }}">
                        <div class="related-card-body">
                            <h4>{{ $related->name }}</h4>
                            <div class="related-info">
                                <div class="type">{{ $related->category->name ?? '' }}</div>
                                <div class="price">
                                    @if($related->has_discount)
                                    ₪{{ number_format($related->discount_price, 0) }}
                                    @else
                                    ₪{{ number_format($related->price, 0) }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        @if(!empty($showroomSettings['title']))
        <div class="container">
            <div class="bottom-showroom-banner">
                <div class="bottom-banner-text">
                    <h4>{{ $showroomSettings['title'] ?? '' }}</h4>
                    <p>{{ $showroomSettings['description'] ?? '' }}</p>
                </div>
                <a href="#" class="btn-dark-action">
                    {{ $showroomSettings['button_text'] ?? 'View Nearby Showrooms' }} <i class="fa-solid fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        @endif
    </div>
@endsection
@section('js')
    <script>
        function changeSlide(index) {
            const carouselElement = document.getElementById('productCarousel');
            const carouselInstance = bootstrap.Carousel.getOrCreateInstance(carouselElement);
            carouselInstance.to(index);
            carouselElement.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const carouselElement = document.getElementById('productCarousel');
            let touchStartX = 0;
            let touchEndX = 0;

            carouselElement.addEventListener('touchstart', e => {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });

            carouselElement.addEventListener('touchend', e => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, { passive: true });

            function handleSwipe() {
                const carouselInstance = bootstrap.Carousel.getOrCreateInstance(carouselElement);
                if (touchStartX - touchEndX > 50) carouselInstance.next();
                if (touchEndX - touchStartX > 50) carouselInstance.prev();
            }
        });
    </script>
@endsection
