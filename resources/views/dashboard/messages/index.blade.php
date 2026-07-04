@extends('dashboard.layouts.app')
@section('title', 'رسائل الاتصال')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="mb-2 content-header-left col-md-6 col-12">
                    <h3 class="mb-0 content-header-title d-inline-block">رسائل الاتصال</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية</a></li>
                                <li class="breadcrumb-item active"><a href="#">رسائل الاتصال</a></li>
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
                                <div class="card-header">
                                    <h4 class="card-title">جميع الرسائل ({{ $messages->count() }})</h4>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        @if ($messages->count() > 0)
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>الاسم</th>
                                                            <th>الهاتف</th>
                                                            <th>البلد</th>
                                                            <th>الرسالة</th>
                                                            <th>التاريخ</th>
                                                            <th>الحالة</th>
                                                            <th>إجراءات</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($messages as $msg)
                                                        <tr class="{{ !$msg->is_read ? 'table-light fw-bold' : '' }}">
                                                            <td>{{ $msg->id }}</td>
                                                            <td>{{ $msg->name }}</td>
                                                            <td dir="ltr">{{ $msg->phone }}</td>
                                                            <td>{{ $msg->country }}</td>
                                                            <td>{{ Str::limit($msg->message, 50) }}</td>
                                                            <td>{{ $msg->created_at->format('Y-m-d H:i') }}</td>
                                                            <td>
                                                                @if($msg->is_read)
                                                                    <span class="badge badge-success">مقروءة</span>
                                                                @else
                                                                    <span class="badge badge-warning">جديدة</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('dashboard.messages.show', $msg->id) }}"
                                                                    class="btn btn-sm btn-primary">
                                                                    <i class="la la-eye"></i>
                                                                </a>
                                                                <form action="{{ route('dashboard.messages.destroy', $msg->id) }}"
                                                                    method="POST" style="display:inline;"
                                                                    onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                                        <i class="la la-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <div class="text-center py-4">
                                                <i class="la la-envelope-open fa-3x text-muted mb-3"></i>
                                                <p class="text-muted">لا توجد رسائل حتى الآن</p>
                                            </div>
                                        @endif
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
