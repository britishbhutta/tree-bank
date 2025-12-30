@extends('admin.layouts.master')
@section('title', 'Tree Details')

@section('content')
<main class="content-page">
    <div class="content mt-4">
        <div class="container-fluid">

            <div class="card border-0 shadow-sm">

                <!-- Header -->
                <div class="tree-header position-relative">
                    <img src="{{ asset('admin/assets/images/tree.jpg') }}" alt="Tree Banner"
                        class="img-fluid rounded-top tree-header-img">
                    <div class="tree-header-content">
                        <h4 class="fw-bold mb-1 text-white">Manage Tree Details</h4>
                    </div>
                </div>

                <div class="card-body pt-3">

                    <!-- Success Alert -->
                    <div id="alert-success" class="alert alert-success d-none"></div>

                    <div class="row">
                        <!-- Left Table -->
                        <div class="col-md-5">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <th>Donated By</th>
                                        <td>{{ $tree->donations->users->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Donated To</th>
                                        <td>{{ $tree->donationsOut->users->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tree Type</th>
                                        <td>
                                            <span class="editable" data-field="tree_type">{{ $tree->treeTypes->name ?? 'N/A' }}</span>
                                            <input type="text" class="form-control d-none" value="{{ $tree->treeTypes->name ?? '' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Planted Status</th>
                                        <td>
                                            <span class="editable" data-field="planting_status">{{ $tree->planting_status ? 'Yes' : 'No' }}</span>
                                            <select class="form-control d-none">
                                                <option value="1" {{ $tree->planting_status ? 'selected' : '' }}>Yes</option>
                                                <option value="0" {{ !$tree->planting_status ? 'selected' : '' }}>No</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Planted By</th>
                                        <td>{{ $tree->plantedBy->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Caretaker</th>
                                        <td>{{ $tree->CareTakenBy->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Project</th>
                                        <td>{{ $tree->projects->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tree Age</th>
                                        <td>
                                            <span class="editable" data-field="age">{{ $tree->age ?? 'N/A' }}</span>
                                            <input type="number" class="form-control d-none" value="{{ $tree->age ?? '' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Bought Date</th>
                                        <td>
                                            <span class="editable" data-field="bought_date">{{ $tree->bought_date ?? 'N/A' }}</span>
                                            <input type="date" class="form-control d-none" value="{{ $tree->bought_date ?? '' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Location</th>
                                        <td>
                                            <span class="editable" data-field="location">{{ $tree->location ?? 'N/A' }}</span>
                                            <input type="text" class="form-control d-none" value="{{ $tree->location ?? '' }}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Vertical Divider -->
                        <div class="col-md-2 d-flex justify-content-center">
                            <div class="tree-divider"></div>
                        </div>

                        <!-- Right Table -->
                        <div class="col-md-5">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <th>Planted Date</th>
                                        <td>
                                            <span class="editable" data-field="planted_date">{{ $tree->planted_date ?? 'N/A' }}</span>
                                            <input type="date" class="form-control d-none" value="{{ $tree->planted_date ?? '' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Last Visited</th>
                                        <td>
                                            <span class="editable" data-field="last_visited_date">{{ $tree->last_visited_date ?? 'N/A' }}</span>
                                            <input type="date" class="form-control d-none" value="{{ $tree->last_visited_date ?? '' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Notes</th>
                                        <td>
                                            <span class="editable" data-field="notes">{{ $tree->notes ?? 'N/A' }}</span>
                                            <textarea class="form-control d-none">{{ $tree->notes ?? '' }}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Purpose</th>
                                        <td>
                                            <span class="editable" data-field="purpose">{{ $tree->purpose ?? 'N/A' }}</span>
                                            <input type="text" class="form-control d-none" value="{{ $tree->purpose ?? '' }}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Back Button -->
                        <div class="col-12 mt-4">
                            <a href="{{ route('admin.trees.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
</main>

<style>
.tree-header {
    position: relative;
    height: 120px;
    overflow: hidden;
    border-radius: 10px 10px 0 0;
}

.tree-header-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.tree-header-content {
    position: absolute;
    top: 20px;
    left: 25px;
    z-index: 2;
}

.tree-header-content h4 {
    text-shadow: 0 2px 6px rgba(0,0,0,0.45);
}

.tree-divider {
    width: 2px;
    background-color: #e5e5e5;
    min-height: 100%;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.editable').forEach(span => {
        span.addEventListener('click', function() {
            const input = this.nextElementSibling;
            this.classList.add('d-none');
            input.classList.remove('d-none');
            input.focus();
        });

        const input = span.nextElementSibling;

        const saveField = () => {
            const value = input.value;
            const field = span.dataset.field;

            fetch('/admin/trees/{{ $tree->id }}', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ [field]: value })
            })
            .then(res => res.json())
            .then(data => {
                span.textContent = value;
                const alert = document.getElementById('alert-success');
                alert.textContent = data.message || 'Tree details updated successfully!';
                alert.classList.remove('d-none');
                setTimeout(() => alert.classList.add('d-none'), 2000);
            });

            input.classList.add('d-none');
            span.classList.remove('d-none');
        }

        input.addEventListener('blur', saveField);
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') saveField();
        });
    });
});
</script>
@endsection
