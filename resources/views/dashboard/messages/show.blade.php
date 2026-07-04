@extends('dashboard.layouts.app')
@section('title', 'عرض الرسالة')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="mb-2 content-header-left col-md-6 col-12">
                    <h3 class="mb-0 content-header-title d-inline-block">عرض الرسالة</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.messages.index') }}">رسائل الاتصال</a></li>
                                <li class="breadcrumb-item active"><a href="#">عرض الرسالة</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">رسالة من: {{ $message->name }}</h4>
                                    <div class="card-actions float-left">
                                        <a href="{{ route('dashboard.messages.index') }}" class="btn btn-secondary">
                                            <i class="la la-arrow-right"></i> العودة
                                        </a>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="fw-bold">الاسم:</label>
                                                    <p>{{ $message->name }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="fw-bold">الهاتف:</label>
                                                    <p dir="ltr">{{ $message->phone }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="fw-bold">البلد:</label>
                                                    <p>{{ $message->country }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="fw-bold">التاريخ:</label>
                                                    <p>{{ $message->created_at->format('Y-m-d H:i:s') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="fw-bold">الرسالة:</label>
                                                    <div class="border p-3 rounded" style="background: #f9f9f9;">
                                                        {!! nl2br(e($message->message)) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5>إجراءات</h5>
                                    <a href="tel:{{ $message->phone }}" class="btn btn-outline-primary btn-block mb-2">
                                        <i class="la la-phone"></i> اتصال
                                    </a>
                                    <a href="https://wa.me/{{ $message->phone }}" target="_blank" class="btn btn-outline-success btn-block mb-2">
                                        <i class="la la-whatsapp"></i> واتساب
                                    </a>
                                    <form action="{{ route('dashboard.messages.destroy', $message->id) }}"
                                        method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-block">
                                            <i class="la la-trash"></i> حذف الرسالة
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
