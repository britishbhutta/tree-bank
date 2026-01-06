@extends('admin.layouts.master')

@section('title')
    Dashboard
@endsection

@push('styles')
    <style>
        .card-label {
            font-size: 10px;
        }
    </style>
@endpush

@section('content')
    <main class="content-page">
        <div class="content">
            <div class="container-fluid">

                <!-- PAGE TITLE -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Dashboard</h4>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!-- Donors -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="avatar-sm bg-blue rounded shadow-lg">
                                            <i class="fe-user avatar-title font-22 text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <h3 class="text-dark my-1">
                                            <span data-plugin="counterup">{{ $donar_count }}</span>
                                        </h3>
                                        <p class="text-muted mb-0 card-label">Donors</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gardeners -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="avatar-sm bg-success rounded shadow-lg">
                                            <i class="fe-user avatar-title font-22 text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <h3 class="text-dark my-1">
                                            <span data-plugin="counterup">{{ $gardner_count }}</span>
                                        </h3>
                                        <p class="text-muted mb-0 card-label">Gardeners</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Caretakers -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="avatar-sm bg-warning rounded shadow-lg">
                                            <i class="fe-user avatar-title font-22 text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <h3 class="text-dark my-1">
                                            <span data-plugin="counterup">{{ $caretaker_count }}</span>
                                        </h3>
                                        <p class="text-muted mb-0 card-label">Caretakers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Donation Amount -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="avatar-sm bg-info rounded shadow-lg">
                                            <i class="fe-credit-card avatar-title font-22 text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <h3 class="text-dark my-1">
                                            Rs <span data-plugin="counterup">{{ $total_donation }}</span>
                                        </h3>
                                        <p class="text-muted mb-0 card-label">Donation Amount</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Trees -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="avatar-sm bg-success rounded shadow-lg">
                                            <i class="bi bi-tree avatar-title font-22 text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <h3 class="text-dark my-1">
                                            <span data-plugin="counterup">{{ $total_trees }}</span>
                                        </h3>
                                        <p class="text-muted mb-0 card-label">Total Trees</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Donations In -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="avatar-sm bg-primary rounded shadow-lg">
                                            <i class="fe-arrow-down avatar-title font-22 text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <h3 class="text-dark my-1">
                                            <span data-plugin="counterup">{{ $donations_in_count }}</span>
                                        </h3>
                                        <p class="text-muted mb-0 card-label">Donations In</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Donations Out -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="avatar-sm bg-danger rounded shadow-lg">
                                            <i class="fe-arrow-up avatar-title font-22 text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <h3 class="text-dark my-1">
                                            <span data-plugin="counterup">{{ $donations_out_count }}</span>
                                        </h3>
                                        <p class="text-muted mb-0 card-label">Donations Out</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Projects -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="avatar-sm bg-secondary rounded shadow-lg">
                                            <i class="fe-briefcase avatar-title font-22 text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <h3 class="text-dark my-1">
                                            <span data-plugin="counterup">{{ $projects_count }}</span>
                                        </h3>
                                        <p class="text-muted mb-0 card-label">Projects</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-xl-4 col-md-12">
                        <!-- Portlet card -->
                        <div class="card">
                            <div class="card-body">
                                <div class="card-widgets">
                                    <a href="javascript: void(0);" data-toggle="reload"><i
                                            class="mdi mdi-refresh"></i></a>
                                    <a data-bs-toggle="collapse" href="#cardCollpase1" role="button"
                                        aria-expanded="false" aria-controls="cardCollpase1"><i
                                            class="mdi mdi-minus"></i></a>
                                    <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                </div>
                                <h4 class="header-title mb-0">Lifetime Sales</h4>

                                <div id="cardCollpase1" class="collapse show">
                                    <div class="text-center pt-3">
                                        <div id="lifetime-sales" data-colors="#00acc1,#f1556c"></div>

                                        <div class="row mt-3">
                                            <div class="col-4">
                                                <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                                                <h4><i class="fe-arrow-down text-danger me-1"></i>$7.8k</h4>
                                            </div>
                                            <div class="col-4">
                                                <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                                                <h4><i class="fe-arrow-up text-success me-1"></i>$1.4k</h4>
                                            </div>
                                            <div class="col-4">
                                                <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                                                <h4><i class="fe-arrow-down text-danger me-1"></i>$9.8k</h4>
                                            </div>
                                        </div> <!-- end row -->

                                    </div>
                                </div> <!-- collapsed end -->
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-widgets">
                                    <a href="javascript: void(0);" data-toggle="reload"><i
                                            class="mdi mdi-refresh"></i></a>
                                    <a data-bs-toggle="collapse" href="#cardCollpase2" role="button"
                                        aria-expanded="false" aria-controls="cardCollpase2"><i
                                            class="mdi mdi-minus"></i></a>
                                    <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                </div>
                                <h4 class="header-title mb-0">Income Amounts</h4>

                                <div id="cardCollpase2" class="collapse show">
                                    <div class="text-center pt-3">
                                        <div id="income-amounts" data-colors="#00acc1"></div>
                                        <div class="row mt-3">
                                            <div class="col-4">
                                                <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                                                <h4><i class="fe-arrow-up text-success me-1"></i>641</h4>
                                            </div>
                                            <div class="col-4">
                                                <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                                                <h4><i class="fe-arrow-down text-danger me-1"></i>234</h4>
                                            </div>
                                            <div class="col-4">
                                                <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                                                <h4><i class="fe-arrow-up text-success me-1"></i>3201</h4>
                                            </div>
                                        </div> <!-- end row -->
                                    </div>
                                </div> <!-- collapsed end -->
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-widgets">
                                    <a href="javascript: void(0);" data-toggle="reload"><i
                                            class="mdi mdi-refresh"></i></a>
                                    <a data-bs-toggle="collapse" href="#cardCollpase3" role="button"
                                        aria-expanded="false" aria-controls="cardCollpase3"><i
                                            class="mdi mdi-minus"></i></a>
                                    <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                </div>
                                <h4 class="header-title mb-0">Total Users</h4>

                                <div id="cardCollpase3" class="collapse show">
                                    <div class="text-center pt-3">
                                        <div id="total-users" data-colors="#00acc1,#4b88e4,#e3eaef,#fd7e14"></div>
                                        <div class="row mt-3">
                                            <div class="col-4">
                                                <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                                                <h4><i class="fe-arrow-down text-danger me-1"></i>18k</h4>
                                            </div>
                                            <div class="col-4">
                                                <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                                                <h4><i class="fe-arrow-up text-success me-1"></i>3.25k</h4>
                                            </div>
                                            <div class="col-4">
                                                <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                                                <h4><i class="fe-arrow-up text-success me-1"></i>28k</h4>
                                            </div>
                                        </div> <!-- end row -->
                                    </div>
                                </div> <!-- collapsed end -->
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
@endpush
