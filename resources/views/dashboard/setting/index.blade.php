@extends('dashboard.layouts.app')
@section('title', 'الاعدادات')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                    <h3 class="mb-0 content-header-title d-inline-block"> الاعدادات </h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية </a></li>
                                <li class="breadcrumb-item active"> الاعدادات</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <ul style="margin-bottom: 0;">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="card-header">
                                    <h4 class="card-title"> الاعدادات العامة </h4>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" method="POST"
                                            action="{{ route('dashboard.setting.update') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">

                                                    {{-- ========== معلومات الموقع ========== --}}
                                                    <div class="col-12">
                                                        <h5 class="form-section"><i class="la la-globe"></i> معلومات الموقع</h5>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="site_name"> اسم الموقع </label>
                                                            <input type="text" id="site_name" class="form-control"
                                                                name="site_name"
                                                                value="{{ old('site_name', $setting->site_name) }}"
                                                                placeholder="مثال: L.D Importer">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="site_logo"> شعار الموقع </label>
                                                            <input type="file" id="site_logo" class="form-control"
                                                                name="site_logo" accept="image/*">
                                                            @if($setting->site_logo)
                                                            <div class="mt-2">
                                                                <img src="{{ asset('assets/uploads/settings/' . $setting->site_logo) }}"
                                                                    alt="Logo" style="max-width: 100px; max-height: 100px;">
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="site_description"> وصف الموقع </label>
                                                            <textarea id="site_description" class="form-control"
                                                                name="site_description" rows="3"
                                                                placeholder="وصف مختصر عن الموقع">{{ old('site_description', $setting->site_description) }}</textarea>
                                                        </div>
                                                    </div>

                                                    {{-- ========== معلومات الاتصال ========== --}}
                                                    <div class="col-12">
                                                        <h5 class="form-section mt-3"><i class="la la-phone"></i> معلومات الاتصال</h5>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="phone1"> رقم الهاتف 1 </label>
                                                            <input type="text" id="phone1" class="form-control"
                                                                name="phone1"
                                                                value="{{ old('phone1', $setting->phone1) }}"
                                                                placeholder="مثال: +970599123456">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="phone2"> رقم الهاتف 2 </label>
                                                            <input type="text" id="phone2" class="form-control"
                                                                name="phone2"
                                                                value="{{ old('phone2', $setting->phone2) }}"
                                                                placeholder="رقم هاتف إضافي">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="whatsapp"> رقم الواتساب </label>
                                                            <input type="text" id="whatsapp" class="form-control"
                                                                name="whatsapp"
                                                                value="{{ old('whatsapp', $setting->whatsapp) }}"
                                                                placeholder="مثال: 970599123456">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="email"> البريد الالكتروني </label>
                                                            <input type="email" id="email" class="form-control"
                                                                name="email"
                                                                value="{{ old('email', $setting->email) }}"
                                                                placeholder="مثال: info@ldimporter.com">
                                                        </div>
                                                    </div>

                                                    {{-- ========== العنوان وساعات العمل ========== --}}
                                                    <div class="col-12">
                                                        <h5 class="form-section mt-3"><i class="la la-map-marker"></i> العنوان وساعات العمل</h5>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="address"> العنوان </label>
                                                            <input type="text" id="address" class="form-control"
                                                                name="address"
                                                                value="{{ old('address', $setting->address) }}"
                                                                placeholder="عنوان الفرع الرئيسي">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="working_hours"> ساعات العمل </label>
                                                            <input type="text" id="working_hours" class="form-control"
                                                                name="working_hours"
                                                                value="{{ old('working_hours', $setting->working_hours) }}"
                                                                placeholder="مثال: Sun - Thu | 09:00 AM - 06:00 PM">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="google_map_link"> رابط خرائط جوجل </label>
                                                            <input type="url" id="google_map_link" class="form-control"
                                                                name="google_map_link"
                                                                value="{{ old('google_map_link', $setting->google_map_link) }}"
                                                                placeholder="https://maps.google.com/...">
                                                        </div>
                                                    </div>

                                                    {{-- ========== السوشيال ميديا ========== --}}
                                                    <div class="col-12">
                                                        <h5 class="form-section mt-3"><i class="la la-share-alt"></i> روابط السوشيال ميديا</h5>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="facebook"> فيسبوك </label>
                                                            <input type="url" id="facebook" class="form-control"
                                                                name="facebook"
                                                                value="{{ old('facebook', $setting->facebook) }}"
                                                                placeholder="https://facebook.com/...">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="instagram"> انستجرام </label>
                                                            <input type="url" id="instagram" class="form-control"
                                                                name="instagram"
                                                                value="{{ old('instagram', $setting->instagram) }}"
                                                                placeholder="https://instagram.com/...">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="twitter"> تويتر / X </label>
                                                            <input type="url" id="twitter" class="form-control"
                                                                name="twitter"
                                                                value="{{ old('twitter', $setting->twitter) }}"
                                                                placeholder="https://twitter.com/...">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="tiktok"> تيك توك </label>
                                                            <input type="url" id="tiktok" class="form-control"
                                                                name="tiktok"
                                                                value="{{ old('tiktok', $setting->tiktok) }}"
                                                                placeholder="https://tiktok.com/...">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="youtube"> يوتيوب </label>
                                                            <input type="url" id="youtube" class="form-control"
                                                                name="youtube"
                                                                value="{{ old('youtube', $setting->youtube) }}"
                                                                placeholder="https://youtube.com/...">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="snapchat"> سناب شات </label>
                                                            <input type="url" id="snapchat" class="form-control"
                                                                name="snapchat"
                                                                value="{{ old('snapchat', $setting->snapchat) }}"
                                                                placeholder="https://snapchat.com/...">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="linkedin"> لينكد ان </label>
                                                            <input type="url" id="linkedin" class="form-control"
                                                                name="linkedin"
                                                                value="{{ old('linkedin', $setting->linkedin) }}"
                                                                placeholder="https://linkedin.com/...">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-save"></i> حفظ الإعدادات
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
