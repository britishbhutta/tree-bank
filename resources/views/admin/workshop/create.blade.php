@extends('admin.layouts.master')
@section('title', 'Add Workshop')

@section('content')
    <main class="content-page">
        <div class="content mt-4">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">

                        <h4 class="fw-bold mb-4 border-bottom pb-2">Add Workshop</h4>

                        <form method="POST" action="{{ route('admin.workshop.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Project</label>
                                    <select name="project_id" class="form-control" required>
                                        <option value="">Select Project</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Organized By</label>
                                    <select name="user_id" class="form-control" required>
                                        <option value="">Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Workshop Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Location</label>
                                    <input type="text" name="location" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Start Date & Time</label>
                                    <input type="datetime-local" name="start_date" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">End Date & Time</label>
                                    <input type="datetime-local" name="end_date" class="form-control" required>
                                </div>
                            </div>


                            <div class="mb-3">
                                <label class="form-label fw-semibold">Description</label>
                                <textarea name="description" class="form-control" rows="2"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Images</label>
                                <input type="file" name="images[]" class="form-control" multiple id="imagesInput">
                            </div>

                            <div class="d-flex flex-wrap mb-4" id="imagesPreview"></div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success px-4">
                                    Save Workshop
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        #imagesPreview img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            margin-right: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
    </style>

    <script>
        const imagesInput = document.getElementById('imagesInput');
        const imagesPreview = document.getElementById('imagesPreview');

        imagesInput.addEventListener('change', function() {
            imagesPreview.innerHTML = '';
            const files = Array.from(this.files);
            files.slice(0, 7).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    imagesPreview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection
