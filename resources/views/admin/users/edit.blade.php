@extends('admin.layouts.master')

@section('title', 'Edit User')

@section('content')
<main class="content-page">
    <div class="content">
        <div class="container-fluid">

            <div class="row justify-content-center py-3">
                <div class="col-lg-10">

                    <div class="card shadow-sm">
                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="mb-0">Edit User</h4>
                            </div>

                            {{-- Alerts --}}
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    {{ session('success') }}
                                    <button class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                {{-- BASIC --}}
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control"
                                               value="{{ old('name', $user->name) }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Role</label>
                                        <select name="role" id="role" class="form-select" disabled>
                                            <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>User</option>
                                            <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Company</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- PERSONAL --}}
                                <div id="personal_fields" class="border rounded p-3 mb-3">
                                    <h6 class="mb-3 text-muted">Personal Information</h6>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                   value="{{ old('email', $user->email) }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Phone</label>
                                            <input type="text" name="phone" class="form-control"
                                                   value="{{ old('phone', $user->phone) }}">
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label">Address</label>
                                            <input type="text" name="address" class="form-control"
                                                   value="{{ old('address', $user->address) }}">
                                        </div>
                                    </div>
                                </div>

                                {{-- COMPANY --}}
                                <div id="company_fields" class="border rounded p-3 mb-3">
                                    <h6 class="mb-3 text-muted">Company Information</h6>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Company Email</label>
                                            <input type="email" name="company_email" class="form-control"
                                                   value="{{ old('company_email', $user->company_email) }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Company Phone</label>
                                            <input type="text" name="company_phone" class="form-control"
                                                   value="{{ old('company_phone', $user->company_phone) }}">
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label">Company Address</label>
                                            <input type="text" name="company_address" class="form-control"
                                                   value="{{ old('company_address', $user->company_address) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button class="btn btn-primary">Update User</button>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                                        Back
                                    </a>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const role = document.getElementById('role');
    const personal = document.getElementById('personal_fields');
    const company = document.getElementById('company_fields');

    function toggle() {
        if (role.value === '2') {
            company.style.display = 'block';
            personal.style.display = 'none';
        } else {
            company.style.display = 'none';
            personal.style.display = 'block';
        }
    }

    toggle();
    role.addEventListener('change', toggle);
});
</script>
@endsection
