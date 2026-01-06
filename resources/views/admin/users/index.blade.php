@extends('admin.layouts.master')

@section('title', 'Users')

@section('content')
<main class="content-page">
    <div class="content mt-4">
        <div class="container-fluid">

            {{-- Page Header --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Users List</h4>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                    + Add User
                </a>
            </div>

            {{-- Alerts --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Card --}}
            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            <strong>{{ $user->name }}</strong>
                                        </td>

                                        <td>
                                            @if($user->role == 2)
                                                <span class="badge bg-info">Company</span>
                                            @elseif($user->role == 3)
                                                <span class="badge bg-success">Gardener</span>
                                            @elseif($user->role == 4)
                                                <span class="badge bg-secondary">Caretaker</span>
                                            @elseif($user->role == 5)
                                                <span class="badge bg-secondary">Volunteer</span>
                                            @else
                                                <span class="badge bg-primary">User</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $user->role == 2 ? $user->company_email : $user->email }}
                                        </td>

                                        <td class="text-end">
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                               class="btn btn-sm btn-warning">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Are you sure?')"
                                                        class="btn btn-sm btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            No users found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>
@endsection
