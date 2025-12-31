@extends('admin.layouts.master')

@section('title', 'Edit Currency')

@section('content')
    <main class="content-page">
        <div class="content mt-4">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">

                        {{-- Page Heading --}}
                        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                            <h4 class="mb-0 fw-bold">
                                Edit Currency
                            </h4>

                            <a href="{{ route('admin.currencies') }}" class="btn btn-secondary">
                                Back
                            </a>
                        </div>

                        <form method="POST" action="{{ route('admin.updateCurrency', $currency->id) }}">
                            @csrf
                            @method('PUT')

                            {{-- Name & Symbol --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Currency Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $currency->name }}"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Symbol</label>
                                    <input type="text" name="symbol" class="form-control"
                                        value="{{ $currency->symbol }}">
                                </div>
                            </div>

                            {{-- Code & Rate --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Currency Code</label>
                                    <input type="text" name="code" class="form-control" value="{{ $currency->code }}"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Exchange Rate</label>
                                    <input type="number" step="0.01" name="rate" class="form-control"
                                        value="{{ $currency->rate }}" required>
                                </div>
                            </div>

                            {{-- Decimals & Primary Order --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Decimals</label>
                                    <input type="number" name="decimals" class="form-control"
                                        value="{{ $currency->decimals }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Primary Order</label>
                                    <input type="number" name="primary_order" class="form-control"
                                        value="{{ $currency->primary_order }}">
                                </div>
                            </div>

                            {{-- Symbol Placement & Status --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Symbol Placement</label>
                                    <select name="symbol_placement" class="form-select" required>
                                        <option value="before"
                                            {{ $currency->symbol_placement === 'before' ? 'selected' : '' }}>
                                            Before Amount
                                        </option>
                                        <option value="after"
                                            {{ $currency->symbol_placement === 'after' ? 'selected' : '' }}>
                                            After Amount
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Status</label>
                                    <select name="is_active" class="form-select" required>
                                        <option value="Yes" {{ $currency->is_active === 'Yes' ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option value="No" {{ $currency->is_active === 'No' ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="text-end">
                                <button type="submit" class="btn btn-success px-4">
                                    Update Currency
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
