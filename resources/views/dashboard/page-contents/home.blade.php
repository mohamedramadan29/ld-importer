@extends('dashboard.layouts.app')
@section('title', 'محتوى الصفحة الرئيسية')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                <h3 class="mb-0 content-header-title d-inline-block"> محتوى الصفحة الرئيسية </h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item active"> محتوى الصفحة الرئيسية</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <form method="POST" action="{{ route('dashboard.page-contents.home.update') }}" enctype="multipart/form-data">
                @csrf

                {{-- ========== Hero Section ========== --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="la la-image"></i> قسم البانر الرئيسي (Hero)</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>الصورة الخلفية</label>
                                        <input type="file" class="form-control" name="hero_image" accept="image/*">
                                        @if(!empty($sections['hero']['image']))
                                        <div class="mt-1">
                                            <img src="{{ asset('assets/uploads/page-contents/' . $sections['hero']['image']) }}"
                                                style="width:60px;height:40px;object-fit:cover;border-radius:4px;">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>النص الرئيسي (L.D)</label>
                                        <input type="text" class="form-control" name="hero_title"
                                            value="{{ $sections['hero']['title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>النص الفرعي (IMPORTER)</label>
                                        <input type="text" class="form-control" name="hero_subtitle"
                                            value="{{ $sections['hero']['subtitle'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>الوصف</label>
                                        <input type="text" class="form-control" name="hero_description"
                                            value="{{ $sections['hero']['description'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>نص الزر</label>
                                        <input type="text" class="form-control" name="hero_button_text"
                                            value="{{ $sections['hero']['button_text'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>رابط الزر</label>
                                        <input type="text" class="form-control" name="hero_button_link"
                                            value="{{ $sections['hero']['button_link'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ========== Features Section ========== --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="la la-star"></i> قسم المميزات (Features)</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @foreach([1, 2, 3] as $i)
                            <div class="row mb-3">
                                <div class="col-md-1"><strong>الميزة {{ $i }}</strong></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>الأيقونة (Font Awesome)</label>
                                        <input type="text" class="form-control" name="features_{{ $i }}_icon"
                                            placeholder="مثال: fa-solid fa-couch"
                                            value="{{ $sections['features'][$i]['icon'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>العنوان</label>
                                        <input type="text" class="form-control" name="features_{{ $i }}_title"
                                            value="{{ $sections['features'][$i]['title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>الوصف</label>
                                        <input type="text" class="form-control" name="features_{{ $i }}_description"
                                            value="{{ $sections['features'][$i]['description'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- ========== Categories Section ========== --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="la la-th-large"></i> قسم الأقسام (Categories)</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>عنوان القسم</label>
                                        <input type="text" class="form-control" name="categories_meta_title"
                                            value="{{ $sections['categories_meta']['title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>نص رابط "عرض الكل"</label>
                                        <input type="text" class="form-control" name="categories_meta_view_all"
                                            value="{{ $sections['categories_meta']['view_all'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            @foreach([1, 2, 3] as $i)
                            <div class="row mb-3">
                                <div class="col-md-1"><strong>القسم {{ $i }}</strong></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>الاسم</label>
                                        <input type="text" class="form-control" name="categories_{{ $i }}_title"
                                            value="{{ $sections['categories'][$i]['title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>الصورة</label>
                                        <input type="file" class="form-control" name="categories_{{ $i }}_image" accept="image/*">
                                        @if(!empty($sections['categories'][$i]['image']))
                                        <div class="mt-1">
                                            <img src="{{ asset('assets/uploads/page-contents/' . $sections['categories'][$i]['image']) }}"
                                                style="width:60px;height:40px;object-fit:cover;border-radius:4px;">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>رابط القسم</label>
                                        <input type="text" class="form-control" name="categories_{{ $i }}_link"
                                            value="{{ $sections['categories'][$i]['link'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- ========== Philosophy Section ========== --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="la la-lightbulb-o"></i> قسم الفلسفة (Philosophy)</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>العنوان</label>
                                        <input type="text" class="form-control" name="philosophy_title"
                                            value="{{ $sections['philosophy']['title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>الوصف</label>
                                        <textarea class="form-control" name="philosophy_description" rows="2">{{ $sections['philosophy']['description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>نص الرابط</label>
                                        <input type="text" class="form-control" name="philosophy_link_text"
                                            value="{{ $sections['philosophy']['link_text'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>الصورة</label>
                                        <input type="file" class="form-control" name="philosophy_image" accept="image/*">
                                        @if(!empty($sections['philosophy']['image']))
                                        <div class="mt-1">
                                            <img src="{{ asset('assets/uploads/page-contents/' . $sections['philosophy']['image']) }}"
                                                style="width:60px;height:40px;object-fit:cover;border-radius:4px;">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ========== Featured Products Section ========== --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="la la-star"></i> قسم المنتجات المميزة (Featured Products)</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>عنوان القسم</label>
                                        <input type="text" class="form-control" name="featured_title"
                                            value="{{ $sections['featured']['title'] ?? '' }}"
                                            placeholder="مثال: Featured Products">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>نص رابط "عرض الكل"</label>
                                        <input type="text" class="form-control" name="featured_view_all"
                                            value="{{ $sections['featured']['view_all'] ?? '' }}"
                                            placeholder="مثال: View All">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-muted"><i class="la la-info-circle"></i> المنتجات تظهر تلقائياً من قاعدة البيانات (أحدث 8 منتجات فعالة)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ========== Showroom Section ========== --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="la la-map-marker"></i> قسم المعرض (Showroom)</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>العنوان</label>
                                        <input type="text" class="form-control" name="showroom_title"
                                            value="{{ $sections['showroom']['title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>الوصف</label>
                                        <textarea class="form-control" name="showroom_description" rows="2">{{ $sections['showroom']['description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>نص الزر</label>
                                        <input type="text" class="form-control" name="showroom_button_text"
                                            value="{{ $sections['showroom']['button_text'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>رابط الزر</label>
                                        <input type="text" class="form-control" name="showroom_button_link"
                                            value="{{ $sections['showroom']['button_link'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12"><strong>صور المعرض</strong></div>
                                @foreach([1, 2, 3, 4] as $i)
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>صورة {{ $i }}</label>
                                        <input type="file" class="form-control" name="showroom_images_{{ $i }}_image" accept="image/*">
                                        @if(!empty($sections['showroom_images'][$i]['image']))
                                        <div class="mt-1">
                                            <img src="{{ asset('assets/uploads/page-contents/' . $sections['showroom_images'][$i]['image']) }}"
                                                style="width:60px;height:40px;object-fit:cover;border-radius:4px;">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions mb-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="la la-save"></i> حفظ جميع التغييرات
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
