@extends('dashboard.layouts.app')
@section('title', 'إدارة محتوى الفوتر')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                <h3 class="mb-0 content-header-title d-inline-block"> محتوى الفوتر </h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.page-contents.index') }}">محتوى الصفحات</a></li>
                            <li class="breadcrumb-item active"> الفوتر </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <form method="POST" action="{{ route('dashboard.page-contents.footer.update') }}" enctype="multipart/form-data">
                @csrf

                {{-- Column Titles --}}
                <div class="card">
                    <div class="card-header"><h4 class="card-title"><i class="la la-header"></i> عناوين الأعمدة</h4></div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>عنوان العمود 1 (Information)</label>
                                        <input type="text" class="form-control" name="titles_info_title" value="{{ $sections['titles']['info_title'] ?? '' }}" placeholder="Information">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>عنوان العمود 2 (Collections)</label>
                                        <input type="text" class="form-control" name="titles_collections_title" value="{{ $sections['titles']['collections_title'] ?? '' }}" placeholder="Collections">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>عنوان العمود 3 (Customer Care)</label>
                                        <input type="text" class="form-control" name="titles_customer_care_title" value="{{ $sections['titles']['customer_care_title'] ?? '' }}" placeholder="Customer Care">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>نص رابط "عرض الكل" (Collections)</label>
                                        <input type="text" class="form-control" name="titles_view_all" value="{{ $sections['titles']['view_all'] ?? '' }}" placeholder="View All">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>نص حقوق النشر</label>
                                        <input type="text" class="form-control" name="titles_copyright" value="{{ $sections['titles']['copyright'] ?? '' }}" placeholder="All Rights Reserved">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Information Links --}}
                <div class="card">
                    <div class="card-header"><h4 class="card-title"><i class="la la-link"></i> روابط Information</h4></div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @foreach([1, 2, 3, 4] as $i)
                            <div class="row mb-3">
                                <div class="col-md-1"><strong>{{ $i }}</strong></div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>العنوان</label>
                                        <input type="text" class="form-control" name="items_{{ $i }}_title" value="{{ $sections['items'][$i]['title'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>الرابط</label>
                                        <input type="text" class="form-control" name="items_{{ $i }}_link" value="{{ $sections['items'][$i]['link'] ?? '' }}">
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
