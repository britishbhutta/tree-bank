@extends('admin.layouts.master')
@section('title', 'Tree Names Listing')

@section('content')
    <main class="content-page">
        <div class="content mt-4">
            <div class="container-fluid">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="fw-bold mb-4 border-bottom pb-2">Tree Names Listing</h4>

                        {{-- Success message --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        {{-- Error message --}}
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- Add New Tree Name button --}}
                        <a href="{{ route('admin.tree_names.add') }}" class="btn btn-primary mb-3">Add New Tree Name</a>

                        <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                            <table class="table table-bordered table-striped table-hover align-middle mb-0">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Tree Type</th>
                                        <th>Tree Name</th>
                                        <th>Description</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($treeNames as $treeName)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $treeName->treeType->name ?? '-' }}</td>
                                            <td>{{ $treeName->name }}</td>
                                            <td>{{ $treeName->description ?? '-' }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">

                                                    <a href="{{ route('admin.tree_names.edit', $treeName->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        Edit
                                                    </a>

                                                    <form action="{{ route('admin.tree_names.delete', $treeName->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this tree name?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>

                                                </div>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">No Tree Names Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script>
            setTimeout(function() {
                let alert = document.getElementById('success-alert');
                if (alert) {
                    let bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 3000);
        </script>
    </main>
@endsection
