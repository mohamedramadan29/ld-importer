@extends('dashboard.layouts.app')
@section('title', 'إدارة محتوى صفحة من نحن')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                <h3 class="mb-0 content-header-title d-inline-block"> من نحن </h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.page-contents.index') }}">محتوى الصفحات</a></li>
                            <li class="breadcrumb-item active"> من نحن</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <form method="POST" action="{{ route('dashboard.page-contents.about.update') }}" enctype="multipart/form-data">
                @csrf

                {{-- Hero Section --}}
                <div class="card">
                    <div class="card-header"><h4 class="card-title"><i class="la la-image"></i> البانر الرئيسي</h4></div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>الصورة الخلفية للبانر</label>
                                        <input type="file" class="form-control" name="hero_image" accept="image/*">
                                        @if(!empty($sections['hero']['image']))
                                        <div class="mt-1">
                                            <img src="{{ asset('assets/uploads/page-contents/' . $sections['hero']['image']) }}"
                                                style="width:100px;height:60px;object-fit:cover;border-radius:4px;">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>العنوان الرئيسي</label>
                                        <input type="text" class="form-control" name="hero_title" value="{{ $sections['hero']['title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>الوصف</label>
                                        <textarea class="form-control" name="hero_description" rows="2">{{ $sections['hero']['description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Brief Section --}}
                <div class="card">
                    <div class="card-header"><h4 class="card-title"><i class="la la-building"></i> نبذة عن الشركة</h4></div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>العنوان</label>
                                        <input type="text" class="form-control" name="brief_title" value="{{ $sections['brief']['title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>الوصف</label>
                                        <textarea class="form-control" name="brief_description" rows="3">{{ $sections['brief']['description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>الإحصائية 1 - العنوان</label>
                                        <input type="text" class="form-control" name="brief_stat1_title" value="{{ $sections['brief']['stat1_title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>القيمة</label>
                                        <input type="text" class="form-control" name="brief_stat1_value" value="{{ $sections['brief']['stat1_value'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>الإحصائية 2 - العنوان</label>
                                        <input type="text" class="form-control" name="brief_stat2_title" value="{{ $sections['brief']['stat2_title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>القيمة</label>
                                        <input type="text" class="form-control" name="brief_stat2_value" value="{{ $sections['brief']['stat2_value'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>الإحصائية 3 - العنوان</label>
                                        <input type="text" class="form-control" name="brief_stat3_title" value="{{ $sections['brief']['stat3_title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>القيمة</label>
                                        <input type="text" class="form-control" name="brief_stat3_value" value="{{ $sections['brief']['stat3_value'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>الصورة</label>
                                        <input type="file" class="form-control" name="brief_image" accept="image/*">
                                        @if(!empty($sections['brief']['image']))
                                        <div class="mt-1"><img src="{{ asset('assets/uploads/page-contents/' . $sections['brief']['image']) }}" style="width:100px;height:60px;object-fit:cover;border-radius:4px;"></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Services Section --}}
                <div class="card">
                    <div class="card-header"><h4 class="card-title"><i class="la la-star"></i> خدماتنا</h4></div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>عنوان القسم</label>
                                        <input type="text" class="form-control" name="services_section_title" value="{{ $sections['services_title'] ?? '' }}" placeholder="What Do We Offer?">
                                    </div>
                                </div>
                            </div>
                            @foreach([1, 2, 3] as $i)
                            <div class="row mb-3">
                                <div class="col-md-1"><strong>الخدمة {{ $i }}</strong></div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>العنوان</label>
                                        <input type="text" class="form-control" name="services_{{ $i }}_title" value="{{ $sections['services'][$i]['title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>الوصف</label>
                                        <textarea class="form-control" name="services_{{ $i }}_description" rows="2">{{ $sections['services'][$i]['description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>الأيقونة</label>
                                        <input type="text" class="form-control" name="services_{{ $i }}_icon" placeholder="fa-solid fa-couch" value="{{ $sections['services'][$i]['icon'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>الصورة</label>
                                        <input type="file" class="form-control" name="services_{{ $i }}_image" accept="image/*">
                                        @if(!empty($sections['services'][$i]['image']))
                                        <div class="mt-1"><img src="{{ asset('assets/uploads/page-contents/' . $sections['services'][$i]['image']) }}" style="width:60px;height:40px;object-fit:cover;border-radius:4px;"></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Why Us Section --}}
                <div class="card">
                    <div class="card-header"><h4 class="card-title"><i class="la la-check-circle"></i> لماذا تختارنا</h4></div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>عنوان القسم</label>
                                        <input type="text" class="form-control" name="why_us_section_title" value="{{ $sections['why_us_title'] ?? '' }}" placeholder="Why Our Clients Choose Us?">
                                    </div>
                                </div>
                            </div>
                            @foreach([1, 2, 3] as $i)
                            <div class="row mb-3">
                                <div class="col-md-1"><strong>{{ $i }}</strong></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>العنوان</label>
                                        <input type="text" class="form-control" name="why_us_{{ $i }}_title" value="{{ $sections['why_us'][$i]['title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>الوصف</label>
                                        <textarea class="form-control" name="why_us_{{ $i }}_description" rows="2">{{ $sections['why_us'][$i]['description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>الأيقونة</label>
                                        <input type="text" class="form-control" name="why_us_{{ $i }}_icon" placeholder="fa-solid fa-rotate" value="{{ $sections['why_us'][$i]['icon'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Contact Us Section Title --}}
                <div class="card">
                    <div class="card-header"><h4 class="card-title"><i class="la la-phone"></i> عنوان قسم التواصل</h4></div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>عنوان القسم</label>
                                        <input type="text" class="form-control" name="contact_section_title" value="{{ $sections['contact_title'] ?? '' }}" placeholder="Contact Us">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Map Section --}}
                <div class="card">
                    <div class="card-header"><h4 class="card-title"><i class="la la-map-marker"></i> قسم الخريطة</h4></div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>العنوان</label>
                                        <input type="text" class="form-control" name="map_title" value="{{ $sections['map']['title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>الوصف</label>
                                        <textarea class="form-control" name="map_description" rows="2">{{ $sections['map']['description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>نص الزر</label>
                                        <input type="text" class="form-control" name="map_button_text" value="{{ $sections['map']['button_text'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>رابط خرائط جوجل</label>
                                        <input type="url" class="form-control" name="map_embed" value="{{ $sections['map']['embed'] ?? '' }}">
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
