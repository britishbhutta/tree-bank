@extends('admin.layouts.master')
@section('title', 'Add Tree')

@section('content')
    <main class="content-page">
        <div class="content mt-4">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <h4 class="fw-bold mb-4 border-bottom pb-2">Add Tree</h4>

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

                        <form method="POST" action="#">
                            @csrf
                            <div class="row">

                                <!-- Donation IN -->
                                <div class="col-md-6 mb-3">
                                    <label for="donation_in_id" class="form-label">Donation In</label>
                                    <select id="donation_in_id" name="donation_in_id" class="form-control">
                                        <option value="">Select Donation In</option>
                                        @foreach ($donationIn as $donation)
                                            <option value="{{ $donation->id }}">
                                                {{ $donation->donation_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Donation OUT -->
                                <div class="col-md-6 mb-3">
                                    <label for="donation_out_id" class="form-label">Donation Out</label>
                                    <select id="donation_out_id" name="donation_out_id" class="form-control">
                                        <option value="">Select Donation Out</option>
                                        @foreach ($donationOut as $donation)
                                            <option value="{{ $donation->id }}">
                                                {{ $donation->donation_number }} - {{ $donation->user->name ?? '-' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
