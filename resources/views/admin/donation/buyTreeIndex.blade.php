@extends('admin.layouts.master')
@section('title', 'Donations List')

@section('content')
    <main class="content-page">
        <div class="content mt-4">
            <div class="container-fluid">

                @if (session('success'))
                    <div class="alert alert-success" id="flash-message">{{ session('success') }}</div>
                @endif
                @if (session('message'))
                    <div class="alert alert-danger">{{ session('message') }}</div>
                @endif
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold">Buy Trees From Donation Funds</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                @if(auth('admin')->check())
                                    <th>User</th>
                                @endif
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Trees From Funds</th>
                                <th>Fund Type</th>
                                <th>Donation Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donations as $donation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    @if(auth('admin')->check())
                                        <td>{{ $donation->users->name }}</td>
                                    @endif
                                    <td>{{ $donation->type }}</td>
                                    <td>{{ $donation->amount }}</td>
                                    <td>{{ $donation->no_of_bought_trees ?? ' - ' }}</td>
                                    <td>{{ $donation->fund_type }}</td>
                                    <td>{{ $donation->donation_number }}</td>
                                    <td>
                                        <a href="{{ route('donation.buy.trees.create',['donation_id' => $donation->id]) }}" title="Buy Trees">
                                                <img src="{{asset('admin/assets/images/edit.gif') }}" width="30"></a>
                                        {{-- <a href="{{ route('donation.edit', $donation->id) }}"
                                            class="btn btn-sm btn-warning {{ 
                                                $donation->flow === 'Own' 
                                                || $donation->trees->contains(fn ($tree) => !is_null($tree->donation_id_out))
                                                ? 'disabled' 
                                                : '' 
                                            }}">Edit</a> --}}
                                        <form action="{{ route('donation.destroy', $donation->id,) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="buyTreeDelete" value="buyTreeDelete">
                                            <button class="ms-2 {{ $donation->flow === 'Own' || $donation->trees->contains(fn ($tree) => !is_null($tree->donation_id_out))
                                                ? 'disabled' 
                                                : '' 
                                            }}"title="Delete" style="border: none; background: none; padding: 0;">
                                                <img src="{{asset('admin/assets/images/delete.gif') }}" width="30"></button>
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
                flash.style.transition = "opacity 15s ease";
                flash.style.opacity = 0;
                setTimeout(() => flash.remove(), 500);
            }
        }, 3000);
    </script>
@endsection
