@extends('admin.layouts.master')
@section('title', 'Tree Types Listing')

@section('content')
<main class="content-page">
    <div class="content mt-4">
        <div class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="fw-bold mb-4 border-bottom pb-2">Tree Types Listing</h4>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <a href="{{ route('admin.tree_types.create') }}" class="btn btn-primary mb-3">Add New Tree Type</a>

                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                        <table class="table table-bordered table-striped table-hover align-middle mb-0">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($treeTypes as $treeType)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-wrap">{{ $treeType->name }}</td>
                                        <td class="text-wrap">{{ $treeType->description }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('admin.tree_types.edit', $treeType->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="{{ route('admin.tree_types.delete', $treeType->id) }}" 
                                                   class="btn btn-sm btn-danger"
                                                   onclick="return confirm('Are you sure you want to delete this tree type?')">
                                                   Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No Tree Types Found</td>
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
            if(alert){
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 3000);
    </script>
</main>
@endsection
