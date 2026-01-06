@extends('admin.layouts.master')
@section('title', 'Add Tree Name')

@section('content')
    <main class="content-page">
        <div class="content mt-4">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <h4 class="fw-bold mb-4 border-bottom pb-2">Add Tree Name</h4>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form method="POST" action="{{ route('admin.tree_names.save') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="tree_type_id" class="form-label">Tree Type</label>
                                <select name="tree_type_id" id="tree_type_id" class="form-control" required>
                                    <option value="">-- Select Tree Type --</option>
                                    @foreach ($treeTypes as $type)
                                        <option value="{{ $type->id }}"
                                            {{ old('tree_type_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Tree Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('admin.tree_names_index') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
