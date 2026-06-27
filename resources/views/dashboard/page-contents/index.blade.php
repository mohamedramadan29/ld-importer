@extends('dashboard.layouts.app')
@section('title', 'محتوى الصفحات')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                <h3 class="mb-0 content-header-title d-inline-block"> محتوى الصفحات </h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item active"> محتوى الصفحات</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('dashboard.page-contents.home') }}" class="text-decoration-none">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <i class="la la-home font-large-2 text-primary mb-2"></i>
                                    <h4>الصفحة الرئيسية</h4>
                                    <p class="text-muted">البانر والمميزات والأقسام</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('dashboard.page-contents.about') }}" class="text-decoration-none">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <i class="la la-info-circle font-large-2 text-success mb-2"></i>
                                    <h4>من نحن</h4>
                                    <p class="text-muted">معلومات الشركة والخدمات</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('dashboard.page-contents.contact') }}" class="text-decoration-none">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <i class="la la-phone font-large-2 text-warning mb-2"></i>
                                    <h4>تواصل معنا</h4>
                                    <p class="text-muted">قناة الاتصال والنماذج</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('dashboard.page-contents.product') }}" class="text-decoration-none">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <i class="la la-shopping-cart font-large-2 text-danger mb-2"></i>
                                    <h4>تفاصيل المنتج</h4>
                                    <p class="text-muted">صفحة عرض المنتج</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('dashboard.page-contents.search') }}" class="text-decoration-none">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <i class="la la-search font-large-2 text-info mb-2"></i>
                                    <h4>صفحة البحث</h4>
                                    <p class="text-muted">البانر ورسالة عدم وجود نتائج</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('dashboard.page-contents.favorites') }}" class="text-decoration-none">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <i class="la la-heart font-large-2 text-pink mb-2"></i>
                                    <h4>صفحة المفضلة</h4>
                                    <p class="text-muted">البانر ورسالة عدم وجود منتجات</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .pull-up {
        transition: all 0.3s ease;
    }
    .pull-up:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush
