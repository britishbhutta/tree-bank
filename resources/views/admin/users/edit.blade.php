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

                            <h4 class="mb-4">Edit User</h4>

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

                                <div class="row g-3">

                                    {{-- BASIC INFO --}}
                                    <div class="col-md-6">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control"
                                               value="{{ old('name', $user->name) }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Department</label>
                                        <input type="text" name="department" class="form-control"
                                               value="{{ old('department', $user->department) }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Role</label>
                                        <input type="hidden" name="role" id="role_hidden"
                                               value="{{ old('role', $user->role) }}">
                                        <select id="role" class="form-select">
                                            <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>User</option>
                                            <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Company</option>
                                            <option value="3" {{ $user->role == 3 ? 'selected' : '' }}>Gardener</option>
                                            <option value="4" {{ $user->role == 4 ? 'selected' : '' }}>Caretaker</option>
                                            <option value="5" {{ $user->role == 5 ? 'selected' : '' }}>Volunteer</option>
                                        </select>
                                    </div>

                                    {{-- ================= PERSONAL FIELDS ================= --}}
                                    <div id="personal_fields" class="col-12">

                                        <h6 class="mt-3 mb-2 text-muted">Personal Information</h6>
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

                                            <div class="col-md-6">
                                                <label class="form-label">Address</label>
                                                <input type="text" name="address" class="form-control"
                                                       value="{{ old('address', $user->address) }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">City</label>
                                                <input type="text" name="city" class="form-control"
                                                       value="{{ old('city', $user->city) }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">District</label>
                                                <input type="text" name="district" class="form-control"
                                                       value="{{ old('district', $user->district) }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Tehsil</label>
                                                <input type="text" name="tehsil" class="form-control"
                                                       value="{{ old('tehsil', $user->tehsil) }}">
                                            </div>

                                        </div>
                                    </div>

                                    {{-- ================= COMPANY FIELDS ================= --}}
                                    <div id="company_fields" class="col-12">

                                        <h6 class="mt-3 mb-2 text-muted">Company Information</h6>
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

                                            <div class="col-md-6">
                                                <label class="form-label">Company Address</label>
                                                <input type="text" name="company_address" class="form-control"
                                                       value="{{ old('company_address', $user->company_address) }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Company City</label>
                                                <input type="text" name="company_city" class="form-control"
                                                       value="{{ old('company_city', $user->company_city) }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Company District</label>
                                                <input type="text" name="company_district" class="form-control"
                                                       value="{{ old('company_district', $user->company_district) }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Company Tehsil</label>
                                                <input type="text" name="company_tehsil" class="form-control"
                                                       value="{{ old('company_tehsil', $user->company_tehsil) }}">
                                            </div>

                                        </div>
                                    </div>

                                    {{-- BUTTONS --}}
                                    <div class="col-12 text-end mt-4">
                                        <button class="btn btn-primary">Update</button>
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                                            Back
                                        </a>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>

{{-- JS --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const roleSelect = document.getElementById('role');
    const roleHidden = document.getElementById('role_hidden');
    const personal = document.getElementById('personal_fields');
    const company = document.getElementById('company_fields');

    function toggleFields() {
        const role = roleSelect.value;
        roleHidden.value = role;

        if (role === '2') {
            company.classList.remove('d-none');
            personal.classList.add('d-none');
        } else {
            company.classList.add('d-none');
            personal.classList.remove('d-none');
        }
    }

    toggleFields();
    roleSelect.addEventListener('change', toggleFields);
});
</script>
@endsection
