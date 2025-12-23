@extends('admin.layouts.master')

@section('title', 'Projects')

@section('content')
    <main class="content-page">
        <div class="content mt-4">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary mb-3">
                            Add Project
                        </a>

                        @if (session('success'))
                            <div class="alert alert-success fade show" id="autoHideSuccess">
                                {{ session('success') }}
                            </div>
                        @endif


                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Status</th>
                                    <th width="180">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $project->name }}</td>
                                        <td>{{ $project->description }}</td>
                                        <td>{{ $project->start_date }}</td>
                                        <td>{{ $project->end_date }}</td>
                                        <td>
                                            @if ($project->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.projects.edit', $project) }}"
                                                class="btn btn-warning btn-sm">Edit</a>

                                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                                                class="d-inline">
                                                @csrf @method('DELETE')
                                                <button onclick="return confirm('Are you sure?')"
                                                    class="btn btn-danger btn-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        setTimeout(function() {
            let successBox = document.getElementById('autoHideSuccess');
            if (successBox) {
                successBox.classList.remove('show');
                successBox.classList.add('fade');
                setTimeout(() => successBox.remove(), 500);
            }
        }, 3000);
    </script>


@endsection
