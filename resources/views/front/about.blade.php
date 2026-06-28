@extends('front.layouts.master')
@php
    use App\Models\dashboard\PageContent;
    use App\Models\dashboard\Setting;

    $setting = Setting::getSettings();
    $hero = PageContent::getSectionAsArray('about', 'hero');
    $brief = PageContent::getSectionAsArray('about', 'brief');
    $services = PageContent::getGrouped('about', 'services');
    $servicesTitle = PageContent::getValue('about', 'titles', 'services_title', 'What Do We Offer?');
    $whyUs = PageContent::getGrouped('about', 'why_us');
    $whyUsTitle = PageContent::getValue('about', 'titles', 'why_us_title', 'Why Our Clients Choose Us?');
    $map = PageContent::getSectionAsArray('about', 'map');
    $contactTitle = PageContent::getValue('about', 'titles', 'contact_title', 'Contact Us');
    $infoBar = PageContent::getGrouped('about', 'info_bar');
@endphp
@section('title')
{{ $hero['title'] ?? 'من نحن' }} - {{ $setting->site_name ?? 'L.D Importer' }}
@endsection
@section('content')

    <!-- HERO SECTION -->
    <header class="hero-about"
        @if(!empty($hero['image']))
        style="background-image: url('{{ asset('assets/uploads/page-contents/' . $hero['image']) }}'); background-size: cover; background-position: center;"
        @endif
    >
        <div class="container hero-content" style="padding-left: 20px; padding-right: 20px;">
            <div class="row">
                <div class="col-lg-7">
                    <h1 class="mb-4">{!! nl2br($hero['title'] ?? "We choose what\ndeserves to stay.") !!}</h1>
                    <p>{{ $hero['description'] ?? '' }}</p>
                </div>
            </div>
        </div>
        <div class="hero-info-bar">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="info-bar-item">
                            <i class="fa-solid fa-location-dot"></i>
                            <div>
                                <p>{{ $infoBar[1]['title'] ?? 'Available In' }}</p>
                                <span>{{ $setting->address ?? 'Across the Country' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-bar-item">
                            <i class="fa-brands fa-whatsapp"></i>
                            <div>
                                <p>{{ $infoBar[2]['title'] ?? 'WhatsApp' }}</p>
                                <span>{{ $setting->whatsapp ?? '0790 123 456' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-bar-item">
                            <i class="fa-solid fa-phone"></i>
                            <div>
                                <p>{{ $infoBar[3]['title'] ?? 'Call Us' }}</p>
                                <span>{{ $setting->phone1 ?? '0790 123 456' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- ABOUT BRIEF SECTION -->
    <section class="section-padding">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <h2 class="fw-bold mb-4">{{ $brief['title'] ?? 'L.D Importer' }}</h2>
                    <p class="text-muted mb-4" style="line-height: 1.8;">{{ $brief['description'] ?? '' }}</p>
                    <div class="row g-3 pt-4 border-top">
                        <div class="col-4">
                            <div class="brief-stat-box">
                                <i class="fa-regular fa-calendar"></i>
                                <h5>{{ $brief['stat1_title'] ?? 'Since' }}</h5>
                                <p>{{ $brief['stat1_value'] ?? '2020' }}</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="brief-stat-box">
                                <i class="fa-solid fa-shop"></i>
                                <h5>{{ $brief['stat2_title'] ?? 'More Than' }}</h5>
                                <p>{{ $brief['stat2_value'] ?? '100+ Stores' }}</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="brief-stat-box">
                                <i class="fa-solid fa-house"></i>
                                <h5>{{ $brief['stat3_title'] ?? 'Thousands' }}</h5>
                                <p>{{ $brief['stat3_value'] ?? 'Of Homes' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="about-brief-img">
                        <img src="{{ !empty($brief['image']) ? asset('assets/uploads/page-contents/' . $brief['image']) : 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?q=80&w=1000' }}" alt="Furniture Design">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WHAT WE OFFER SECTION -->
    <section class="section-padding" style="background-color: #fafafa;">
        <div class="container">
            <h3 class="section-title">{{ $servicesTitle }}</h3>
            <div class="row g-4">
                @foreach($services as $index => $service)
                <div class="col-md-4">
                    <div class="service-card">
                        <img src="{{ !empty($service['image']) ? asset('assets/uploads/page-contents/' . $service['image']) : 'https://via.placeholder.com/600x400' }}" alt="{{ $service['title'] ?? '' }}">
                        <div class="service-card-body">
                            <div class="service-icon"><i class="{{ $service['icon'] ?? 'fa-regular fa-star' }}"></i></div>
                            <h4>{{ $service['title'] ?? '' }}</h4>
                            <p>{{ $service['description'] ?? '' }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- WHY CHOOSE US SECTION -->
    <section class="section-padding">
        <div class="container">
            <h3 class="section-title">{{ $whyUsTitle }}</h3>
            <div class="row g-4">
                @foreach($whyUs as $index => $item)
                <div class="col-md-4">
                    <div class="why-us-card">
                        <div class="why-us-icon"><i class="{{ $item['icon'] ?? 'fa-solid fa-check' }}"></i></div>
                        <h4>{{ $item['title'] ?? '' }}</h4>
                        <p>{{ $item['description'] ?? '' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- MAP SECTION -->
    @if(!empty($map['embed']))
    <section class="section-padding pt-0">
        <div class="container">
            <div class="map-section-box">
                <div class="row g-0">
                    <div class="col-lg-4">
                        <div class="map-info-pane">
                            <h3>{!! nl2br($map['title'] ?? '') !!}</h3>
                            <p>{{ $map['description'] ?? '' }}</p>
                            <a href="{{ $map['embed'] }}" class="btn-find-store" target="_blank">
                                <i class="fa-solid fa-location-crosshairs"></i>
                                {{ $map['button_text'] ?? 'Find Us on Map' }}
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="map-iframe-container">
                            @if(strpos($map['embed'], '/embed') !== false)
                                <iframe src="{{ $map['embed'] }}" loading="lazy"></iframe>
                            @else
                                <iframe src="https://maps.google.com/maps?q={{ urlencode($map['embed']) }}&t=&z=15&ie=UTF8&iwloc=&output=embed" loading="lazy"></iframe>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- CONTACT GRID SECTION -->
    <section class="section-padding pt-0">
        <div class="container">
            <h3 class="section-title" style="margin-bottom: 30px;">{{ $contactTitle }}</h3>
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="contact-grid-card">
                        <i class="fa-regular fa-clock"></i>
                        <h5>Working Hours</h5>
                        <p>{{ $setting->working_hours ?? 'Sat - Thu | 9:00 AM - 6:00 PM' }}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="contact-grid-card">
                        <i class="fa-regular fa-envelope"></i>
                        <h5>Email Address</h5>
                        <p>{{ $setting->email ?? 'info@ldimporter.com' }}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="contact-grid-card">
                        <i class="fa-brands fa-whatsapp"></i>
                        <h5>WhatsApp</h5>
                        <p>{{ $setting->whatsapp ?? '0790 123 456' }}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="contact-grid-card">
                        <i class="fa-solid fa-phone"></i>
                        <h5>Phone Number</h5>
                        <p>{{ $setting->phone1 ?? '0790 123 456' }}</p>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="contact-grid-card py-3">
                        <span class="text-muted">
                            <i class="fa-solid fa-location-dot" style="margin-right: 8px; font-size:1rem;"></i>
                            {{ $setting->address ?? '' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
