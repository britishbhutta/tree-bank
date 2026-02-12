@extends('admin.layouts.master')

@section('title', 'Trees')

@section('content')
<style>
    .or-text {
        margin-top: 6px;       /* align with select height */
        font-weight: 600;
        color: #6c757d;
        white-space: nowrap;  /* prevents wrapping */
    }
</style>
    <main class="content-page">
        <div class="content mt-4">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="fw-bold">Trees List</h4>
                        </div>

                        <form id="searchForm" class="row g-2 mb-4">
                            @if(auth('admin')->check())
                                <div class="col-md-3">
                            @else
                                <div class="col-md-4">
                            @endif
                                <input type="text" name="tree_id" id="tree_id" class="form-control"
                                    placeholder="Search by Tree ID">
                            </div>

                            @if(auth('admin')->check())
                                <div class="col-md-3">
                            @else
                                <div class="col-md-4">
                            @endif
                                <select name="project_id" id="project_id" class="form-control">
                                    <option value="">-- Select Project --</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @if(auth('admin')->check())
                                <div class="col-md-3">
                            @else
                                <div class="col-md-4">
                            @endif
                                <select name="death" id="death" class="form-control">
                                    <option value="">-- Death Status --</option>
                                    <option value="1">Dead</option>
                                    <option value="0">Alive</option>
                                </select>
                            </div>
                            @if(auth('admin')->check())
                                <div class="col-md-3">
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option value="">-- Select Donor --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <div class="w-100"></div>
                            @endif
                            <div class="d-flex align-items-center gap-4">
                                <select name="donation_id" id="donation_id" class="form-control donation-select">
                                    <option value="">-- Select Donation In --</option>
                                    @foreach ($donationsIn as $donation)
                                        <option value="{{ $donation->id }}">
                                            {{ $donation->donation_number }}
                                        </option>
                                    @endforeach
                                </select>
                            <span class="or-text">OR</span>
                                <select name="donation_id_out" id="donation_id_out" class="form-control donation-select">
                                    <option value="">-- Select Donation Out --</option>
                                    @foreach ($donationsOut as $donation)
                                        <option value="{{ $donation->id }}">
                                            {{ $donation->donation_number }}
                                        </option>
                                    @endforeach
                                </select>
                            <span class="or-text">OR</span>
                                <select name="donation_id_own" id="donation_id_own" class="form-control donation-select">
                                    <option value="">-- Select Donation Own --</option>
                                    @foreach ($donationsOwn as $donation)
                                        <option value="{{ $donation->id }}">
                                            {{ $donation->donation_number }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="button"
                                    class="btn btn-outline-primary"
                                    title="Reset Search"
                                    onclick="window.location.reload();">
                                    <i class="fa fa-rotate-right"></i>
                                </button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tree ID</th>
                                        <th>Tree Type</th>
                                        <th>Tree Name</th>
                                        <th>Project</th>
                                        <th>Planted</th>
                                        <th>Death</th>
                                        <th width="120">Action</th>
                                    </tr>
                                </thead>

                                <tbody id="treeTable">
                                    @include('admin.trees.partials.table')
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            function getSelectedDonation() {
                let donationId = '';
                $('.donation-select').each(function () {
                    if ($(this).val()) {
                        donationId = $(this).val();
                    }
                });
                return donationId;
            }
            $('.donation-select').on('change', function () {
                // reset other selects
                $('.donation-select').not(this).val('');

                fetchTrees();
            });
            function fetchTrees() {
                $.ajax({
                    url: "{{ route('trees.index') }}",
                    type: "GET",
                    data: {
                        tree_id: $('#tree_id').val(),
                        project_id: $('#project_id').val(),
                        death: $('#death').val(),
                        user_id: $('#user_id').val(),
                        donation_id: getSelectedDonation()
                    },
                    beforeSend: function() {
                        $('#treeTable').html(`
                    <tr>
                        <td colspan="7" class="text-center">
                            Loading...
                        </td>
                    </tr>
                `);
                    },
                    success: function(response) {
                        $('#treeTable').html(response);
                    },
                    error: function() {
                        alert('Something went wrong!');
                    }
                });
            }

            $('#tree_id').on('keyup', fetchTrees);
            $('#project_id, #death, #user_id').on('change', fetchTrees);
        });
    </script>
@endpush
