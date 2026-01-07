@extends('admin.layouts.master')

@section('title', 'Contact Messages')

@section('content')
<main class="content-page">
    <div class="content mt-4">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">

                    <h4 class="mb-3">Contact</h4>

                    @if (session('success'))
                        <div class="alert alert-success fade show" id="autoHideSuccess">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contacts as $contact)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $contact->user_id ?? 'Guest' }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->subject }}</td>
                                    <td>{{ Str::limit($contact->message, 50) }}</td>
                                    <td>
                                        <form action="{{ route('admin.contact.destroy', $contact->id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')"
                                                class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No messages found</td>
                                </tr>
                            @endforelse
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
