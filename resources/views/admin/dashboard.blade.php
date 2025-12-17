@extends('admin.layouts.master')
@section('title') 
    Dashboard
@endsection
@push('styles') 
    
@endpush
@section('content')
    <main class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Dashboard</h4>
                        </div>
                    </div>
                </div>     
                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-sm bg-blue rounded shadow-lg">
                                            <i class="fe-user avatar-title font-22 text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-end">
                                            <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $donar_count }}</span></h3>
                                            <p class="text-muted mb-1 text-truncate">Donar</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div> 
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-sm bg-success rounded shadow-lg">
                                            <i class="fe-user avatar-title font-22 text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-end">
                                            <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $volunteers_count }}</span></h3>
                                            <p class="text-muted mb-1 text-truncate">Volunteers</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-sm bg-warning rounded shadow-lg">
                                            <i class="fe-dollar-sign avatar-title font-22 text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-end">
                                            <h3 class="text-dark my-1">$<span data-plugin="counterup">{{ $total_donation }}</span></h3>
                                            <p class="text-muted mb-1 text-truncate">Donations</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div> 
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-sm bg-info rounded shadow-lg">
                                            <i class="bi bi-tree avatar-title font-22 text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-end">
                                            <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $total_trees }}</span></h3>
                                            <p class="text-muted mb-1 text-truncate">Trees Planted</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-4 col-md-12">
                        <!-- Portlet card -->
                        <div class="card">
                            <div class="card-body">
                                <div class="card-widgets">
                                    <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                    <a data-bs-toggle="collapse" href="#cardCollpase1" role="button" aria-expanded="false" aria-controls="cardCollpase1"><i class="mdi mdi-minus"></i></a>
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
                                    <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                    <a data-bs-toggle="collapse" href="#cardCollpase2" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class="mdi mdi-minus"></i></a>
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
                                    <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                    <a data-bs-toggle="collapse" href="#cardCollpase3" role="button" aria-expanded="false" aria-controls="cardCollpase3"><i class="mdi mdi-minus"></i></a>
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
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-widgets">
                                    <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                    <a data-bs-toggle="collapse" href="#cardCollpase4" role="button" aria-expanded="false" aria-controls="cardCollpase4"><i class="mdi mdi-minus"></i></a>
                                    <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                </div>
                                <h4 class="header-title mb-0">Revenue By Location</h4>

                                <div id="cardCollpase4" class="collapse show">
                                    <div class="pt-3">
                                        <div id="world-map-markers" style="height: 433px"></div>
                                    </div>
                                </div> <!-- collapsed end -->
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col -->

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-widgets">
                                    <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                    <a data-bs-toggle="collapse" href="#cardCollpase5" role="button" aria-expanded="false" aria-controls="cardCollpase5"><i class="mdi mdi-minus"></i></a>
                                    <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                </div>
                                <h4 class="header-title mb-0">Top Selling Products</h4>

                                <div id="cardCollpase5" class="collapse show">
                                    <div class="table-responsive pt-3">
                                        <table class="table table-hover table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>ASOS Ridley High Waist</td>
                                                    <td>$79.49</td>
                                                    <td>82</td>
                                                    <td>$6,518.18</td>
                                                </tr>
                                                <tr>
                                                    <td>Marco Lightweight Shirt</td>
                                                    <td>$128.50</td>
                                                    <td>37</td>
                                                    <td>$4,754.50</td>
                                                </tr>
                                                <tr>
                                                    <td>Half Sleeve Shirt</td>
                                                    <td>$39.99</td>
                                                    <td>64</td>
                                                    <td>$2,559.36</td>
                                                </tr>
                                                <tr>
                                                    <td>Lightweight Jacket</td>
                                                    <td>$20.00</td>
                                                    <td>184</td>
                                                    <td>$3,680.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Marco Shoes</td>
                                                    <td>$28.49</td>
                                                    <td>69</td>
                                                    <td>$1,965.81</td>
                                                </tr>
                                                <tr>
                                                    <td>ASOS Ridley High Waist</td>
                                                    <td>$79.49</td>
                                                    <td>82</td>
                                                    <td>$6,518.18</td>
                                                </tr>
                                                <tr>
                                                    <td>Half Sleeve Shirt</td>
                                                    <td>$39.99</td>
                                                    <td>64</td>
                                                    <td>$2,559.36</td>
                                                </tr>
                                                <tr>
                                                    <td>Lightweight Jacket</td>
                                                    <td>$20.00</td>
                                                    <td>184</td>
                                                    <td>$3,680.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- end table responsive-->
                                </div> <!-- collapsed end -->
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div>
        </div>
    </main>
@endsection
@push('scripts') 
    
@endpush

            