@extends('admin.layouts.master')

@section('title', 'Trees')

@section('content')
    <main class="content-page">
        <div class="content mt-4">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="fw-bold">Trees List</h4>
                        </div>

                        <form id="searchForm" class="row g-2 mb-4">
                            <div class="col-md-3">
                                <input type="text" name="tree_id" id="tree_id" class="form-control"
                                    placeholder="Search by Tree ID">
                            </div>

                            <div class="col-md-4">
                                <select name="project_id" id="project_id" class="form-control">
                                    <option value="">-- Select Project --</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tree ID</th>
                                        <th>Tree Type</th>
                                        <th>Project</th>
                                        <th>Planted</th>
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

            function fetchTrees() {
                $.ajax({
                    url: "{{ route('admin.trees.index') }}",
                    type: "GET",
                    data: {
                        tree_id: $('#tree_id').val(),
                        project_id: $('#project_id').val()
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
            $('#project_id').on('change', fetchTrees);

        });
    </script>
@endpush
