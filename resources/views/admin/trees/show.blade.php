@extends('admin.layouts.master')
@section('title', 'Tree Details')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer">

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

                        <div id="alert-success" class="alert alert-success d-none"></div>
                        <div class="info-box mb-3">
                            <i class="fa-solid fa-circle-info"></i>
                            <span>Click a field to edit, then update your information.</span>
                        </div>


                        <div class="row">
                            <!-- Left Table -->
                            <div class="col-md-5">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <th>Donated By</th>
                                            <td>{{ $tree->donations->first()->users->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Donation In #</th>
                                            <td>{{ optional($tree->donations)->donation_number ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Donated To</th>
                                            <td>{{ optional($tree->donations->first())->users->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Donation Out #</th>
                                            <td>{{ optional($tree->donationsOut)->donation_number ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tree Type</th>
                                            <td>
                                                <span class="editable"
                                                    data-field="tree_type">{{ $tree->treeTypes->name ?? 'N/A' }}</span>
                                                <input type="text" class="form-control d-none"
                                                    value="{{ $tree->treeTypes->name ?? '' }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Planted Status</th>
                                            <td>
                                                <span class="editable"
                                                    data-field="planting_status">{{ $tree->planting_status ? 'Yes' : 'No' }}</span>
                                                <select class="form-control d-none">
                                                    <option value="1" {{ $tree->planting_status ? 'selected' : '' }}>
                                                        Yes</option>
                                                    <option value="0" {{ !$tree->planting_status ? 'selected' : '' }}>
                                                        No</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Planted By</th>
                                            <td>
                                                <span class="editable-select"
                                                    data-field="user_id">{{ $tree->plantedBy->name ?? 'N/A' }}</span>
                                                <select class="form-control d-none">
                                                    <option value="">Select Gardener</option>
                                                    @foreach ($gardner as $g)
                                                        <option value="{{ $g->id }}"
                                                            {{ isset($tree->plantedBy) && $tree->plantedBy->id == $g->id ? 'selected' : '' }}>
                                                            {{ $g->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Caretaker</th>
                                            <td>
                                                <span class="editable-select"
                                                    data-field="user_id_ct">{{ $tree->CareTakenBy->name ?? 'N/A' }}</span>
                                                <select class="form-control d-none">
                                                    <option value="">Select Caretaker</option>
                                                    @foreach ($caretaker as $c)
                                                        <option value="{{ $c->id }}"
                                                            {{ isset($tree->CareTakenBy) && $tree->CareTakenBy->id == $c->id ? 'selected' : '' }}>
                                                            {{ $c->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Project</th>
                                            <td>{{ $tree->projects->first()->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tree Age</th>
                                            <td>
                                                <span class="editable" data-field="age">{{ $tree->age ?? 'N/A' }}</span>
                                                <input type="number" class="form-control d-none"
                                                    value="{{ $tree->age ?? '' }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Bought Date</th>
                                            <td>
                                                <span class="editable"
                                                    data-field="bought_date">{{ $tree->bought_date ?? 'N/A' }}</span>
                                                <input type="date" class="form-control d-none"
                                                    value="{{ $tree->bought_date ?? '' }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Location</th>
                                            <td>
                                                <span class="editable"
                                                    data-field="location">{{ $tree->location ?? 'N/A' }}</span>
                                                <input type="text" class="form-control d-none"
                                                    value="{{ $tree->location ?? '' }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

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
                                                <span class="editable"
                                                    data-field="planted_date">{{ $tree->planted_date ?? 'N/A' }}</span>
                                                <input type="date" class="form-control d-none"
                                                    value="{{ $tree->planted_date ?? '' }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Last Visited</th>
                                            <td>
                                                <span class="editable"
                                                    data-field="last_visited_date">{{ $tree->last_visited_date ?? 'N/A' }}</span>
                                                <input type="date" class="form-control d-none"
                                                    value="{{ $tree->last_visited_date ?? '' }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Notes</th>
                                            <td>
                                                <span class="editable"
                                                    data-field="notes">{{ $tree->notes ?? 'N/A' }}</span>
                                                <textarea class="form-control d-none">{{ $tree->notes ?? '' }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Purpose</th>
                                            <td>
                                                <span class="editable"
                                                    data-field="purpose">{{ $tree->purpose ?? 'N/A' }}</span>
                                                <input type="text" class="form-control d-none"
                                                    value="{{ $tree->purpose ?? '' }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Visit(Required)</th>
                                            <td>
                                                <span class="editable"
                                                    data-field="visit_req">{{ $tree->visit_req ?? 'N/A' }}</span>
                                                <input type="number" class="form-control d-none"
                                                    value="{{ $tree->visit_req ?? '' }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Health Condition</th>
                                            <td>
                                                <span class="editable"
                                                    data-field="health_condition">{{ $tree->health_condition ?? 'N/A' }}</span>
                                                <input type="text" class="form-control d-none"
                                                    value="{{ $tree->health_condition ?? '' }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Death</th>
                                            <td>
                                                <span class="editable"
                                                    data-field="death">{{ $tree->death ? 'Yes' : 'No' }}</span>
                                                <select class="form-control d-none">
                                                    <option value="1" {{ $tree->death ? 'selected' : '' }}>Yes
                                                    </option>
                                                    <option value="0" {{ !$tree->death ? 'selected' : '' }}>No
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- Existing Photos -->
                                <div class="mt-3" id="photos-list" style="display:flex; flex-wrap:wrap; gap:5px;">
                                    @foreach ($tree->photos as $photo)
                                        <div class="photo-thumb" data-id="{{ $photo->id }}" style="position:relative;">
                                            <img src="{{ asset('storage/' . $photo->photo_path) }}"
                                                style="width:70px; height:70px; object-fit:cover; cursor:pointer;"
                                                title="Click to replace">
                                            <span class="delete-photo" data-id="{{ $photo->id }}"
                                                style="position:absolute; top:-5px; right:-5px; cursor:pointer; color:red;">&times;</span>
                                            <input type="file" class="d-none replace-photo-input" accept="image/*" />
                                        </div>
                                    @endforeach
                                </div>

                                <!-- New Photo Upload -->
                                <div class="mt-3">
                                    <label class="form-label fw-bold">Upload New Photo(s)</label>
                                    <input type="file" id="new-photos" name="new_photos[]" multiple accept="image/*"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <a href="{{ route('admin.trees.index') }}" class="btn btn-secondary">Back to List</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const alertBox = document.getElementById('alert-success');

            // Editable Fields
            document.querySelectorAll('.editable').forEach(span => {
                const input = span.nextElementSibling;
                let oldValue = '';
                span.addEventListener('click', function() {
                    oldValue = span.textContent.trim();
                    input.value = oldValue === 'N/A' ? '' : oldValue;
                    span.classList.add('d-none');
                    input.classList.remove('d-none');
                    input.focus();
                });
                const saveField = () => {
                    const newValue = input.value.trim();
                    const field = span.dataset.field;
                    if (newValue === '' || newValue === oldValue) {
                        input.classList.add('d-none');
                        span.classList.remove('d-none');
                        return;
                    }
                    fetch('/admin/trees/{{ $tree->id }}', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            [field]: newValue
                        })
                    }).then(res => res.json()).then(data => {
                        span.textContent = newValue;
                        alertBox.textContent = data.message ||
                            'Tree details updated successfully!';
                        alertBox.classList.remove('d-none');
                        setTimeout(() => alertBox.classList.add('d-none'), 2000);
                    });
                    input.classList.add('d-none');
                    span.classList.remove('d-none');
                };
                input.addEventListener('blur', saveField);
                input.addEventListener('keydown', e => {
                    if (e.key === 'Enter') saveField();
                    if (e.key === 'Escape') {
                        input.classList.add('d-none');
                        span.classList.remove('d-none');
                        span.textContent = oldValue;
                    }
                });
            });

            // Editable Select Fields
            document.querySelectorAll('.editable-select').forEach(span => {
                const select = span.nextElementSibling;
                let oldValue = '';
                span.addEventListener('click', function() {
                    oldValue = select.value;
                    span.classList.add('d-none');
                    select.classList.remove('d-none');
                    select.focus();
                });
                select.addEventListener('change', function() {
                    const newValue = this.value;
                    const field = span.dataset.field;
                    if (newValue === '' || newValue === oldValue) {
                        select.classList.add('d-none');
                        span.classList.remove('d-none');
                        return;
                    }
                    fetch('/admin/trees/{{ $tree->id }}', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            [field]: newValue
                        })
                    }).then(res => res.json()).then(data => {
                        span.textContent = this.options[this.selectedIndex].text;
                        alertBox.textContent = data.message ||
                            'Tree details updated successfully!';
                        alertBox.classList.remove('d-none');
                        setTimeout(() => alertBox.classList.add('d-none'), 2000);
                    });
                    select.classList.add('d-none');
                    span.classList.remove('d-none');
                });
                select.addEventListener('blur', function() {
                    select.classList.add('d-none');
                    span.classList.remove('d-none');
                });
            });

            // Existing Photo Replacement
            document.querySelectorAll('.photo-thumb img').forEach(img => {
                img.addEventListener('click', function() {
                    const container = this.parentElement;
                    const input = container.querySelector('.replace-photo-input');
                    input.click();
                    input.addEventListener('change', function() {
                        if (this.files.length === 0) return;
                        const formData = new FormData();
                        formData.append('photos[]', this.files[0]);
                        formData.append('photo_id', container.dataset.id);
                        formData.append('_token', '{{ csrf_token() }}');
                        fetch('/admin/trees/{{ $tree->id }}', {
                                method: 'POST',
                                body: formData
                            })
                            .then(res => res.json()).then(data => {
                                if (data.status === 'success') {
                                    alertBox.textContent = data.message;
                                    alertBox.classList.remove('d-none');
                                    setTimeout(() => alertBox.classList.add('d-none'),
                                        2000);
                                    location.reload();
                                }
                            });
                    }, {
                        once: true
                    });
                });
            });

            // Delete Photo
            document.querySelectorAll('.delete-photo').forEach(span => {
                span.addEventListener('click', function() {
                    const id = this.dataset.id;
                    if (!confirm('Are you sure you want to delete this photo?')) return;
                    fetch('/admin/photos/' + id, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(res => res.json()).then(data => {
                        if (data.status === 'success') {
                            alertBox.textContent = data.message;
                            alertBox.classList.remove('d-none');
                            setTimeout(() => alertBox.classList.add('d-none'), 2000);
                            span.parentElement.remove();
                        }
                    });
                });
            });

            // Upload New Photos
            const newPhotosInput = document.getElementById('new-photos');
            if (newPhotosInput) {
                newPhotosInput.addEventListener('change', function() {
                    if (this.files.length === 0) return;
                    const formData = new FormData();
                    for (let i = 0; i < this.files.length; i++) {
                        formData.append('photos[]', this.files[i]);
                    }
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch('{{ route('admin.trees.uploadPhotos', $tree->id) }}', {
                            method: 'POST',
                            body: formData
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'success') {
                                alertBox.textContent = data.message;
                                alertBox.classList.remove('d-none');
                                setTimeout(() => alertBox.classList.add('d-none'), 2000);
                                location.reload();
                            }
                        });
                });
            }

        });
    </script>

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
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.45);
        }

        .tree-divider {
            width: 2px;
            background-color: #e5e5e5;
            min-height: 100%;
        }

       .info-box {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 12px 14px;
        background: #f0f6ff;    
        border-left: 4px solid #04b132;
        border-radius: 6px;
        font-size: 14px;
        color: #333;
        }

        .info-box i {
        color: #04b132;
        font-size: 18px;
        margin-top: 2px;
        }
    </style>

@endsection
