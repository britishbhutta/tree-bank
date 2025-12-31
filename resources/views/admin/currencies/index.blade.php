@extends('admin.layouts.master')

@section('title', 'Currencies')

@section('content')
<main class="content-page">
    <div class="content mt-4">
        <div class="container-fluid">

            {{-- Alerts --}}
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('statusDanger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('statusDanger') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">

                    {{-- Page Heading --}}
                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                        <h4 class="mb-0 fw-bold">Currencies</h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.cronjob') }}" class="btn btn-info">
                                Run Cron Job
                            </a>
                            <a href="{{ route('admin.createCurrency') }}" class="btn btn-success">
                                Add Currency
                            </a>
                        </div>
                    </div>

                    {{-- Currency Table --}}
                    <div class="table-responsive">
                        <table class="table table-striped align-middle" id="myTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Symbol</th>
                                    <th>Code</th>
                                    <th>Rate</th>
                                    <th>Decimals</th>
                                    <th>Symbol Placement</th>
                                    <th>Primary Order</th>
                                    <th>Default</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($currencies as $currency)
                                    <tr>
                                        <td>{{ $currency->name }}</td>
                                        <td>{{ $currency->symbol }}</td>
                                        <td>{{ $currency->code }}</td>
                                        <td>{{ $currency->rate }}</td>
                                        <td>{{ $currency->decimals }}</td>
                                        <td class="text-capitalize">{{ $currency->symbol_placement }}</td>
                                        <td>{{ $currency->primary_order }}</td>
                                        <td>
                                            <span class="badge {{ $currency->is_default === 'Yes' ? 'bg-info' : 'bg-secondary' }}">
                                                {{ $currency->is_default }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge {{ $currency->is_active === 'Yes' ? 'bg-success' : 'bg-danger' }}">
                                                {{ $currency->is_active }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.editCurrency', $currency->id) }}" class="text-primary me-2" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('admin.deleteCurrency', $currency->id) }}" class="text-danger btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this currency?')">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted">No currencies found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-3">
                        {{ $currencies->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

{{-- Auto-hide alerts --}}
<script>
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.classList.remove('show');
        });
    }, 3000);
</script>
@endsection
