@extends('admin.layouts.master')
@section('title', 'Workshops List')

@section('content')
    <main class="content-page">
        <div class="content mt-4">
            <div class="container-fluid">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" id="flash-message">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" id="flash-message">
                        {{ session('error') }}
                    </div>
                @endif


                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold">Workshops</h4>
                    <a href="{{ route('admin.workshop.create') }}" class="btn btn-primary">Add Workshop</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Project</th>
                                <th class="text-nowrap">Organized By</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                {{-- <th>Images</th> --}}
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($workshops as $workshop)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $workshop->projects->name }}</td>
                                    <td>{{ $workshop->users->name }}</td>
                                    <td>{{ $workshop->name }}</td>
                                    <td>{{ $workshop->location }}</td>
                                    <td class="text-nowrap">
                                        {{ \Carbon\Carbon::parse($workshop->start_date)->format('d M Y, h:i A') }}
                                    </td>
                                    <td class="text-nowrap">
                                        {{ \Carbon\Carbon::parse($workshop->end_date)->format('d M Y, h:i A') }}
                                    </td>
                                    {{-- <td class="text-nowrap">
                                            @if ($workshop->photos->count() > 0)
                                                @foreach ($workshop->photos as $photo)
                                                    <img src="{{ asset('storage/'.$photo->photo_path) }}" width="50" height="50"
                                                        class="me-1 mb-1" style="object-fit:cover; border-radius:5px;">
                                                @endforeach
                                            @else
                                                <span class="text-muted">No images</span>
                                            @endif
                                        </td> --}}
                                    <td class="text-nowrap">
                                        <a href="{{ route('admin.workshop.edit', $workshop->id) }}"
                                            class="btn btn-sm btn-warning">View / Edit</a>
                                        <form action="{{ route('admin.workshop.destroy', $workshop->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No workshops found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $workshops->links() }}
                </div>

            </div>
        </div>
    </main>
    <script>
        setTimeout(() => {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.style.transition = "opacity 0.5s ease";
                flash.style.opacity = 0;
                setTimeout(() => flash.remove(), 500);
            }
        }, 3000);
    </script>

@endsection
