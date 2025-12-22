@extends('admin.layouts.master')

@section('title','Edit Project')

@section('content')
<main class="content-page">
    <div class="content mt-4">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">

                    {{-- Page Heading --}}
                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                        <h4 class="mb-0 fw-bold">
                            Edit Project
                        </h4>
                    </div>

                    <form method="POST" action="{{ route('admin.projects.update', $project) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Project Name</label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name', $project->name) }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description"
                                      class="form-control"
                                      rows="3">{{ old('description', $project->description) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Start Date</label>
                                <input type="date"
                                       name="start_date"
                                       class="form-control"
                                       value="{{ old('start_date', $project->start_date) }}"
                                       required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">End Date</label>
                                <input type="date"
                                       name="end_date"
                                       class="form-control"
                                       value="{{ old('end_date', $project->end_date) }}"
                                       required>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">
                                Update Project
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</main>
@endsection
