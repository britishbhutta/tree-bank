@extends('admin.layouts.master')
@section('title', 'Edit Donation')

@section('content')
<main class="content-page">
    <div class="content mt-4">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h4 class="fw-bold mb-4 border-bottom pb-2">Edit Donation</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('admin.donation.update', $donation->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <!-- Donation Number -->
                            <div class="col-md-6 mb-3">
                                <label for="donation_number" class="form-label">Donation Number</label>
                                <input type="text" id="donation_number" name="donation_number" class="form-control"
                                    value="{{ old('donation_number', $donation->donation_number) }}" readonly>
                            </div>

                            <!-- User -->
                            <div class="col-md-6 mb-3">
                                <label for="user_id" class="form-label">User</label>
                                <select id="user_id" name="user_id" class="form-control">
                                    <option value="">Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id', $donation->user_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Workshop -->
                            <div class="col-md-6 mb-3">
                                <label for="ws_id" class="form-label">Workshop</label>
                                <select id="ws_id" name="ws_id" class="form-control">
                                    <option value="">Select Workshop</option>
                                    @foreach ($workshops as $workshop)
                                        <option value="{{ $workshop->id }}" {{ old('ws_id', $donation->ws_id) == $workshop->id ? 'selected' : '' }}>
                                            {{ $workshop->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Type -->
                            <div class="col-md-6 mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select id="type" name="type" class="form-control">
                                    <option value="Trees" {{ old('type', $donation->type) == 'Trees' ? 'selected' : '' }}>Trees</option>
                                    <option value="Funds" {{ old('type', $donation->type) == 'Funds' ? 'selected' : '' }}>Funds</option>
                                </select>
                            </div>

                            <!-- Fund Type -->
                            <div class="col-md-6 mb-3">
                                <label for="fund_type" class="form-label">Fund Type</label>
                                <select id="fund_type" name="fund_type" class="form-control" {{ old('type', $donation->type) == 'Trees' ? 'disabled' : '' }}>
                                    <option value="">Select Fund Type</option>
                                    <option value="Cash" {{ old('fund_type', $donation->fund_type) == 'Cash' ? 'selected' : '' }}>Cash</option>
                                    <option value="Cheque" {{ old('fund_type', $donation->fund_type) == 'Cheque' ? 'selected' : '' }}>Cheque</option>
                                </select>
                            </div>

                            <!-- Flow -->
                            <div class="col-md-6 mb-3">
                                <label for="flow" class="form-label">Flow</label>
                                <select id="flow" name="flow" class="form-control">
                                    <option value="">Select Flow</option>
                                    <option value="In" {{ old('flow', $donation->flow) == 'In' ? 'selected' : '' }}>In</option>
                                    <option value="Out" {{ old('flow', $donation->flow) == 'Out' ? 'selected' : '' }}>Out</option>
                                </select>
                            </div>

                            <!-- Amount -->
                            <div class="col-md-6 mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" id="amount" name="amount" class="form-control" value="{{ old('amount', $donation->amount) }}">
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</main>

<script>
    const typeSelect = document.getElementById('type');
    const fundTypeSelect = document.getElementById('fund_type');

    typeSelect.addEventListener('change', function() {
        if (this.value === 'Funds') {
            fundTypeSelect.disabled = false;
        } else {
            fundTypeSelect.disabled = true;
            fundTypeSelect.value = '';
        }
    });
</script>
@endsection
