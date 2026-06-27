@extends('dashboard.layouts.app')
@section('title', 'إدارة المنتجات')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                <h3 class="mb-0 content-header-title d-inline-block"> ادارة المنتجات </h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية </a></li>
                            <li class="breadcrumb-item active"> ادارة المنتجات</li>
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
                            <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary">
                                <i class="la la-plus"></i> اضافة منتج جديد
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
                                                <th> اسم المنتج </th>
                                                <th> القسم </th>
                                                <th> السعر </th>
                                                <th> السعر المخفض </th>
                                                <th> التوفر </th>
                                                <th> الحالة </th>
                                                <th> العمليات </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($products as $product)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    @if($product->mainImage)
                                                    <img src="{{ asset('assets/uploads/products/' . $product->mainImage->image) }}"
                                                        alt="{{ $product->name }}"
                                                        style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                                                    @else
                                                    <span class="badge badge-light">بدون صورة</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $product->name }}</strong>
                                                    @if($product->sku)
                                                    <br><small class="text-muted">SKU: {{ $product->sku }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $product->category->name ?? '-' }}
                                                </td>
                                                <td>
                                                    {{ number_format($product->price, 2) }}
                                                </td>
                                                <td>
                                                    @if($product->has_discount)
                                                    <span class="text-danger">
                                                        {{ number_format($product->discount_price, 2) }}
                                                    </span>
                                                    @else
                                                    <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($product->availability)
                                                    <span class="badge badge-success"> متوفر </span>
                                                    @else
                                                    <span class="badge badge-warning"> غير متوفر </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($product->status)
                                                    <span class="badge badge-success"> مفعل </span>
                                                    @else
                                                    <span class="badge badge-danger"> معطل </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-info btn-sm"
                                                        href="{{ route('dashboard.products.edit', $product->id) }}">
                                                        <i class="la la-edit"></i> تعديل
                                                    </a>
                                                    <a href="{{ route('dashboard.products.destroy', $product->id) }}"
                                                        onclick="return confirm('هل أنت متأكد من حذف هذا المنتج؟')"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="la la-trash"></i> حذف
                                                    </a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="9" class="text-center text-muted">
                                                    لا توجد منتجات حالياً
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
