@extends('dashboard.layouts.app')
@section('title', 'إدارة محتوى صفحة المنتجات')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                <h3 class="mb-0 content-header-title d-inline-block"> محتوى صفحة المنتجات </h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.page-contents.index') }}">محتوى الصفحات</a></li>
                            <li class="breadcrumb-item active"> صفحة المنتجات </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <form method="POST" action="{{ route('dashboard.page-contents.category-page.update') }}" enctype="multipart/form-data">
                @csrf

                {{-- Hero Section --}}
                <div class="card">
                    <div class="card-header"><h4 class="card-title"><i class="la la-image"></i> البانر الرئيسي</h4></div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>العنوان الرئيسي</label>
                                        <input type="text" class="form-control" name="hero_title" value="{{ $sections['hero']['title'] ?? '' }}" placeholder="ALL PRODUCTS">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>الوصف</label>
                                        <input type="text" class="form-control" name="hero_description" value="{{ $sections['hero']['description'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>نص الفلتر "ALL"</label>
                                        <input type="text" class="form-control" name="filter_all_text" value="{{ $sections['filter']['all_text'] ?? '' }}" placeholder="ALL">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>كلمة "SHOW" (أعلى قائمة المنتجات)</label>
                                        <input type="text" class="form-control" name="products_show_text" value="{{ $sections['products']['show_text'] ?? '' }}" placeholder="SHOW">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>كلمة "PRODUCTS" (أعلى قائمة المنتجات)</label>
                                        <input type="text" class="form-control" name="products_word_text" value="{{ $sections['products']['word_text'] ?? '' }}" placeholder="PRODUCTS">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Features / Trust Pillars --}}
                <div class="card">
                    <div class="card-header"><h4 class="card-title"><i class="la la-star"></i> المميزات في أسفل الصفحة</h4></div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @foreach([1, 2, 3, 4] as $i)
                            <div class="row mb-3">
                                <div class="col-md-1"><strong>{{ $i }}</strong></div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>الأيقونة</label>
                                        <input type="text" class="form-control" name="features_{{ $i }}_icon" placeholder="fa-solid fa-truck-fast" value="{{ $sections['features'][$i]['icon'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>العنوان</label>
                                        <input type="text" class="form-control" name="features_{{ $i }}_title" value="{{ $sections['features'][$i]['title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>الوصف</label>
                                        <input type="text" class="form-control" name="features_{{ $i }}_description" value="{{ $sections['features'][$i]['description'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
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
