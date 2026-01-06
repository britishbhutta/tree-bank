@extends('admin.layouts.master')
@section('title', 'Donations List')

@section('content')
    <main class="content-page">
        <div class="content mt-4">
            <div class="container-fluid">

                @if (session('success'))
                    <div class="alert alert-success" id="flash-message">{{ session('success') }}</div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold">Donations</h4>
                    <a href="{{ route('admin.donation.create') }}" class="btn btn-primary">Add Donation</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Project</th>
                                <th>Workshop</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Fund Type</th>
                                <th>Flow</th>
                                <th>Donation Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donations as $donation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $donation->users->name }}</td>
                                    {{-- <td>{{ $donation->workshop?->projects?->name ?? '-' }}</td> --}}
                                    <td>
                                        @php
                                            $projectName = null;
                                            if ($donation->workshop && $donation->workshop->projects) {
                                                $projectName = $donation->workshop->projects->name;
                                            } elseif ($donation->trees->isNotEmpty()) {
                                                $projectName = $donation->trees->first()->projects->name ?? null;
                                            } else {
                                                $outTree = \App\Models\Tree::where('donation_id_out', $donation->id)->first();
                                                $projectName = $outTree?->projects?->name;
                                            }
                                        @endphp

                                        {{ $projectName ?? '-' }}
                                    </td>


                                    <td>{{ $donation->workshop->name ?? 'N/A' }}</td>
                                    <td>{{ $donation->type }}</td>
                                    <td>{{ $donation->amount }}</td>
                                    <td>{{ $donation->fund_type }}</td>
                                    <td>{{ $donation->flow }}</td>
                                    <td>{{ $donation->donation_number }}</td>
                                    <td>
                                        <a href="{{ route('admin.donation.edit', $donation->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.donation.destroy', $donation->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No donations found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $donations->links() }}
                </div>

            </div>
        </div>
    </main>

    <script>
        setTimeout(() => {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.style.transition = "opacity 0.5s ease";
                flash.style.opacity = 0;
                setTimeout(() => flash.remove(), 500);
            }
        }, 3000);
    </script>
@endsection
