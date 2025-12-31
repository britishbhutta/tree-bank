@extends('admin.layouts.master')

@section('title', 'Add Currency')

@section('content')
    <main class="content-page">
        <div class="content mt-4">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">

                        {{-- Page Heading --}}
                        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                            <h4 class="mb-0 fw-bold">
                                Add New Currency
                            </h4>

                            <a href="{{ route('admin.currencies') }}" class="btn btn-secondary">
                                Back
                            </a>
                        </div>

                        <form method="POST" action="{{ route('admin.storeCurrency') }}">
                            @csrf

                            {{-- Name & Symbol --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Currency Name</label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Enter currency name" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Symbol</label>
                                    <input type="text" name="symbol" class="form-control" placeholder="e.g. $">
                                </div>
                            </div>

                            {{-- Code & Rate --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Currency Code</label>
                                    <input type="text" name="code" class="form-control" placeholder="e.g. USD"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Exchange Rate</label>
                                    <input type="number" step="0.01" name="rate" class="form-control"
                                        placeholder="Enter rate" required>
                                </div>
                            </div>

                            {{-- Decimals & Primary Order --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Decimals</label>
                                    <input type="number" name="decimals" class="form-control" placeholder="e.g. 2">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Primary Order</label>
                                    <input type="number" name="primary_order" class="form-control"
                                        placeholder="Order priority">
                                </div>
                            </div>

                            {{-- Symbol Placement & Status --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Symbol Placement</label>
                                    <select name="symbol_placement" class="form-select" required>
                                        <option value="" disabled selected>Select placement</option>
                                        <option value="before">Before Amount</option>
                                        <option value="after">After Amount</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Status</label>
                                    <select name="is_active" class="form-select" required>
                                        <option value="" disabled selected>Select status</option>
                                        <option value="Yes">Active</option>
                                        <option value="No">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="text-end">
                                <button type="submit" class="btn btn-success px-4">
                                    Save Currency
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
