@extends('admin.layouts.master')

@section('title', 'Add User')

@section('content')
<main class="content-page">
    <div class="content">
        <div class="container-fluid">

            <div class="card shadow-sm">
                <div class="card-body">

                    {{-- Dynamic Heading --}}
                    <h4 id="formHeading" class="mb-4">Add User</h4>
                    <hr class="mb-4">

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

                            <!-- Role -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Role</label>
                                <select name="role" id="role" class="form-select">
                                    <option value="">Select Role</option>
                                    <option value="1">User</option>
                                    <option value="2">Company</option>
                                    <option value="3">Gardener</option>
                                    <option value="4">Caretaker</option>
                                    <option value="5">Volunteer</option>
                                </select>
                            </div>

                            <!-- Department -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Department</label>
                                <input type="text" name="department" class="form-control">
                            </div>

                            <!-- Full Name -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <!-- Password -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <!-- ================= PERSONAL FIELDS ================= -->
                            <div id="personal_fields" class="row g-3 m-0 p-0">

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Phone</label>
                                    <input type="text" name="phone" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Address</label>
                                    <input type="text" name="address" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">City</label>
                                    <input type="text" name="city" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">District</label>
                                    <input type="text" name="district" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Tehsil</label>
                                    <input type="text" name="tehsil" class="form-control">
                                </div>

                            </div>

                            <!-- ================= COMPANY FIELDS ================= -->
                            <div id="company_fields" class="row g-3 m-0 p-0 d-none">

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Company Email</label>
                                    <input type="email" name="company_email" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Company Phone</label>
                                    <input type="text" name="company_phone" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Company Address</label>
                                    <input type="text" name="company_address" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Company City</label>
                                    <input type="text" name="company_city" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Company District</label>
                                    <input type="text" name="company_district" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Company Tehsil</label>
                                    <input type="text" name="company_tehsil" class="form-control">
                                </div>

                            </div>

                            <!-- Submit Button -->
                            <div class="col-12 mt-4">
                                <button class="btn btn-primary px-4">Submit</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</main>

{{-- JS --}}
<script>
    document.getElementById('role').addEventListener('change', function() {

        let role = this.value;
        let heading = document.getElementById('formHeading');

        let personal = document.getElementById('personal_fields');
        let company = document.getElementById('company_fields');

        if (role === '2') {
            heading.innerText = 'Add Company';
            personal.classList.add('d-none');
            company.classList.remove('d-none');
        } else {
            company.classList.add('d-none');
            personal.classList.remove('d-none');

            switch (role) {
                case '1':
                    heading.innerText = 'Add User';
                    break;
                case '3':
                    heading.innerText = 'Add Gardener';
                    break;
                case '4':
                    heading.innerText = 'Add Caretaker';
                    break;
                case '5':
                    heading.innerText = 'Add Volunteer';
                    break;
                default:
                    heading.innerText = 'Add User';
            }
        }
    });
</script>
@endsection
