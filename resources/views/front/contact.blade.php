@extends('front.layouts.master')
@php
    use App\Models\dashboard\PageContent;
    use App\Models\dashboard\Setting;

    $setting = Setting::getSettings();
    $hero = PageContent::getSectionAsArray('contact', 'hero');
    $channels = PageContent::getGrouped('contact', 'channels');
    $help = PageContent::getGrouped('contact', 'help');
    $helpTitle = PageContent::getValue('contact', 'titles', 'help_title', 'How can we help you?');
    $form = PageContent::getSectionAsArray('contact', 'form');
    $features = PageContent::getGrouped('contact', 'features');
@endphp
@section('title')
{{ $hero['title'] ?? 'Contact Us' }} - {{ $setting->site_name ?? 'L.D Importer' }}
@endsection
@section('content')

    <!-- HERO SECTION -->
    <header class="contact-hero"
        @if(!empty($hero['image']))
        style="background-image: url('{{ asset('assets/uploads/page-contents/' . $hero['image']) }}'); background-size: cover; background-position: center;"
        @endif
    >
        <div class="container animate__animated animate__fadeIn">
            <h1>{{ $hero['title'] ?? 'Contact Us' }}</h1>
            <p>{{ $hero['description'] ?? '' }}</p>
        </div>
    </header>

    <!-- MAIN CHANNELS SECTION -->
    <section class="container channels-section">
        <div class="row g-3 justify-content-center">
            @foreach($channels as $ch)
            @if(!empty($ch['title']))
            <div class="col-lg-3 col-md-6 animate__animated animate__fadeInUp animate__delay-{{ $loop->iteration }}s">
                <div class="channel-card">
                    <div class="channel-icon-wrapper"><i class="{{ $ch['icon'] ?? 'fa-solid fa-phone' }}"></i></div>
                    <h4>{{ $ch['title'] }}</h4>
                    <p dir="ltr">{{ $ch['value'] ?? '' }}</p>
                    <span class="sub-text">{{ $ch['subtitle'] ?? '' }}</span>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </section>

    <!-- HELP DIRECTORY SECTION -->
    @if(!empty($help[1]['title']))
    <section class="container help-section">
        <h2 class="section-title-center">{{ $helpTitle }}</h2>
        <div class="row g-4 mt-2">
            @foreach($help as $key => $item)
            @if(is_numeric($key) && !empty($item['title']))
            <div class="col-md-4">
                <div class="help-card">
                    <div class="help-card-content">
                        <i class="{{ $item['icon'] ?? 'fa-solid fa-help-circle' }}"></i>
                        <h4>{{ $item['title'] }}</h4>
                        <p>{{ $item['description'] ?? '' }}</p>
                    </div>
                    @if(!empty($item['link']))
                    <a href="{{ $item['link'] }}" class="help-arrow-btn"><i class="fa-solid fa-chevron-left"></i></a>
                    @endif
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </section>
    @endif

    <!-- FORM & SPLIT LAYOUT -->
    <section class="container form-split-section">
        <div class="row g-4 align-items-stretch">
            <div class="col-lg-6">
                <div class="form-container-box">
                    <h3>{{ $form['title'] ?? 'Send us a message' }}</h3>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul style="margin:0;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('front.contact.submit') }}" method="POST" id="contactForm">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label d-none">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="{{ $form['name_placeholder'] ?? 'Full Name' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label d-none">Phone</label>
                                <input type="tel" name="phone" class="form-control" placeholder="{{ $form['phone_placeholder'] ?? 'Phone Number' }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label d-none">Country</label>
                                <input type="text" name="country" class="form-control" placeholder="{{ $form['city_placeholder'] ?? 'Country' }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label d-none">Message</label>
                                <textarea name="message" class="form-control" rows="5" placeholder="{{ $form['message_placeholder'] ?? 'Your message' }}" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-submit-form">
                                    <i class="fa-regular fa-paper-plane me-2"></i> {{ $form['submit_text'] ?? 'Send Message' }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <p class="form-privacy-notice">{{ $form['privacy'] ?? '' }}</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="side-promo-graphic">
                    <div class="side-promo-content">
                        <h2>{{ $form['side_title'] ?? 'We respond to all inquiries as soon as possible.' }}</h2>
                        <div class="team-availability">
                            <i class="fa-solid fa-headset"></i>
                            <p>{{ $form['side_description'] ?? 'Our team is ready to help you and provide the best solutions.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES BAR -->
    @if(!empty($features[1]['title']))
    <div class="features-bar">
        <div class="container">
            <div class="row g-3 text-center text-md-start">
                @foreach($features as $item)
                @if(!empty($item['title']))
                <div class="col-md-3 col-6">
                    <div class="feature-item-box justify-content-md-start justify-content-center">
                        <i class="{{ $item['icon'] ?? 'fa-solid fa-check' }}"></i>
                        <div class="feature-item-text">
                            <h5>{{ $item['title'] }}</h5>
                            <p>{{ $item['description'] ?? '' }}</p>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif
@endsection
