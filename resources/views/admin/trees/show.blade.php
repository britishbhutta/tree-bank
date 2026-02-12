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
                        <div class="col-12 mt-4 mb-4">
                            <a href="{{ route('trees.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>

                        {{-- <div class="row">
                            <!-- Left Table -->
                            <div class="col-md-5">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            1<th>Donated By</th>
                                            <td>{{ $tree->donations->first()->users->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            1<th>Donation In #</th>
                                            <td>{{ optional($tree->donations)->donation_number ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            1<th>Donated To</th>
                                            <td>{{ optional($tree->donationsOut?->users)->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            1<th>Donation Out #</th>
                                            <td>{{ optional($tree->donationsOut)->donation_number ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tree Type</th>
                                            1<td>
                                                <span class="editable"
                                                    data-field="tree_type">{{ $tree->treeTypes->name ?? 'N/A' }}</span>
                                                <input type="text" class="form-control d-none"
                                                    value="{{ $tree->treeTypes->name ?? '' }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            1<th>Tree Name</th>
                                            <td>
                                                <span class="editable"
                                                    data-field="tree_type">{{ $tree->treeName->name ?? 'N/A' }}</span>
                                                <input type="text" class="form-control d-none"
                                                    value="{{ $tree->treeTypes->name ?? '' }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Planted Status</th>
                                            1<td>
                                                <span class="editable-select"
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
                                            1<th>Planted By</th>
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
                                            1<td>
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
                                        1<tr>
                                            <th>Project</th>
                                            <td>{{ $tree->projects->first()->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            1<th>Tree Age</th>
                                            <td>
                                                <span class="editable" data-field="age">{{ $tree->age ?? 'N/A' }}</span>
                                                <input type="number" class="form-control d-none"
                                                    value="{{ $tree->age ?? '' }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            1<th>Bought Date</th>
                                            <td>
                                                <span class="editable"
                                                    data-field="bought_date">{{ $tree->bought_date ?? 'N/A' }}</span>
                                                <input type="date" class="form-control d-none"
                                                    value="{{ $tree->bought_date ?? '' }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            1<th>Location</th>
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
                                            1<td>
                                                <span class="editable"
                                                    data-field="planted_date">{{ $tree->planted_date ?? 'N/A' }}</span>
                                                <input type="date" class="form-control d-none"
                                                    value="{{ $tree->planted_date ?? '' }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            1<th>Last Visited</th>
                                            <td>
                                                <span class="editable"
                                                    data-field="last_visited_date">{{ $tree->last_visited_date ?? 'N/A' }}</span>
                                                <input type="date" class="form-control d-none"
                                                    value="{{ $tree->last_visited_date ?? '' }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Notes</th>
                                            1<td>
                                                <span class="editable"
                                                    data-field="notes">{{ $tree->notes ?? 'N/A' }}</span>
                                                <textarea class="form-control d-none">{{ $tree->notes ?? '' }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Purpose</th>
                                            1<td>
                                                <span class="editable"
                                                    data-field="purpose">{{ $tree->purpose ?? 'N/A' }}</span>
                                                <input type="text" class="form-control d-none"
                                                    value="{{ $tree->purpose ?? '' }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Visit(Required)</th>
                                            1<td>
                                                <span class="editable"
                                                    data-field="visit_req">{{ $tree->visit_req ?? 'N/A' }}</span>
                                                <input type="number" class="form-control d-none"
                                                    value="{{ $tree->visit_req ?? '' }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Health Condition</th>
                                            1<td>
                                                <span class="editable"
                                                    data-field="health_condition">{{ $tree->health_condition ?? 'N/A' }}</span>
                                                <input type="text" class="form-control d-none"
                                                    value="{{ $tree->health_condition ?? '' }}">
                                            </td>
                                        </tr>
                                        1<tr>
                                            <th>Death</th>
                                            <td>
                                                <span class="editable-select"
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
                                <a href="{{ route('trees.index') }}" class="btn btn-secondary">Back to List</a>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-6">
                                <div class="tree-section">
                                    <h5><i class="fa-solid fa-tree me-2"></i>Tree Information</h5>
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <th>Tree Id</th>
                                                <td class="text-end">
                                                    <span data-field="tree_type">{{ $tree->id ?? 'N/A' }}</span>
                                                    <input type="text" class="form-control d-none" value="{{ $tree->id ?? '' }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tree Name</th>
                                                <td class="text-end">
                                                    <span class="editable" data-field="tree_name">{{ $tree->treeName->name ?? 'N/A' }}</span>
                                                    <input type="text" class="form-control d-none" value="{{ $tree->treeName->name ?? '' }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tree Type</th>
                                                <td class="text-end">
                                                    <span class="editable" data-field="tree_type">{{ $tree->treeTypes->name ?? 'N/A' }}</span>
                                                    <input type="text" class="form-control d-none" value="{{ $tree->treeTypes->name ?? '' }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tree Age</th>
                                                <td class="text-end">
                                                    <span class="editable" data-field="age">{{ $tree->age ?? 'N/A' }}</span>
                                                    <input type="number" class="form-control d-none" value="{{ $tree->age ?? '' }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Health Condition</th>
                                                <td class="text-end">
                                                    <span class="editable" data-field="health_condition">{{ $tree->health_condition ?? 'N/A' }}</span>
                                                    <input type="text" class="form-control d-none" value="{{ $tree->health_condition ?? '' }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Bought Date</th>
                                                <td class="text-end">
                                                    <span class="editable"
                                                        data-field="bought_date">{{ $tree->bought_date ?? 'N/A' }}</span>
                                                    <input type="date" class="form-control d-none"
                                                        value="{{ $tree->bought_date ?? '' }}">
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <th>Purpose</th>
                                                <td class="text-end">
                                                    <span class="editable"
                                                        data-field="purpose">{{ $tree->purpose ?? 'N/A' }}</span>
                                                    <input type="text" class="form-control d-none"
                                                        value="{{ $tree->purpose ?? '' }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Death</th>
                                                <td class="text-end">
                                                    <span class="editable-select"
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
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="tree-section">
                                    <h5><i class="fa-solid fa-image me-2"></i>Visits, Notes & Photos</h5>

                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <th>Last Visited</th>
                                                <td class="text-end">
                                                    <span class="editable"
                                                        data-field="last_visited_date">{{ $tree->last_visited_date ?? 'N/A' }}</span>
                                                    <input type="date" class="form-control d-none"
                                                        value="{{ $tree->last_visited_date ?? '' }}">
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Visit (Required)</th>
                                                <td class="text-end">
                                                    <span class="editable"
                                                        data-field="visit_req">{{ $tree->visit_req ?? 'N/A' }}</span>
                                                    <input type="number" class="form-control d-none"
                                                        value="{{ $tree->visit_req ?? '' }}">
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Notes</th>
                                                <td class="text-end">
                                                    <span class="editable"
                                                        data-field="notes">{{ $tree->notes ?? 'N/A' }}</span>
                                                    <textarea class="form-control d-none">{{ $tree->notes ?? '' }}</textarea>
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
                                                    style="position:absolute; top:-5px; right:-5px; cursor:pointer; color:red;">
                                                    &times;
                                                </span>

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
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="tree-section">
                                    <h5><i class="fa-solid fa-hand-holding-heart me-2"></i>Donation & Project</h5>
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr><th>Donated By</th><td class="text-end">{{ $tree->donations->first()->users->name ?? 'N/A' }}</td></tr>
                                            <tr><th>Donation In #</th><td class="text-end">{{ optional($tree->donations)->donation_number ?? 'N/A' }}</td></tr>
                                            <tr><th>Donated To</th><td class="text-end">{{ optional($tree->donationsOut?->users)->name ?? 'N/A' }}</td></tr>
                                            <tr><th>Donation Out #</th><td class="text-end">{{ optional($tree->donationsOut)->donation_number ?? 'N/A' }}</td></tr>
                                            <tr><th>Project</th><td class="text-end">{{ $tree->projects->first()->name ?? 'N/A' }}</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="tree-section">
                                    <h5><i class="fa-solid fa-user-shield me-2"></i>Planting & Care</h5>
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <th>Planted Status</th>
                                                <td class="text-end">
                                                    <span class="editable-select" data-field="planting_status">
                                                        {{ $tree->planting_status ? 'Yes' : 'No' }}
                                                    </span>
                                                    <select class="form-control d-none">
                                                        <option value="1" {{ $tree->planting_status ? 'selected' : '' }}>Yes</option>
                                                        <option value="0" {{ !$tree->planting_status ? 'selected' : '' }}>No</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Planted By</th>
                                                <td class="text-end">
                                                    <span class="editable-select" data-field="user_id">{{ $tree->plantedBy->name ?? 'N/A' }}</span>
                                                    <select class="form-control d-none">...</select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Caretaker</th>
                                                <td class="text-end">
                                                    <span class="editable-select" data-field="user_id_ct">{{ $tree->CareTakenBy->name ?? 'N/A' }}</span>
                                                    <select class="form-control d-none">...</select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Planted Date</th>
                                                <td class="text-end">
                                                    <span class="editable" data-field="planted_date">{{ $tree->planted_date ?? 'N/A' }}</span>
                                                    <input type="date" class="form-control d-none" value="{{ $tree->planted_date ?? '' }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td class="text-end">
                                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                                        <span class="editable"
                                                            data-field="location">{{ $tree->location ?? 'N/A' }}</span>

                                                        <input type="text" class="form-control d-none location-input"
                                                            style="max-width:220px"
                                                            value="{{ $tree->location ?? '' }}">

                                                        <button type="button" class="btn btn-info btn-sm get-location-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to use your location">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <a href="{{ route('trees.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.isAdminLoggedIn = {{ auth('admin')->check() ? 'true' : 'false' }};
            if(window.isAdminLoggedIn){
                var path = `/admin`;
                }else{
                var path = `/my`;
                }
            const locationSpan = document.querySelector('.editable[data-field="location"]');
            const locationInput = document.querySelector('.location-input');

            if (locationSpan && locationInput && locationInput.value) {
                const coords = locationInput.value.split(',');
                const lat = coords[0];
                const lng = coords[1];

                fetch(`${path}/reverse-geocode?lat=${lat}&lng=${lng}`)
                    .then(res => res.json())
                    .then(data => {
                        if (!data.address) return;

                        const locationName = [
                            data.address.neighbourhood ||
                            data.address.suburb ||
                            data.address.quarter ||
                            data.address.village ||
                            data.address.town,
                            data.address.city,

                            data.address.state,
                            data.address.country
                        ].filter(Boolean).join(', ');

                        locationSpan.textContent = locationName;
                    });
            }
            

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
                    fetch(`${path}/trees/{{ $tree->id }}`, {
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
                    fetch(`${path}/trees/{{ $tree->id }}`, {
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
                        fetch(`${path}/trees/{{ $tree->id }}`, {
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
                    
                    fetch(`${path}/photos/` + id, {
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

                    fetch('{{ route('trees.uploadPhotos', $tree->id) }}', {
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
            // Get Device Location → Save coordinates → Show location name
            document.querySelectorAll('.get-location-btn').forEach(btn => {
                btn.addEventListener('click', function () {

                    if (!navigator.geolocation) {
                        alert('Geolocation not supported');
                        return;
                    }

                    navigator.geolocation.getCurrentPosition(async position => {

                        const lat = position.coords.latitude.toFixed(6);
                        const lng = position.coords.longitude.toFixed(6);
                        const coordinates = `${lat},${lng}`;

                        const td = btn.closest('td');
                        const span = td.querySelector('.editable');
                        const input = td.querySelector('.location-input');

                        span.textContent = 'Fetching location...';

                        try {
                             const geoRes = await fetch(
                                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&accept-language=en`
                            );
                            const geoData = await geoRes.json();

                            if (!geoData.address) return;

                            const address = geoData.address;

                            const locationName = [
                                address.road,
                                address.neighbourhood ||
                                address.suburb ||
                                address.quarter,

                                address.city ||
                                address.town ||
                                address.village,

                                address.state,
                                address.country
                            ]
                            .filter(Boolean)
                            .join(', ');

                            span.textContent = locationName;
                            input.value = locationName;

                            fetch(`${path}/trees/{{ $tree->id }}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    location: coordinates
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                alertBox.textContent =
                                    data.message || 'Location saved successfully!';
                                alertBox.classList.remove('d-none');
                                setTimeout(() => alertBox.classList.add('d-none'), 2000);
                            });

                        } catch (err) {
                            alert('Failed to fetch location name');
                            span.textContent = coordinates;
                        }

                    }, () => {
                        alert('Please allow location access');
                    });
                });
            });

        });


    </script>

    <style>
        .tree-section {
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 20px;
            background: #fff;
        }
        .tree-section h5 {
            font-weight: 600;
            margin-bottom: 14px;
            color: #2c3e50;
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 8px;
        }
        .tree-section table th {
            width: 40%;
            color: #555;
        }
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
