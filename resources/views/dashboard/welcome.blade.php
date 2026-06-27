@extends('dashboard.layouts.app')

@section('title')
    الرئيسية
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Statistics -->
                <div class="row">

                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="text-primary">{{ $stats['total_categories'] }}</h3>
                                            <h6>اجمالي الاقسام</h6>
                                        </div>
                                        <div>
                                            <i class="float-right text-primary la la-tags font-large-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="text-success">{{ $stats['active_categories'] }}</h3>
                                            <h6>اقسام فعالة</h6>
                                        </div>
                                        <div>
                                            <i class="float-right text-success la la-check-circle font-large-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="text-danger">{{ $stats['inactive_categories'] }}</h3>
                                            <h6>اقسام معطلة</h6>
                                        </div>
                                        <div>
                                            <i class="float-right text-danger la la-times-circle font-large-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="text-warning">{{ $stats['total_products'] }}</h3>
                                            <h6>اجمالي المنتجات</h6>
                                        </div>
                                        <div>
                                            <i class="float-right text-warning la la-shopping-cart font-large-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="text-success">{{ $stats['active_products'] }}</h3>
                                            <h6>منتجات فعالة</h6>
                                        </div>
                                        <div>
                                            <i class="float-right text-success la la-check font-large-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="text-danger">{{ $stats['inactive_products'] }}</h3>
                                            <h6>منتجات معطلة</h6>
                                        </div>
                                        <div>
                                            <i class="float-right text-danger la la-ban font-large-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="text-info">{{ $stats['available_products'] }}</h3>
                                            <h6>منتجات متوفرة</h6>
                                        </div>
                                        <div>
                                            <i class="float-right text-info la la-cube font-large-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="text-danger">{{ $stats['unavailable_products'] }}</h3>
                                            <h6>منتجات غير متوفرة</h6>
                                        </div>
                                        <div>
                                            <i class="float-right text-danger la la-exclamation-triangle font-large-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-xl-4 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="text-secondary">{{ $stats['products_with_discount'] }}</h3>
                                            <h6>منتجات بها خصم</h6>
                                        </div>
                                        <div>
                                            <i class="float-right text-secondary la la-percent font-large-2"></i>
                                        </div>
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

@push('css')
    <style>
        .pull-up {
            transition: all 0.3s ease;
        }

        .pull-up:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush
