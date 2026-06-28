@extends('dashboard.layouts.app')
@section('title', 'إدارة محتوى صفحة تواصل معنا')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                <h3 class="mb-0 content-header-title d-inline-block"> تواصل معنا </h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.page-contents.index') }}">محتوى الصفحات</a></li>
                            <li class="breadcrumb-item active"> تواصل معنا</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <form method="POST" action="{{ route('dashboard.page-contents.contact.update') }}" enctype="multipart/form-data">
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
                                        <label>العنوان</label>
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

                {{-- Channels Section --}}
                <div class="card">
                    <div class="card-header"><h4 class="card-title"><i class="la la-share-alt"></i> قنوات التواصل</h4></div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @foreach([1, 2, 3, 4] as $i)
                            <div class="row mb-3">
                                <div class="col-md-1"><strong>{{ $i }}</strong></div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>العنوان</label>
                                        <input type="text" class="form-control" name="channels_{{ $i }}_title" value="{{ $sections['channels'][$i]['title'] ?? '' }}" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>القيمة</label>
                                        <input type="text" class="form-control" name="channels_{{ $i }}_value" value="{{ $sections['channels'][$i]['value'] ?? '' }}" placeholder="0790 123 456">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>النص الفرعي</label>
                                        <input type="text" class="form-control" name="channels_{{ $i }}_subtitle" value="{{ $sections['channels'][$i]['subtitle'] ?? '' }}" placeholder="You can call us during working hours">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>الأيقونة</label>
                                        <input type="text" class="form-control" name="channels_{{ $i }}_icon" value="{{ $sections['channels'][$i]['icon'] ?? '' }}" placeholder="fa-solid fa-phone-flip">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Help Section --}}
                <div class="card">
                    <div class="card-header"><h4 class="card-title"><i class="la la-question-circle"></i> قسم المساعدة</h4></div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>عنوان القسم</label>
                                        <input type="text" class="form-control" name="help_section_title" value="{{ $sections['help_title'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            @foreach([1, 2, 3] as $i)
                            <div class="row mb-3">
                                <div class="col-md-1"><strong>{{ $i }}</strong></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>العنوان</label>
                                        <input type="text" class="form-control" name="help_{{ $i }}_title" value="{{ $sections['help'][$i]['title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>الوصف</label>
                                        <textarea class="form-control" name="help_{{ $i }}_description" rows="2">{{ $sections['help'][$i]['description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>الأيقونة</label>
                                        <input type="text" class="form-control" name="help_{{ $i }}_icon" placeholder="fa-solid fa-couch" value="{{ $sections['help'][$i]['icon'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>الرابط</label>
                                        <input type="text" class="form-control" name="help_{{ $i }}_link" value="{{ $sections['help'][$i]['link'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Form Section --}}
                <div class="card">
                    <div class="card-header"><h4 class="card-title"><i class="la la-pencil-square"></i> قسم النموذج</h4></div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>عنوان النموذج</label>
                                        <input type="text" class="form-control" name="form_title" value="{{ $sections['form']['title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>نص الزر</label>
                                        <input type="text" class="form-control" name="form_submit_text" value="{{ $sections['form']['submit_text'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>نص التأكيد</label>
                                        <input type="text" class="form-control" name="form_privacy" value="{{ $sections['form']['privacy'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Placeholder: الاسم</label>
                                        <input type="text" class="form-control" name="form_name_placeholder" value="{{ $sections['form']['name_placeholder'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Placeholder: الهاتف</label>
                                        <input type="text" class="form-control" name="form_phone_placeholder" value="{{ $sections['form']['phone_placeholder'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Placeholder: المدينة</label>
                                        <input type="text" class="form-control" name="form_city_placeholder" value="{{ $sections['form']['city_placeholder'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Placeholder: الرسالة</label>
                                        <input type="text" class="form-control" name="form_message_placeholder" value="{{ $sections['form']['message_placeholder'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>عنوان البطاقة الجانبية</label>
                                        <input type="text" class="form-control" name="form_side_title" value="{{ $sections['form']['side_title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>وصف البطاقة الجانبية</label>
                                        <textarea class="form-control" name="form_side_description" rows="2">{{ $sections['form']['side_description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Features Section --}}
                <div class="card">
                    <div class="card-header"><h4 class="card-title"><i class="la la-star"></i> المميزات</h4></div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @foreach([1, 2, 3, 4] as $i)
                            <div class="row mb-3">
                                <div class="col-md-1"><strong>{{ $i }}</strong></div>
                                <div class="col-md-3">
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
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>الأيقونة</label>
                                        <input type="text" class="form-control" name="features_{{ $i }}_icon" placeholder="fa-solid fa-heart" value="{{ $sections['features'][$i]['icon'] ?? '' }}">
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
