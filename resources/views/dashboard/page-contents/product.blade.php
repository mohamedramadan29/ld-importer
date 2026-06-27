@extends('dashboard.layouts.app')
@section('title', 'إدارة صفحة تفاصيل المنتج')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                <h3 class="mb-0 content-header-title d-inline-block"> تفاصيل المنتج </h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.page-contents.index') }}">محتوى الصفحات</a></li>
                            <li class="breadcrumb-item active"> تفاصيل المنتج</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <form method="POST" action="{{ route('dashboard.page-contents.product.update') }}" enctype="multipart/form-data">
                @csrf

                {{-- WhatsApp Button --}}
                <div class="card">
                    <div class="card-header"><h4 class="card-title"><i class="la la-whatsapp"></i> زر الواتساب</h4></div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>نص الزر</label>
                                        <input type="text" class="form-control" name="whatsapp_text" value="{{ $sections['whatsapp']['text'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>رقم الواتساب</label>
                                        <input type="text" class="form-control" name="whatsapp_number" value="{{ $sections['whatsapp']['number'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Showroom Banner --}}
                <div class="card">
                    <div class="card-header"><h4 class="card-title"><i class="la la-map-marker"></i> بانر المعرض</h4></div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>العنوان</label>
                                        <input type="text" class="form-control" name="showroom_title" value="{{ $sections['showroom']['title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>الوصف</label>
                                        <textarea class="form-control" name="showroom_description" rows="2">{{ $sections['showroom']['description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>نص الزر</label>
                                        <input type="text" class="form-control" name="showroom_button_text" value="{{ $sections['showroom']['button_text'] ?? '' }}">
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
