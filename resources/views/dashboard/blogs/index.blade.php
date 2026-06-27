@extends('dashboard.layouts.app')
@section('title', 'إدارة المدونات')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                <h3 class="mb-0 content-header-title d-inline-block"> إدارة المدونات </h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية </a></li>
                            <li class="breadcrumb-item active"> إدارة المدونات</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12"></div>
        </div>
        <div class="content-body">
            <!-- Bordered striped start -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('dashboard.blogs.create') }}" class="btn btn-primary">
                                <i class="la la-plus"></i> إضافة تدوينة جديدة
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
                                                <th> العنوان </th>
                                                <th> الوصف </th>
                                                <th> الكاتب </th>
                                                <th> الحالة </th>
                                                <th> تاريخ النشر </th>
                                                <th> العمليات </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($blogs as $blog)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    @if($blog->image)
                                                    <img src="{{ asset('assets/uploads/blogs/' . $blog->image) }}"
                                                        alt="{{ $blog->title }}"
                                                        style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                                                    @else
                                                    <span class="badge badge-light">بدون صورة</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $blog->title }}</strong>
                                                </td>
                                                <td>
                                                    {{ Str::limit($blog->description, 50) }}
                                                </td>
                                                <td>
                                                    {{ $blog->author->name ?? 'غير معروف' }}
                                                </td>
                                                <td>
                                                    @if($blog->status)
                                                    <span class="badge badge-success"> مفعلة </span>
                                                    @else
                                                    <span class="badge badge-danger"> معطلة </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $blog->published_at ? $blog->published_at->format('Y-m-d H:i') :
                                                    'غير محدد' }}
                                                </td>
                                                <td>
                                                    <a class="btn btn-info btn-sm"
                                                        href="{{ route('dashboard.blogs.edit', $blog->id) }}">
                                                        <i class="la la-edit"></i> تعديل
                                                    </a>
                                                    <a href="{{ route('dashboard.blogs.destroy', $blog->id) }}"
                                                        onclick="return confirm('هل أنت متأكد من حذف هذه التدوينة؟')"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="la la-trash"></i> حذف
                                                    </a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">
                                                    لا توجد تدوينات حالياً
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
