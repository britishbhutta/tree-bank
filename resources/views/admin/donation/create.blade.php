@extends('admin.layouts.master')
@section('title', 'Add Donation')

@section('content')
    <main class="content-page">
        <div class="content mt-4">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">

                        <h4 class="fw-bold mb-4 border-bottom pb-2">Add Donation</h4>

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

                        <form method="POST" action="{{ route('admin.donation.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Donation Number</label>
                                    <input type="text" class="form-control" value="{{ $donationNumber }}" readonly>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Donor</label>
                                    <select name="user_id" class="form-control">
                                        <option value="">Select Donor</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Project</label>
                                    <select name="project_id" id="project_id" class="form-control">
                                        <option value="">Select Project</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}"
                                                {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                                {{ $project->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Workshop</label>
                                    <select name="ws_id" id="ws_id" class="form-control" disabled>
                                        <option value="">Select Workshop</option>
                                        @foreach ($workshops as $workshop)
                                            <option value="{{ $workshop->id }}" data-project="{{ $workshop->project_id }}"
                                                {{ old('ws_id') == $workshop->id ? 'selected' : '' }}>
                                                {{ $workshop->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Type</label>
                                    <select id="type" name="type" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Trees" {{ old('type') == 'Trees' ? 'selected' : '' }}>Trees
                                        </option>
                                        <option value="Funds" {{ old('type') == 'Funds' ? 'selected' : '' }}>Funds
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Fund Type</label>
                                    <select id="fund_type" name="fund_type" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Cheque">Cheque</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Flow</label>
                                    <select id="flow" name="flow" class="form-control">
                                        <option value="">Select</option>
                                        <option value="In">In</option>
                                        <option value="Out">Out</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Amount</label>
                                    <input type="number" name="amount" class="form-control">
                                </div>
                            </div>

                            {{-- TREE SECTION --}}
                            <div id="tree-section" style="display:none">
                                <hr>
                                <div class="row mb-4" id="available-tree-cards"></div>

                                <button type="button" class="btn btn-success btn-sm mb-3" id="add-tree-row">
                                    + Add Tree Type
                                </button>

                                <div id="tree-rows"></div>
                            </div>

                            <button class="btn btn-primary mt-3">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>

   <style>
.available-wrapper {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 20px;
}

.available-wrapper h5 {
    font-weight: 700;
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
}

.tree-type-card {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 15px;
    height: 100%;
}

.type-title {
    font-weight: 600;
    margin-bottom: 10px;
    color: #198754;
}

.tree-item {
    display: flex;
    justify-content: space-between;
    padding: 6px 0;
    font-size: 14px;
    border-bottom: 1px dashed #ddd;
}

.tree-item:last-child {
    border-bottom: none;
}

.tree-item strong {
    color: black;
}
</style>

    <script>
        const typeSelect = document.getElementById('type');
        const fundTypeSelect = document.getElementById('fund_type');
        const flowSelect = document.getElementById('flow');
        const projectSelect = document.getElementById('project_id');
        const wsSelect = document.getElementById('ws_id');
        const treeSection = document.getElementById('tree-section');
        const treeRows = document.getElementById('tree-rows');
        const addTreeBtn = document.getElementById('add-tree-row');
        const cardsContainer = document.getElementById('available-tree-cards');
        const amountInput = document.querySelector('input[name="amount"]');
        const amountLabel = amountInput.previousElementSibling;

        projectSelect.addEventListener('change', () => {
            wsSelect.disabled = !projectSelect.value;

            [...wsSelect.options].forEach(opt => {
                if (!opt.value) return;
                opt.style.display =
                    opt.dataset.project == projectSelect.value ? 'block' : 'none';
            });
            handleFlowChange();
        });

        function handleTypeChange() {
            if (typeSelect.value === 'Trees') {
                treeSection.style.display = 'block';
                fundTypeSelect.disabled = true;
                fundTypeSelect.value = '';
                amountLabel.textContent = 'Quantity';
                amountInput.placeholder = 'Enter quantity';
            } else {
                treeSection.style.display = 'none';
                treeRows.innerHTML = '';
                cardsContainer.innerHTML = '';
                fundTypeSelect.disabled = false;
                amountLabel.textContent = 'Amount';
                amountInput.placeholder = 'Enter amount';
            }
        }

        function handleFlowChange() {
            if (typeSelect.value === 'Trees' && flowSelect.value === 'Out') {
                loadAvailableTrees();
            } else {
                cardsContainer.innerHTML = '';
            }
        }

       async function loadAvailableTrees() {
    cardsContainer.innerHTML = '';
    if (!projectSelect.value) return;

    const res = await fetch(`/admin/available-trees?project_id=${projectSelect.value}`);
    const data = await res.json();

    if (!Object.keys(data).length) {
        cardsContainer.innerHTML =
            `<div class="text-danger">No trees available</div>`;
        return;
    }

    let html = `
        <div class="col-12">
            <div class="available-wrapper">
                <h5 class="mb-3">🌳 Available Trees</h5>
                <div class="row">
    `;

    Object.keys(data).forEach(typeName => {
        html += `
            <div class="col-md-4 mb-3">
                <div class="tree-type-card">
                    <h6 class="type-title">${typeName}</h6>
        `;

        data[typeName].forEach(tree => {
            html += `
                <div class="tree-item">
                    <span>${tree.name}</span>
                    <strong>${tree.qty}</strong>
                </div>
            `;
        });

        html += `
                </div>
            </div>
        `;
    });

    html += `
                </div>
            </div>
        </div>
    `;

    cardsContainer.innerHTML = html;
}

        addTreeBtn.addEventListener('click', () => {
            const rowHtml = `
        <div class="row mb-2 tree-row">
            <div class="col-md-4">
                <label>Tree Type</label>
                <select name="trees[type_id][]" class="form-control tree-type" required>
                    <option value="">Select Type</option>
                    @foreach ($treetype as $tree)
                        <option value="{{ $tree->id }}">{{ $tree->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Tree Name</label>
                <select name="trees[tree_name_id][]" class="form-control tree-name" required>
                    <option value="">Select Name</option>
                </select>
            </div>
            <div class="col-md-2">
                <label>Quantity</label>
                <input type="number" name="trees[qty][]" class="form-control" min="1" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove">×</button>
            </div>
        </div>`;
            treeRows.insertAdjacentHTML('beforeend', rowHtml);
        });

        document.addEventListener('click', e => {
            if (e.target.classList.contains('remove')) {
                e.target.closest('.tree-row').remove();
            }
        });

        document.addEventListener('change', e => {
            if (e.target.classList.contains('tree-type')) {
                const typeId = e.target.value;
                const nameSelect = e.target.closest('.tree-row').querySelector('.tree-name');

                nameSelect.innerHTML = '<option value="">Loading...</option>';

                fetch(`/admin/tree-names/${typeId}`)
                    .then(res => res.json())
                    .then(data => {
                        nameSelect.innerHTML = '<option value="">Select Name</option>';
                        data.forEach(tree => {
                            const option = document.createElement('option');
                            option.value = tree.id;
                            option.textContent = tree.name;
                            nameSelect.appendChild(option);
                        });
                    });
            }
        });

        typeSelect.addEventListener('change', handleTypeChange);
        flowSelect.addEventListener('change', handleFlowChange);
        projectSelect.addEventListener('change', handleFlowChange);

        document.addEventListener('DOMContentLoaded', () => {
            handleTypeChange();
            handleFlowChange();
        });
    </script>
@endsection
