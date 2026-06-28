@extends('dashboard.layouts.app')
@section('title', 'إدارة عناوين النافبار')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                <h3 class="mb-0 content-header-title d-inline-block"> عناوين النافبار </h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.page-contents.index') }}">محتوى الصفحات</a></li>
                            <li class="breadcrumb-item active"> النافبار </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <form method="POST" action="{{ route('dashboard.page-contents.navbar.update') }}" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-header"><h4 class="card-title"><i class="la la-bars"></i> عناوين الروابط الرئيسية</h4></div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>الرئيسية (Home)</label>
                                        <input type="text" class="form-control" name="titles_home" value="{{ $sections['titles']['home'] ?? '' }}" placeholder="Home">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>من نحن (About)</label>
                                        <input type="text" class="form-control" name="titles_about" value="{{ $sections['titles']['about'] ?? '' }}" placeholder="About">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>جميع المنتجات (All Products)</label>
                                        <input type="text" class="form-control" name="titles_all_products" value="{{ $sections['titles']['all_products'] ?? '' }}" placeholder="All Products">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>تواصل معنا (Contact)</label>
                                        <input type="text" class="form-control" name="titles_contact" value="{{ $sections['titles']['contact'] ?? '' }}" placeholder="Contact">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>placeholder حقل البحث</label>
                                        <input type="text" class="form-control" name="titles_search_placeholder" value="{{ $sections['titles']['search_placeholder'] ?? '' }}" placeholder="Search premium furniture, tables, mirrors...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>بحث المنتجات (Search Products)</label>
                                        <input type="text" class="form-control" name="titles_search_products" value="{{ $sections['titles']['search_products'] ?? '' }}" placeholder="Search products...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions mb-4">
                    <button type="submit" class="btn btn-primary btn-lg"><i class="la la-save"></i> حفظ التغييرات</button>
                    <a href="{{ route('dashboard.page-contents.index') }}" class="btn btn-secondary btn-lg">رجوع</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
