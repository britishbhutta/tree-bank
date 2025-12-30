@extends('admin.layouts.master')

@section('title', 'Add User')

@section('content')
<main class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row py-3 justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h4 class="mb-4 text-center">Add User</h4>

                            {{-- Success Message --}}
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            {{-- Validation Errors --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.users.store') }}" method="POST">
                                @csrf

                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Email (Personal)</label>
                                        <input type="email" id="user_email" name="email" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Phone (Personal)</label>
                                        <input type="text" id="user_phone" name="phone" class="form-control">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Address (Personal)</label>
                                        <input type="text" id="user_address" name="address" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Role</label>
                                        <select name="role" id="role" class="form-select">
                                            <option value="">Select Role</option>
                                            <option value="1">User</option>
                                            <option value="2">Company</option>
                                            <option value="3">Gardener</option>
                                            <option value="4">Caretaker</option>
                                        </select>
                                    </div>

                                    <!-- Company Fields -->
                                    <div id="company_fields" class="row g-3 d-none mt-2">

                                        <div class="col-md-6">
                                            <label class="form-label">Email (Company)</label>
                                            <input type="email" name="company_email" class="form-control">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Phone (Company)</label>
                                            <input type="text" name="company_phone" class="form-control">
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label">Address (Company)</label>
                                            <input type="text" name="company_address" class="form-control">
                                        </div>

                                    </div>

                                    <div class="col-12 text-end mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            Save User
                                        </button>
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

<script>
document.getElementById('role').addEventListener('change', function () {
    let role = this.value;

    let companyFields = document.getElementById('company_fields');
    let userEmail = document.getElementById('user_email');
    let userPhone = document.getElementById('user_phone');
    let userAddress = document.getElementById('user_address');

    if (role === '2') {
        companyFields.classList.remove('d-none');

        userEmail.disabled = true;
        userPhone.disabled = true;
        userAddress.disabled = true;

        userEmail.value = '';
        userPhone.value = '';
        userAddress.value = '';
    } else {
        companyFields.classList.add('d-none');

        userEmail.disabled = false;
        userPhone.disabled = false;
        userAddress.disabled = false;
    }
});
</script>
@endsection
