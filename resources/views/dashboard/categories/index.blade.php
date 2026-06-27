@extends('dashboard.layouts.app')
@section('title', 'إدارة أقسام المنتجات')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                <h3 class="mb-0 content-header-title d-inline-block"> ادارة اقسام المنتجات </h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية </a></li>
                            <li class="breadcrumb-item active"> ادارة اقسام المنتجات</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12"></div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('dashboard.product-categories.create') }}" class="btn btn-primary">
                                <i class="la la-plus"></i> اضافة قسم جديد
                            </a>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th> الصورة </th>
                                                <th> اسم القسم </th>
                                                <th> الوصف </th>
                                                <th> الرابط </th>
                                                <th> الحالة </th>
                                                <th> تاريخ الانشاء </th>
                                                <th> العمليات </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($categories as $category)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    @if($category->image)
                                                    <img src="{{ asset('assets/uploads/categories/' . $category->image) }}"
                                                        alt="{{ $category->name }}"
                                                        style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                                                    @else
                                                    <span class="badge badge-light">بدون صورة</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $category->name }}</strong>
                                                </td>
                                                <td>
                                                    {{ Str::limit($category->description, 50) }}
                                                </td>
                                                <td>
                                                    <code>{{ $category->slug }}</code>
                                                </td>
                                                <td>
                                                    @if($category->status)
                                                    <span class="badge badge-success"> مفعل </span>
                                                    @else
                                                    <span class="badge badge-danger"> معطل </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $category->created_at ? $category->created_at->format('Y-m-d H:i') : '-' }}
                                                </td>
                                                <td>
                                                    <a class="btn btn-info btn-sm"
                                                        href="{{ route('dashboard.product-categories.edit', $category->id) }}">
                                                        <i class="la la-edit"></i> تعديل
                                                    </a>
                                                    <a href="{{ route('dashboard.product-categories.destroy', $category->id) }}"
                                                        onclick="return confirm('هل أنت متأكد من حذف هذا القسم؟')"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="la la-trash"></i> حذف
                                                    </a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">
                                                    لا توجد اقسام حالياً
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
